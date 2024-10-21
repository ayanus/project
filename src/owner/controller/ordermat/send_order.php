<?php
session_start();
// เชื่อมต่อกับฐานข้อมูล
include 'C:/xampp/htdocs/project/config/database.php';

if (isset($_GET['supplier_id'])) {
    $supplier_id = $_GET['supplier_id'];
} else {
    echo "ไม่มี supplier ที่ต้องการบันทึก";
    exit();
}

// ตรวจสอบว่ามีสินค้าถูกเพิ่มลงตะกร้าแล้ว
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    
    $material_id = [];
    foreach ($_SESSION['cart'] as $cartId => $cartQty) {
        $material_id[] = $cartId;
    }

    $ids = implode(',', $material_id);

    // ดึงข้อมูลของวัสดุและซัพพลายเออร์
    $query = mysqli_query($conn, "SELECT materials.* , supplier.*
                                  FROM materials
                                  INNER JOIN materials_suppliers 
                                  ON materials.material_id = materials_suppliers.material_id
                                  INNER JOIN supplier
                                  ON materials_suppliers.supplier_id = supplier.supplier_id
                                  WHERE materials.material_id IN($ids)");

    if (mysqli_num_rows($query) > 0) {
        
        $grandTotal = 0; // ยอดรวมทั้งหมด

        // คำนวณยอดรวมทั้งหมด
        while ($row = mysqli_fetch_assoc($query)) {
            $totalPrice = $row['price'] * $_SESSION['cart'][$row['material_id']];
            $grandTotal += $totalPrice;
        }

        // เริ่มการบันทึกลงฐานข้อมูล
        mysqli_begin_transaction($conn); // ใช้ transaction เพื่อให้การบันทึกข้อมูลเป็นไปอย่างถูกต้อง

        try {
            // บันทึกข้อมูลในตาราง ordermaterials
            $order_date = date('Y-m-d');
            $sql_order = "INSERT INTO ordermaterials (ordermat_date, total) VALUES ('$order_date', '$grandTotal')";
            mysqli_query($conn, $sql_order);
            $ordermat_id = mysqli_insert_id($conn); // ดึง ordermat_id ล่าสุด

            // บันทึกข้อมูลในตาราง ordermat_detail
            mysqli_data_seek($query, 0); // reset query result pointer กลับไปที่เริ่มต้น
            while ($row = mysqli_fetch_assoc($query)) {
                $material_id = $row['material_id'];
                $supplier_id = $row['supplier_id'];
                $quantity = $_SESSION['cart'][$material_id];
                $price = $row['price'];

                // สร้างคำสั่ง SQL สำหรับบันทึกข้อมูลในตาราง ordermat_detail
                $sql_detail = "INSERT INTO ordermat_detail (ordermat_id, material_id, supplier_id, quantity, price) 
                               VALUES ('$ordermat_id', '$material_id', '$supplier_id', '$quantity', '$price')";

                if(mysqli_query($conn, $sql_detail)) {
                    echo "<script>alert('บันทึกข้อมูลสำเร็จสำหรับ material_id: $material_id');</script>";
                    echo "<script>window.location = '../../materials/show_mat.php';</script>";

                } else {
                    echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
                }
                // mysqli_query($conn, $sql_detail);
            }

            // ถ้าทุกอย่างสำเร็จ ให้ commit การทำงาน
            mysqli_commit($conn);

            // ลบสินค้าที่สั่งจากตะกร้าเฉพาะของ supplier นั้น ๆ            
            foreach ($_SESSION['cart'] as $cartId => $cartQty) {
                $sql = "SELECT * FROM materials_suppliers WHERE material_id = '$cartId' AND supplier_id = '$supplier_id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    unset($_SESSION['cart'][$cartId]);
                }
            }

            echo "บันทึกคำสั่งซื้อเรียบร้อยแล้ว";

        } catch (Exception $e) {
            // ถ้ามีข้อผิดพลาด ให้ rollback transaction
            mysqli_rollback($conn);
            echo "เกิดข้อผิดพลาดในการบันทึกคำสั่งซื้อ: " . $e->getMessage();
        }

    } else {
        echo "ไม่มีข้อมูลสินค้า";
    }

} else {
    echo "ไม่มีสินค้าในตะกร้า";
}
?>
