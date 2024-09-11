<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
<body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        
            <div class="main">
                <div class="container"> 
                    <div class="form">
                
                        <div class="header">
                            <a href="show_em.php">พนักงาน </a>
                            <a1>/</a1>
                            <a2>เพิ่มข้อมูลพนักงานใหม่</a2>
                        </div>

                        <div class="content">
                            <form action="../controller/employee/insert_em.php" method="post">
                                <label for="name" class="form-label">ชื่อ - นามสกุล</label>
                                <input type="text" class="form-control" id="name" name="employee_name" required>
                                
                                <label for="username" class="form-label mt-4">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>

                                <label for="password" class="form-label mt-4">Password</label>
                                <input type="Password" class="form-control" id="password" name="password" required>

                                <label for="date" class="form-label mt-4">วันที่เริ่มงาน</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>

                                <input type="submit" name="1" class="btn btn-success mt-4 pull-right" value="บันทึกข้อมูล">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- แสดงข้อความ alert -->
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['success'])) {
        echo "<script>alert('" . $_SESSION['success'] . "');</script>";
        unset($_SESSION['success']); // ลบข้อความออกจาก SESSION หลังแสดง alert แล้ว
    }

    if (isset($_SESSION['error'])) {
        echo "<script>alert('" . $_SESSION['error'] . "');</script>";
        unset($_SESSION['error']); // ลบข้อความออกจาก SESSION หลังแสดง alert แล้ว
    }
    ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>