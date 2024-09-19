<?php
    session_start();
    include 'C:/xampp/htdocs/project/config/database.php';
    $minLength = 8;

    if(isset($_POST['employee_id']) && isset($_POST['employee_name']) && isset($_POST['username']) && isset($_POST['password'])) {
        echo "test";
        $employee_id = $_POST['employee_id'];
        $employee_name = $_POST['employee_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        //เช็คไม่ให้มีค่าว่าง
        if (empty($employee_name)) {
            $_SESSION['error'] = "Please enter your name";
            header("Location: ../../employee/add_em.php");
        } else if (empty($username)) {
            $_SESSION['error'] = "Please enter your username";
            header("Location: ../../employee/add_em.php");
        } else if (empty($password)) {
            $_SESSION['error'] = "Please enter your password";
            header("Location: ../../employee/add_em.php");
            //เช็คความยาวของ password
        } else if (strlen($password) < $minLength) {
            $_SESSION['error'] = "Password must be at least 8 characters";
            header("Location: ../../employee/add_em.php");
            // เช็ค password กับ confirm password ว่าตรงกันไหม
        } else {
            //เช็ค username ซ้ำ
            $check_username = $conn->prepare("SELECT COUNT(*) FROM employee WHERE username = ?");
            $check_username->bind_param("s", $username);
            $check_username->execute();
            $check_username->bind_result($userNameExists);
            $check_username->fetch();
            $check_username->close();
    
            //กรณีถ้ามี username หรือ email อยู่ใน database แล้ว
            if ($userNameExists) {
                $_SESSION['error'] = "Username already exists";
                header("Location: ../../employee/add_em.php");
                exit();
            } else {
                try {
                    $stmt = $conn->prepare("INSERT INTO employee (username, password ) VALUES (?, ?)");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $stmt->close();
                    $_SESSION['success'] = "Register successfully";
                    header("Location: ../../employee/add_em.php");
                    exit();
                //กรณีที่มี error ในการ insert ข้อมูล
                } catch (Exception $e) {
                    $_SESSION['error'] = "Something went wrong, Please try again";
                    echo "Register failed: " . $e->getMessage();
                    header("Location: ../../employee/add_em.php");
                    exit();
                }
            }
        }
    }

?>