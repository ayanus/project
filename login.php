<?php
session_start();
require 'config/database.php'; // ไฟล์นี้เชื่อมต่อกับฐานข้อมูล

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ค้นหาผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM employee WHERE username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            // เก็บข้อมูลผู้ใช้ใน session
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // ตรวจสอบ role และนำทางไปยังหน้า home ที่เหมาะสม
            switch ($row['role']) {
                case 'owner':
                    header("Location: src/owner/bee/show_bee.php");
                    break;
                case 'employee':
                    header("Location: src/employee/employee_home.php");
                    break;
                default:
                    header("Location: login.php");
                    break;
            }
            exit();
        } else {
            $error = "Password is incorrect.";
        }
    } else {
        $error = "No user found with that username.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        height: 100%;
        margin: 0;
        display: flex;
    }

    .wrapper {
        display: flex;
        flex: 1;
        flex-wrap: wrap;
        height: 100vh;
    }

    .container {
        flex: 1.25;
        width: 70%;
        height: 100vh;
        background-color: #FBF8EF;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .img {
        max-width: 100%;
        height: auto;
    }

    .main {
        flex: 1;
        width: 50%;
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-signin .form-control {
        width: 100%; /* ให้ความกว้างเต็ม */
        max-width: 400px; /* เพิ่มความกว้างตามต้องการ */
    }

</style>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <img src="/project/public/picture/login.png" class="img">
        </div>
        <div class="main">
            <form class="form-signin" method="post">
                <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
                <div class="form-group">
                    <label for="username" class="sr-only"></label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password" class="sr-only"></label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-lg btn-primary btn-block " type="submit">Login</button>
                <p class="mt-2 text-body-secondary text-center">Don't have an account yet? <a href="src/employee/register/register.php">Register</a> now</p>

            </form>
        </div>
    </div>
    <!-- Include Bootstrap JS (Optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
