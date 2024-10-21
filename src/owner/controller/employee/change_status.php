<?php
// เริ่มการใช้งาน session และเชื่อมต่อฐานข้อมูล
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

// ตรวจสอบว่าได้รับ employee_id หรือไม่
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];
    
    // กำหนดค่า end_date ให้เป็นวันที่ปัจจุบัน
    $current_date = date('Y-m-d');

    // SQL สำหรับการอัปเดต end_date
    $sql = "UPDATE employee SET end_date = '$current_date' WHERE employee_id = '$employee_id'";

    // ทำการ execute query
    if (mysqli_query($conn, $sql)) {
        // หากอัปเดตสำเร็จ กลับไปยังหน้าข้อมูลพนักงาน หรือแสดงข้อความสำเร็จ
        header("Location: ../../employee/show_em.php?status=success");
        exit();
    } else {
        // หากเกิดข้อผิดพลาด
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // หากไม่ได้รับ employee_id กลับไปยังหน้าข้อมูลพนักงาน
    header("Location: ../../employee/show_em.php?status=error");
    exit();
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
