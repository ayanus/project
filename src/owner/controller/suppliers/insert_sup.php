<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $supplier_name = $_POST['supplier_name'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $supplier_type = $_POST['supplier_type'];
    $material_name = $_POST['material_name'];


    $stmt = $conn->prepare("INSERT INTO supplier (supplier_name, tel, address, supplier_type, material_name	) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $supplier_name, $tel, $address, $supplier_type, $material_name);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../suppliers/show_sup.php'</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    }

    $stmt->close();
    $conn->close();
?>
