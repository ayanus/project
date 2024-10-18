<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';
    $bee_name = $_POST['bee_name'];
    $quantity = $_POST['quantity'];
    $bee_food = $_POST['bee_food'];
    $bee_detail = $_POST['bee_detail'];

    $stmt = $conn->prepare("INSERT INTO bee (bee_name, quantity, bee_food, bee_detail) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $bee_name, $quantity, $bee_food, $bee_detail);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../bee/add_bee.php'</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    }

    $stmt->close();
    $conn->close();
?>
