<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';

// รับค่าจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material_name = $_POST["material_name"];
    $type_id = $_POST['type_id'];
    $price = $_POST["price"];
    $material_img = $_FILES['material_img']['name'];
    // ตรวจสอบไฟล์รูปภาพ
    $image_tmp = $_FILES['material_img']['tmp_name'];
    $folder = "C:/xampp/htdocs/project/uploads/";
    $image_location = $folder . $material_img;

    $material_detail = $_POST["material_detail"];

    // ตรวจสอบข้อมูลจากฐานข้อมูลเพื่อดึงค่าการแปลง
    $conversion_to_base_unit = 1; // ค่าที่จะใช้เริ่มต้น

    // หากต้องการให้ระบบดึงค่าจากฐานข้อมูล เช่น ตรวจสอบสินค้าที่มีอยู่
    $query = "SELECT conversion_to_base_unit FROM materials WHERE material_name = '$material_name' LIMIT 1";
    $result = $conn->query($query);

    // สร้าง SQL เพื่อเพิ่มข้อมูลสินค้า
    $sql = "INSERT INTO materials (material_name, type_id , price, material_img, material_detail, conversion_to_base_unit)
            VALUES ('$material_name', '$type_id', '$price', '$material_img', '$material_detail', $conversion_to_base_unit)";


    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($image_tmp, $image_location);
        header("Location: ../../materials/show_mat.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
        header("Location: ../../materials/show_mat.php");}
    }

$conn->close();
?>
