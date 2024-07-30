<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';
    $minLength = 8;

    if(isset($_POST['register'])) {
        $employee_name = $_POST['employee_name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        //เช็คไม่ให้มีค่าว่าง
        if (empty($employee_name)) {
            $_SESSION['error'] = "Please enter your name";
            header("Location: /project/src/views/admin/login/register.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter your email";
            header("Location: /project/src/views/admin/login/register.php");
        } else if (empty($username)) {
            $_SESSION['error'] = "Please enter your username";
            header("Location: /project/src/views/admin/login/register.php");
        } else if (empty($password)) {
            $_SESSION['error'] = "Please enter your password";
            header("Location: /project/src/views/admin/login/register.php");
            //เช็คความยาวของ password
        } else if (strlen($password) < $minLength) {
            $_SESSION['error'] = "Password must be at least 8 characters";
            header("Location: /project/src/views/admin/login/register.php");
            // เช็ค password กับ confirm password ว่าตรงกันไหม
        } else if ($password !== $confirm_password) {
            $_SESSION['error'] = "Password and Confirm Password do not match";
            header("Location: /project/src/views/admin/login/register.php");
        } else {
            //เช็ค username ซ้ำ
            $check_username = $conn->prepare("SELECT COUNT(*) FROM employee WHERE username = ?");
            $check_username->bind_param("s", $username);
            $check_username->execute();
            $check_username->bind_result($userNameExists);
            $check_username->fetch();
            $check_username->close();
    
            $check_Email = $conn->prepare("SELECT COUNT(*) FROM employee WHERE email = ?");
            $check_Email->bind_param("s", $email);
            $check_Email->execute();
            $check_Email->bind_result($userEmailExists);
            $check_Email->fetch();
            $check_Email->close();
    
            //กรณีถ้ามี username หรือ email อยู่ใน database แล้ว
            if ($userNameExists) {
                $_SESSION['error'] = "Username already exists";
                header("Location: /project/src/views/admin/login/register.php");
                exit();
            } else if ($userEmailExists) {
                $_SESSION['error'] = "Email already exists";
                header("Location: /project/src/views/admin/login/register.php");
                exit();
            } else {
                //เข้ารหัส password
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
                //เพิ่มข้อมูลลงใน database
                try {
                    $stmt = $conn->prepare("INSERT INTO employee (employee_name, email, username, password) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $employee_name, $email, $username, $hashedpassword);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'] = "Register successfully";
                    header("Location: /project/src/views/admin/login/register.php");
                    exit();
                //กรณีที่มี error ในการ insert ข้อมูล
                } catch (Exception $e) {
                    $_SESSION['error'] = "Something went wrong, Please try again";
                    echo "Register failed: " . $e->getMessage();
                    header("Location: /project/src/views/admin/login/register.php");
                    exit();
                }
            }
        }
    }
?>