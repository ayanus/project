<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['supplier_id'];
    $sql = "DELETE FROM supplier WHERE supplier_id = $id";
    if(mysqli_query($conn, $sql)){
        echo "<script>alert('ลบข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../suppliers/show_sup.php'</script>";
    } else {
        echo "Error : " . $sql . "<br>" . mysqli_error($conn);
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ')</script>";
    }
    mysqli_close($conn);
?>
