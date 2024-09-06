<?php
include 'C:/xampp/htdocs/project/config/database.php';

if (isset($_POST['supplier_id']) && is_numeric($_POST['supplier_id'])) {
    $id = $_POST['supplier_id'];
    $name = isset($_POST['supplier_name']) ? $_POST['supplier_name'] : '';
    $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $material_name = isset($_POST['material_name']) ? $_POST['material_name'] : '';

    // ตรวจสอบว่าค่าทั้งหมดมีอยู่และไม่เป็นค่าว่าง
    if ($name && $tel && $address && $material_name) {
        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE supplier 
                SET supplier_name = '$name', tel = '$tel', address = '$address', material_name = '$material_name'
                WHERE supplier_id = $id";
                
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
            echo "<script>window.location = '../../suppliers/show_sup.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('ข้อมูลที่ต้องการอัปเดตไม่ครบ')</script>";
    }

    mysqli_close($conn);
} else {
    echo "<script>alert('รหัส Supplier ไม่ถูกต้อง')</script>";
}
?>
