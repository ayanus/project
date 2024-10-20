<?php
include 'C:/xampp/htdocs/project/config/database.php';

    $id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $picture = $_FILES['picture']['name'];

    $picture = $_FILES['picture']['name'];

    $image_tmp = $_FILES['picture']['tmp_name'];
    $folder = "C:/xampp/htdocs/project/uploads/";
    $image_location = $folder . $picture;

    // ตรวจสอบว่าค่าทั้งหมดมีอยู่และไม่เป็นค่าว่าง
        // คำสั่ง SQL สำหรับอัปเดตข้อมูล
        $sql = "UPDATE products SET product_name = '$name', price = '$price', picture = '$picture'
                WHERE product_id = $id"; 
        $result = mysqli_query($conn, $sql);
                
        if ($result){
            move_uploaded_file($image_tmp, $image_location);
            echo "<script>alert('ข้อมูลถูกอัปเดตเรียบร้อยแล้ว')</script>";
            echo "<script>window.location = '../../products/show_pro.php'</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    
?>
