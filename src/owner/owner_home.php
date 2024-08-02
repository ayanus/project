<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบว่าเป็น owner หรือไม่
if ($_SESSION['role'] !== 'owner') {
    echo "You do not have permission to view this page.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Owner Home</title>
</head>
<body>
    <h1>Welcome, owner!</h1>
    <p>You are logged in as <?php echo $_SESSION['username']; ?>.</p>
    <form action="../logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</body>
</html>
