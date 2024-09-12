<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $material_name = $_POST['material_name'];
    $quantity = $_POST['quantity'];
    $material_unit = $_POST['material_unit'];
    $material_type = $_POST['material_type'];

    $stmt = $conn->prepare("INSERT INTO materials (material_name, quantity, material_type, material_unit) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $material_name, $quantity, $material_type, $material_unit);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../materials/show_mat.php'</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    }

    $stmt->close();
    $conn->close();
?>
