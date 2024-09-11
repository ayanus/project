<?php
session_start();
require 'config/database.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินแล้วหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ถ้าฟอร์มถูกส่งแล้ว
if (isset($_POST['submit_form'])) {
    $employee_id = $_SESSION['employee_id'];
    $picture = $_SESSION['picture'];
    $tel = $_SESSION['tel'];
    $email = $_SESSION['email'];
    $address = $_SESSION['address'];
    $sex = $_POST['sex'];
    $account_name = $_POST['account_name'];
    $account_num = $_POST['account_num'];
    $pic_bank = $_POST['pic_bank'];
    $department_id = $_POST['department_id'];

    // อัพเดทข้อมูลผู้ใช้ว่ากรอกฟอร์มแล้ว
    $stmt = $conn->prepare("UPDATE employee SET picture = ?, tel = ?, email = ?, address = ?, sex = ?, account_name = ?, account_num = ?, pic_bank = ?, department_id = ?, has_filled_form = 1 WHERE employee_id = ?");
    $stmt->bind_param("ss", $picture, $tel, $email, $address, $sex, $account_name, $account_num, $pic_bank, $department_id, $employee_id);
    if ($stmt->execute()) {
        $_SESSION['has_filled_form'] = 1;
        header("Location: src/employee/employee/show_em.php"); // เมื่อกรอกฟอร์มแล้วให้ไปหน้า dashboard
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Home</title>
    <link rel="stylesheet" href="/project/public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="containerr">
        <?php include '../../public/php/nav_em.php'; ?>
    
    <div class="top">
        <?php include '../../public/php/topbar_em.php'; ?>
        
        <div class="main">
            <div class="container">  
    </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>