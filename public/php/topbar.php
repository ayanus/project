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
    <ul>
        <li>
            <a href="/project/src/owner/owner_home.php">
                <img width="120" src="/project/public/logo.png" alt="Big Bee Farm Logo">                    
            </a>
        </li>
    </ul>
    
    <div class="user">
        <p>Welcome K.<?php echo $_SESSION['username']; ?></p>
    </div>

    <div class="logout">
        <a href="/project/src/logout.php">
            <span class="icon">
                <ion-icon name="log-out-outline"></ion-icon>  
            </span>          
        </a>
    </div>
</div>