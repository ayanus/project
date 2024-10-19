<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';
$minLength = 8;

// ตรวจสอบการอัปโหลดไฟล์
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['employee_name']) && isset($_POST['username']) && isset($_POST['password'])) {
        $employee_name = $_POST['employee_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // เช็คไม่ให้มีค่าว่าง
        if (empty($employee_name)) {
            $_SESSION['error'] = "Please enter your name";
            header("Location: register.php");
            exit();
        } else if (empty($username)) {
            $_SESSION['error'] = "Please enter your username";
            header("Location: register.php");
            exit();
        } else if (empty($password)) {
            $_SESSION['error'] = "Please enter your password";
            header("Location: register.php");
            exit();
        } else if (strlen($password) < $minLength) {
            $_SESSION['error'] = "Password must be at least 8 characters";
            header("Location: register.php");
            exit();
        }

        // เช็ค username ซ้ำ
        $check_username = $conn->prepare("SELECT COUNT(*) FROM employee WHERE username = ?");
        $check_username->bind_param("s", $username);
        $check_username->execute();
        $check_username->bind_result($userNameExists);
        $check_username->fetch();
        $check_username->close();

        // กรณีถ้ามี username อยู่ใน database แล้ว
        if ($userNameExists) {
            $_SESSION['error'] = "Username already exists";
            header("Location: register.php");
            exit();
        } else {

    $picture = $_FILES['picture']['name'];
    // ตรวจสอบไฟล์รูปภาพ
    $image_tmp = $_FILES['picture']['tmp_name'];
    $folder = "C:/xampp/htdocs/project/uploads/";
    $image_location = $folder . basename($picture);

    // ข้อมูลพนักงาน
    $sex = $_POST['sex'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $department_id = $_POST['department_id'];
    $bank = $_POST['bank'];
    $account_name = $_POST['account_name'];
    $account_num = $_POST['account_num'];
    $role = "employee";

    // เตรียม SQL statement
    $sql = "INSERT INTO employee (picture, employee_name, sex, tel, email, address, department_id, bank, account_name, account_num, username, password, role, start_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // ผูกค่าตัวแปรลงใน SQL statement
    $stmt->bind_param("sssssssssssss", $picture, $employee_name, $sex, $tel, $email, $address, $department_id, $bank, $account_name, $account_num, $username, $password, $role);

    // ทำการ execute คำสั่ง SQL
    if ($stmt->execute()) {
        // ย้ายไฟล์อัปโหลดไปยังโฟลเดอร์
        if (move_uploaded_file($image_tmp, $image_location)) {
            echo "บันทึกข้อมูลสำเร็จ";
        } else {
            die('Error moving uploaded file.');
        }
    } else {
        die('ไม่สามารถบันทึกข้อมูลได้ : ' . $stmt->error);
    }

    // ปิด statement
    $stmt->close();

    // เปลี่ยนหน้าไปยังหน้า login.php หลังจากบันทึกข้อมูลสำเร็จ
    header("Location: /project/login.php");
    exit();
}
}
}
?>