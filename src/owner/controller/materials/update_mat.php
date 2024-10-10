<?php
include 'C:/xampp/htdocs/project/config/database.php';

if (isset($_POST['material_id']) && is_numeric($_POST['material_id'])) {
    $id = $_POST['material_id'];
    $name = isset($_POST['material_name']) ? $_POST['material_name'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 0;
    $base_unit = isset($_POST["base_unit"]) ? $_POST["base_unit"] : '';

    $pack_to_subunit = 12;  // หน่วยแพ็ค -> ขวด/กล่อง/กระปุก/หลอด
    $kg_to_gram = 1000;     // หน่วยกิโลกรัม -> กรัม

    // แปลงหน่วย base_unit ตามที่กำหนด
    if ($base_unit == 'แพ็ค') {
        $stock_quantity_addition = $quantity * $pack_to_subunit; // แปลงเป็นขวด
        $unit_type = 'ขวด/กล่อง/กระปุก/หลอด';
    } elseif ($base_unit == 'กิโลกรัม') {
        $stock_quantity_addition = $quantity * $kg_to_gram; // แปลงเป็นกรัม
        $unit_type = 'กรัม';
    }

    // ตรวจสอบค่าทั้งหมด
    if ($quantity && $base_unit) {
        // ดึงข้อมูลจำนวนที่มีอยู่ในสต็อกปัจจุบันและ stock_quantity ปัจจุบัน
        $sql_check = "SELECT quantity, stock_quantity FROM materials WHERE material_id = $id";
        $result = mysqli_query($conn, $sql_check);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row['quantity'];           // จำนวนที่มีอยู่ในปัจจุบัน
            $current_stock_quantity = $row['stock_quantity']; // จำนวน stock_quantity ปัจจุบัน

            // บวกจำนวนใหม่เข้ากับจำนวนที่มีอยู่
            $new_quantity = $current_quantity + $quantity;
            $new_stock_quantity = $current_stock_quantity + $stock_quantity_addition;

            // อัปเดตข้อมูลจำนวนใหม่และ stock_quantity ในฐานข้อมูล
            $sql_update = "UPDATE materials 
                            SET quantity = '$new_quantity', stock_quantity = '$new_stock_quantity', base_unit = '$base_unit'
                            WHERE material_id = $id";

            if (mysqli_query($conn, $sql_update)) {
                echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
                echo "<script>window.location = '../../materials/show_mat.php'</script>";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('ไม่พบข้อมูลวัตถุดิบที่เลือก')</script>";
        }
    } else {
        echo "<script>alert('ข้อมูลที่ต้องการอัปเดตไม่ครบ')</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Material ID ไม่ถูกต้อง')</script>";
}
?>
