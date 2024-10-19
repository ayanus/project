<?php
    include 'C:/xampp/htdocs/project/config/database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $quantity_packs = $_POST['quantity']; // จำนวนแพ็คที่กรอกในฟอร์ม
        $production_date = $_POST['production_date'];
        $employee_id = $_POST['employee_id'];

        // 1 แพ็ค = 12 ขวด
        $quantity_units = $quantity_packs * 12; // แปลงจำนวนแพ็คเป็นจำนวนขวด

        // เริ่มการทำธุรกรรม
        $conn->begin_transaction();

        try {
            // เพิ่มข้อมูลการผลิตลงในตาราง production
            $sql_production = "INSERT INTO production (production_date, quantity, employee_id) VALUES (?, ?, ?)";
            $stmt_production = $conn->prepare($sql_production);
            $stmt_production->bind_param("sii", $production_date, $quantity_packs, $employee_id);
            $stmt_production->execute();
            $production_id = $conn->insert_id; // เก็บค่า production_id ที่เพิ่งถูกเพิ่มเข้ามา

            // เพิ่มรายละเอียดการผลิตลงใน productiondetail
            $sql_production_detail = "INSERT INTO productiondetail (production_id, product_id, quantity) VALUES (?, ?, ?)";
            $stmt_production_detail = $conn->prepare($sql_production_detail);
            $stmt_production_detail->bind_param("iii", $production_id, $product_id, $quantity_units);
            $stmt_production_detail->execute();
            $production_detail_id = $conn->insert_id;

            // ดึงข้อมูลสูตรจากตาราง recipe สำหรับสินค้านี้
            $sql_recipe = "SELECT product_bee_id, amount_per_unit FROM recipe WHERE product_bee_id = ?";
            $stmt_recipe = $conn->prepare($sql_recipe);
            $stmt_recipe->bind_param("i", $product_id);
            $stmt_recipe->execute();
            $result_recipe = $stmt_recipe->get_result();

            // ตัดสต๊อกผลผลิตผึ้งตามสูตรการผลิต
            while ($recipe = $result_recipe->fetch_assoc()) {
                $product_bee_id = $recipe['product_bee_id'];
                $amount_per_unit = $recipe['amount_per_unit'];
                $total_quantity_needed = $quantity_units * $amount_per_unit;

                // ใช้ระบบ FIFO ในการตัดสต๊อกจาก beekeep_detail
                $sql_bee_stock = "SELECT b_keep_dt_id, quantity FROM beekeep_detail WHERE product_bee_id = ? ORDER BY date ASC";
                $stmt_bee_stock = $conn->prepare($sql_bee_stock);
                $stmt_bee_stock->bind_param("i", $product_bee_id);
                $stmt_bee_stock->execute();
                $result_bee_stock = $stmt_bee_stock->get_result();

                while ($total_quantity_needed > 0 && $bee_stock = $result_bee_stock->fetch_assoc()) {
                    $bee_keep_detail_id = $bee_stock['b_keep_dt_id'];
                    $bee_stock_quantity = $bee_stock['quantity'];

                    if ($bee_stock_quantity <= $total_quantity_needed) {
                        // ใช้จำนวนทั้งหมดจากสต๊อกนี้
                        $sql_update_bee_stock = "UPDATE beekeep_detail SET quantity = 0 WHERE b_keep_dt_id = ?";
                        $stmt_update_bee_stock = $conn->prepare($sql_update_bee_stock);
                        $stmt_update_bee_stock->bind_param("i", $bee_keep_detail_id);
                        $stmt_update_bee_stock->execute();

                        // บันทึกการใช้ใน mat_use_detail
                        $sql_mat_use_detail = "INSERT INTO material_usedetail (material_id, production_dt_id, b_keep_dt_id) VALUES (?, ?, ?)";
                        $stmt_mat_use_detail = $conn->prepare($sql_mat_use_detail);
                        $stmt_mat_use_detail->bind_param("iii", $product_bee_id, $production_detail_id, $b_keep_dt_id);
                        $stmt_mat_use_detail->execute();

                        $total_quantity_needed -= $bee_stock_quantity;
                    } else {
                        // ใช้บางส่วนจากสต๊อกนี้
                        $new_quantity = $bee_stock_quantity - $total_quantity_needed;
                        $sql_update_bee_stock = "UPDATE beekeep_detail SET quantity = ? WHERE b_keep_dt_id = ?";
                        $stmt_update_bee_stock = $conn->prepare($sql_update_bee_stock);
                        $stmt_update_bee_stock->bind_param("ii", $new_quantity, $b_keep_dt_id);
                        $stmt_update_bee_stock->execute();

                        // บันทึกการใช้ใน mat_use_detail
                        $sql_mat_use_detail = "INSERT INTO mat_use_detail (material_id, production_dt_id, b_keep_dt_id) VALUES (?, ?, ?)";
                        $stmt_mat_use_detail->bind_param("iii", $product_bee_id, $production_detail_id, $b_keep_dt_id);
                        $stmt_mat_use_detail->execute();

                        $total_quantity_needed = 0;
                    }
                }
            }

            // ตัดสต๊อกวัสดุบรรจุภัณฑ์
            $material_id = $_POST['material_id'];
            $sql_material_stock = "SELECT stock_quantity FROM materials WHERE material_id = ?";
            $stmt_material_stock = $conn->prepare($sql_material_stock);
            $stmt_material_stock->bind_param("i", $material_id);
            $stmt_material_stock->execute();
            $result_material_stock = $stmt_material_stock->get_result();
            $material_stock = $result_material_stock->fetch_assoc();
            $material_stock_quantity = $material_stock['stock_quantity'];

            // คำนวณจำนวนวัสดุที่ต้องใช้ (1 แพ็ค = 12 ขวด)
            $total_materials_needed = $quantity_packs * 12;

            if ($material_stock_quantity >= $total_materials_needed) {
                // ตัดสต๊อกวัสดุ
                $new_material_quantity = $material_stock_quantity - $total_materials_needed;
                $sql_update_material_stock = "UPDATE materials SET stock_quantity = ? WHERE material_id = ?";
                $stmt_update_material_stock = $conn->prepare($sql_update_material_stock);
                $stmt_update_material_stock->bind_param("ii", $new_material_quantity, $material_id);
                $stmt_update_material_stock->execute();
            } else {
                throw new Exception('วัสดุไม่เพียงพอในการผลิต');
            }

            // ยืนยันการทำธุรกรรม
            $conn->commit();
            echo "การผลิตสำเร็จ";

        } catch (Exception $e) {
            // ยกเลิกการทำธุรกรรมหากมีข้อผิดพลาด
            $conn->rollback();
            echo "การผลิตล้มเหลว: " . $e->getMessage();
        }
    }
?>
