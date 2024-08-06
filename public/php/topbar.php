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

<div class="topbar">
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <p>Welcome K.<?php echo $_SESSION['username']; ?></p>
            </div>

            <div class="logout">
            <form action="/project/src/logout.php" method="post">
                <input type="submit" class="btn btn-danger" value="Logout">
            </form>
        </div>
        </div>