<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST['supplier_name'];
    $company = $_POST['company'];
    $tel = $_POST['tel'];
    $address = $_POST['address'];
    $supplier_img = $_FILES['supplier_img']['name'];

    // ตรวจสอบไฟล์รูปภาพ
    $image_tmp = $_FILES['supplier_img']['tmp_name'];
    $folder = "C:/xampp/htdocs/project/uploads/";
    $image_location = $folder . $supplier_img;


    $stmt = $conn->prepare("INSERT INTO supplier (supplier_name, company, tel, address, supplier_img) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $supplier_name, $company, $tel, $address, $supplier_img);
    
    // เรียกใช้คำสั่ง
    if ($stmt->execute()) {
        // ย้ายไฟล์ภาพไปยังโฟลเดอร์ที่กำหนด
        move_uploaded_file($image_tmp, $image_location);

        // ดึง supplier_id ที่เพิ่งเพิ่มเข้ามา
        $supplier_id = $conn->insert_id;

        // ตรวจสอบว่ามีวัสดุที่ถูกเลือกหรือไม่
        if (!empty($_POST['materials'])) {
            foreach ($_POST['materials'] as $material_id => $type_id) {
                // สร้าง SQL เพื่อเพิ่มข้อมูลวัสดุที่เลือก
                $material_stmt = $conn->prepare("INSERT INTO materials_suppliers (supplier_id, material_id, type_id) VALUES (?, ?, ?)");
                $material_stmt->bind_param("iii", $supplier_id, $material_id, $type_id);
                $material_stmt->execute();
            }
        }

        // เปลี่ยนเส้นทางไปยังหน้าแสดงผู้จัดจำหน่าย
        header("Location: ../../suppliers/show_sup.php");
    } else {
        echo "Error: " . $stmt->error;
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // ปิดการเชื่อมต่อ
    $stmt->close();
    $conn->close();
}
?>