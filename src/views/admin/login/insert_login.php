<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';

    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $_SESSION['error'] = "Please enter your email";
            header("Location: /project/src/views/admin/login/login.php");
            exit();
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Please enter a valid email address";
            header("Location: /project/src/views/admin/login/login.php");
            exit();
        } else if (empty($password)) {
            $_SESSION['error'] = "Please enter your password";
            header("Location: /project/src/views/admin/login/login.php");
            exit();
        } else {
            try { 
                $stmt = $conn->prepare("SELECT * FROM employee WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $userData = $result->fetch_assoc();
                
                if ($userData && password_verify($password, $userData['password'])) {
                    $_SESSION['user_id'] = $userData['employee_id'];
                    header("Location: /project/src/views/admin/dashboard/dashboard.php"); 
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid email or password";
                    header("Location: /project/src/views/admin/login/login.php");
                    exit();
                }
            
            } catch (Exception $e) {
                $_SESSION['error'] = "Something went wrong, please try again.";
                header("Location: /project/src/views/admin/login/login.php");
                exit();
            }
        }
    }
?>