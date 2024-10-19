<?php
include 'C:/xampp/htdocs/project/config/database.php';

    $id = $_POST['material_id'];
    $name = $_POST['material_name'];
    $detail = $_POST['material_detail'];
    $type = $_POST['type_id'];

    // ตรวจสอบว่าค่าทั้งหมดมีอยู่และไม่เป็นค่าว่าง
        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE materials SET material_name = '$name', material_detail = '$detail', type_id = $type
                WHERE material_id = $id"; 
        $result = mysqli_query($conn, $sql);
                
        if ($result){
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
            echo "<script>window.location = '../../materials/show_mat.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    
?>
