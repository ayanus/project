<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

if (!isset($_POST['employee_id'])) {
    die("Error: Employee ID not provided.");
}

$employee_id = $_POST['employee_id'];
$date = $_POST['date'];
$salary = $_POST['salary'];
$status = 'paid';  // กำหนดสถานะเป็น paid หลังการบันทึก
$target_dir = "C:/xampp/htdocs/project/uploads/slips/";  // ที่จัดเก็บไฟล์
$slip = $_FILES['slip']['name'];

$target_file = $target_dir . basename($slip);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (move_uploaded_file($_FILES["slip"]["tmp_name"], $target_file)) {
    $stmt = $conn->prepare("INSERT INTO salary (employee_id, date, slip, status, salary) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $employee_id, $date, $slip, $status, $salary);
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = "บันทึกการจ่ายเงินเดือนสำเร็จ";
        header("Location: ../../employee/show_payment.php");
    } else {
        // 7. กรณีเกิดข้อผิดพลาดในการบันทึก
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn);
        header("Location: ../../employee/payment.php");
    }
} else {
    // 8. กรณีการอัปโหลดสลิปล้มเหลว
    $_SESSION['error'] = "การอัปโหลดสลิปล้มเหลว";
    header("Location: ../../employee/payment.php");
}

// 9. ปิดการเชื่อมต่อกับฐานข้อมูล
mysqli_close($conn);
?>
