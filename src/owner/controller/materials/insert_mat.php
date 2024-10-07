<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';

// รับค่าจากฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $material_name = $_POST["material_name"];
    $material_type = $_POST['material_type'];
    $quantity = $_POST["quantity"];
    $base_unit = $_POST["base_unit"];
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

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // ตรวจสอบค่าในฐานข้อมูล
        $conversion_to_base_unit = $row['conversion_to_base_unit'];
    }

    // ตรวจสอบประเภทหน่วย

    $pack_to_subunit = 12;
    $kg_to_gram = 1000;

    if ($base_unit == 'แพ็ค') {
        // ถ้าหน่วยเป็นแพ็ค
        $stock_quantity = $quantity * $pack_to_subunit; // แปลงเป็นจำนวนขวด
        $unit_type = 'ขวด/กล่อง/กระปุก/หลอด';
    } elseif ($base_unit == 'กิโลกรัม') {
        // ถ้าหน่วยเป็นกิโลกรัม
        $stock_quantity = $quantity * $kg_to_gram; // แปลงเป็นกรัม
        $unit_type = 'กรัม';
    }

    // สร้าง SQL เพื่อเพิ่มข้อมูลสินค้า
    $sql = "INSERT INTO materials (material_name, material_type, base_unit, material_img, material_detail, quantity, conversion_to_base_unit, unit_type, stock_quantity)
            VALUES ('$material_name', '$material_type', '$base_unit', '$material_img', '$material_detail', $quantity, $conversion_to_base_unit, '$unit_type', $stock_quantity)";


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
