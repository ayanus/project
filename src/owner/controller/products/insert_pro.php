<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $product_name = $_POST['product_name'];
    $picture = $_POST['picture'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("INSERT INTO products (product_name, picture, price, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $product_name, $picture, $price, $quantity);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
        echo "<script>window.location = '../../products/show_pro.php'</script>";
    } else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ')</script>";
    }

    $stmt->close();
    $conn->close();
?>
