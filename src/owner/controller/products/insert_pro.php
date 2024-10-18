<?php
    include 'C:/xampp/htdocs/project/config/database.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $product_age = $_POST['product_age'];

    $picture = $_FILES['picture']['name'];

    $image_tmp = $_FILES['picture']['tmp_name'];
    $folder = "C:/xampp/htdocs/project/uploads/";
    $image_location = $folder . $picture;

    $stmt = $conn->prepare("INSERT INTO products (product_name, picture, price, product_age) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $product_name, $picture, $price, $product_age);

    if ($stmt->execute()) {
        move_uploaded_file($image_tmp, $image_location);
        header("Location: ../../products/show_pro.php");
    } else {
        echo "Error: " . $stmt->error;
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    }
?>
