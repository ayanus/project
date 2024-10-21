<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

    $id = $_POST['employee_id'];
    $name = $_POST['employee_name'];
    $address = $_POST['address'];
    $sex = $_POST['sex'];
    $tel = $_POST['tel']; 
    $account_name = $_POST['account_name'];
    $account_num = $_POST['account_num'];
    $bank = $_POST['bank'];


    // $picture = $_FILES['picture']['name'];

    // $picture = $_FILES['picture']['name'];

    // $image_tmp = $_FILES['picture']['tmp_name'];
    // $folder = "C:/xampp/htdocs/project/uploads/";
    // $image_location = $folder . $picture;

    // ตรวจสอบว่าค่าทั้งหมดมีอยู่และไม่เป็นค่าว่าง
        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE employee SET employee_name = '$name', address = '$address', sex = '$sex', tel = '$tel', account_name = '$account_name', account_num = '$account_num', bank = '$bank'
                WHERE employee_id = $id";
        $result = mysqli_query($conn, $sql);
                
        if ($result){
            move_uploaded_file($image_tmp, $image_location);
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
            echo "<script>window.location = '../../employee/show_em.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    
?>
