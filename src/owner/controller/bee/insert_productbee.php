<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

// รับข้อมูลจากฟอร์ม
$bee_id = isset($_POST['bee_id']) ? $_POST['bee_id'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';

// รับข้อมูลผลผลิตที่เป็น array
$product_bee_id = isset($_POST['product_bee_id']) ? $_POST['product_bee_id'] : [];
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : [];
$unit = isset($_POST['unit']) ? $_POST['unit'] : [];

$employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
echo "Employee ID: " . $employee_id;

// ตรวจสอบว่าข้อมูลผลผลิตถูกส่งมาถูกต้องหรือไม่
if (!empty($bee_id) && !empty($date) && !empty($product_bee_id) && !empty($quantity)) {
    echo "รับข้อมูลเรียบร้อย<br>";
    
    // วนลูปข้อมูลผลผลิตแต่ละรายการ
    foreach ($product_bee_id as $index => $product) {
        $current_quantity = isset($quantity[$index]) ? $quantity[$index] : 0;
        $current_unit = isset($unit[$index]) ? $unit[$index] : '';
        
        // สร้างคำสั่ง SQL สำหรับการบันทึกผลผลิต
        $sql = "INSERT INTO beekeep_detail (bee_id, product_bee_id, quantity, unit, date, employee_id) 
                VALUES ('$bee_id', '$product', '$current_quantity', '$current_unit', '$date', '$employee_id')";
    
        
        // บันทึกลงฐานข้อมูล
        if (mysqli_query($conn, $sql)) {
            echo "บันทึกข้อมูลสำเร็จ<br>";
        } else {
            echo "เกิดข้อผิดพลาดในการบันทึก: " . mysqli_error($conn);
        }
    }
} else {
    echo "ข้อมูลไม่ครบถ้วน กรุณากรอกข้อมูลให้ครบถ้วน";
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
