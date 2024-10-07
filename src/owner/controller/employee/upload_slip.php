<?php
include 'C:/xampp/htdocs/project/config/database.php';

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // รับค่าจากฟอร์ม
    $employee_id = $_POST['employee_id'];
    $status = "paid";

    // ตรวจสอบว่าไฟล์ถูกอัปโหลดมาหรือไม่
    if (isset($_FILES['slip']) && $_FILES['slip']['error'] == 0) {
        $uploadDir = 'C:/xampp/htdocs/project/uploads/';
        $fileName = basename($_FILES['slip']['name']);
        $uploadFile = $uploadDir . $fileName;

        // ตรวจสอบว่ามีไฟล์แล้วหรือยัง
        if (file_exists($uploadFile)) {
            echo "ไฟล์นี้ถูกอัปโหลดแล้ว";
        } else {
            // ย้ายไฟล์ไปยังโฟลเดอร์ที่กำหนด
            if (move_uploaded_file($_FILES['slip']['tmp_name'], $uploadFile)) {
                // เตรียมคำสั่ง SQL สำหรับบันทึกข้อมูล
                $sql = "INSERT INTO salary (employee_id, date, slip, status)
                        VALUES (?, NOW(), ?, ?)";

                // เตรียม statement
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $employee_id, $fileName, $status);

                // ตรวจสอบการบันทึกข้อมูล
                if ($stmt->execute()) {
                    echo "อัปโหลดไฟล์และบันทึกข้อมูลสำเร็จ";
                    echo "<script>window.location = '../../employee/showmore_em.php'</script>";
                } else {
                    echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . $stmt->error;
                }

                // ปิด statement
                $stmt->close();
            } else {
                echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
            }
        }
    } else {
        echo "โปรดเลือกไฟล์ที่ต้องการอัปโหลด";
    }
}

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
?>
