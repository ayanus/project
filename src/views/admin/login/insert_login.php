<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username)) {
            $_SESSION['error'] = "Please enter your email";
            header("Location: /project/src/views/admin/login/login.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter a valid email address";
            header("Location: /project/src/views/admin/login/login.php");
        } else if (empty($password)) {
            $_SESSION['error'] = "Please enter your password";
            header("Location: /project/src/views/admin/login/login.php");
        } else {
            try { 
                $stmt = $conn->prepare("SELECT COUNT(*) FROM employee WHERE email = ?");
                $stmt->bind_param("s", $email);
                $userData = $stmt->fetch();
            // ยังไม่เสร็จ
            
            } catch (Exception $e) {
                $_SESSION['error'] = "Something went wrong, please try again.";
                header("Location: /project/src/views/admin/login/login.php");
            }
            
                
        }
    }
?>