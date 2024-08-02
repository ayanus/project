<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['material_id'];
    $sql = "DELETE FROM materials WHERE material_id = $id";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../materials/show_mat.php'</script>";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ')</script>";
    }
    mysqli_close($conn);
?>
