<?php
include 'C:/xampp/htdocs/project/config/database.php';

// ตรวจสอบการอัปโหลดไฟล์
if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
    $upload_dir = 'C:/xampp/htdocs/project/uploads/'; // โฟลเดอร์สำหรับเก็บรูปภาพ
    $upload_file = $upload_dir . basename($_FILES['picture']['name']);
    
    // ตรวจสอบว่าการย้ายไฟล์สำเร็จหรือไม่
    if (move_uploaded_file($_FILES['picture']['tmp_name'], $upload_file)) {
        $picture = $upload_file; // เก็บพาธของไฟล์ลงในตัวแปร $picture
    } else {
        die('Error uploading file.');
    }
} else {
    // หากไม่มีไฟล์อัปโหลด
    $picture = null; // หรือใช้ค่าเริ่มต้น
}

$employee_name = $_POST['employee_name'];
$sex = $_POST['sex'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$address = $_POST['address'];
$department_id = $_POST['department_id'];
$bank = $_POST['bank'];
$account_name = $_POST['account_name'];
$account_num = $_POST['account_num'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = "employee";

// เตรียม SQL statement
$sql = "INSERT INTO employee (picture, employee_name, sex, tel, email, address, department_id, bank, account_name, account_num, username, password, role, start_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Error preparing statement: ' . $conn->error);
}

// ผูกค่าตัวแปรลงใน SQL statement
$stmt->bind_param("sssssssssssss", $picture, $employee_name, $sex, $tel, $email, $address, $department_id, $bank, $account_name, $account_num, $username, $password, $role);

// ทำการ execute คำสั่ง SQL
if ($stmt->execute()) {
    echo "บันทึกข้อมูลสำเร็จ";
} else {
    die('ไม่สามารถบันทึกข้อมูลได้ : ' . $stmt->error);
}

// ปิด statement
$stmt->close();

// เปลี่ยนหน้าไปยังหน้า login.php หลังจากบันทึกข้อมูลสำเร็จ
header("Location: /project/login.php");
exit();
?>
