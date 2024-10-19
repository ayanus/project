<?php
session_start();

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="topbar"> 
    <ul>
        <li>
            <a href="/project/src/employee/employee_home.php">
                <img width="120" src="/project/public/logo.png" alt="Big Bee Farm Logo">                    
            </a>
        </li>
    </ul>
    
    <div class="user">
        <a href="/project/src/employee/employee/showmore_em.php">Welcome K.<?php echo $_SESSION['username']; ?></a>
    </div>

    <div class="logout">
        <a href="/project/src/logout.php">
            <span class="icon">
                <ion-icon name="log-out-outline"></ion-icon>  
            </span>          
        </a>
    </div>
</div>