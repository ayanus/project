<?php
include 'C:/xampp/htdocs/project/config/database.php';

if (isset($_POST['material_id']) && is_numeric($_POST['material_id'])) {
    $id = $_POST['material_id'];
    $name = isset($_POST['material_name']) ? $_POST['material_name'] : '';
    $type = isset($_POST['material_type']) ? $_POST['material_type'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $unit = isset($_POST['material_unit']) ? $_POST['material_unit'] : '';

    // ตรวจสอบว่าค่าทั้งหมดมีอยู่และไม่เป็นค่าว่าง
    if ($name && $type && $quantity && $unit) {
        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE materials 
                SET material_name = '$name', material_type = '$type', quantity = '$quantity', material_unit = '$unit'
                WHERE material_id = $id";
                
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
            echo "<script>window.location = '../../materials/show_mat.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('ข้อมูลที่ต้องการอัปเดตไม่ครบ')</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('Material ID ไม่ถูกต้อง')</script>";
}
?>


