<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $material_name = $_POST['material_name'];
    $quantity = $_POST['quantity'];
    $material_type = $_POST['material_type'];

    $stmt = $conn->prepare("INSERT INTO materials (material_name, quantity, material_type) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $material_name, $quantity, $material_type);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    }

    $stmt->close();
    $conn->close();
?>
