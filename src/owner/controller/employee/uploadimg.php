<?php
if (isset($_FILES['picture'])) {
    $target_dir = "public/picture/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบไฟล์เป็นรูปภาพจริงหรือไม่
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if ($check !== false) {
        // ย้ายไฟล์ไปยังโฟลเดอร์ uploads
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            // บันทึกข้อมูลรูปภาพในฐานข้อมูล
            // ตัวอย่างการเชื่อมต่อกับฐานข้อมูลและอัปเดตเส้นทางไฟล์
            $conn = new mysqli("localhost", "root", "", "project");
            $sql = "UPDATE employee SET picture = '$target_file' WHERE id = ?";
            if ($conn->query($sql) === TRUE) {
                echo "อัปโหลดรูปภาพสำเร็จ";
            } else {
                echo "เกิดข้อผิดพลาด: " . $conn->error;
            }
            $conn->close();
        } else {
            echo "เกิดข้อผิดพลาดในการอัปโหลดไฟล์";
        }
    } else {
        echo "ไฟล์นี้ไม่ใช่รูปภาพ";
    }
}
?>
