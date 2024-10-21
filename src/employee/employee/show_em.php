<?php
include 'C:/xampp/htdocs/project/config/database.php';
// session_start();

// ตรวจสอบว่ามี employee_id อยู่ใน session หรือไม่
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติส่วนตัว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
    <script>
        function enableEdit() {
            // เปิดให้สามารถแก้ไขฟิลด์ได้
            const inputs = document.querySelectorAll('.editable');
            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });

            // ซ่อนปุ่มแก้ไขและแสดงปุ่มบันทึก
            document.getElementById('edit-btn').style.display = 'none';
            document.getElementById('save-btn').style.display = 'inline-block';
        }
    </script>
</head>
<body>
    <div class="containerr">
        <?php include '../../../public/php/nav_em.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar_em.php'; ?>
        </div>

        <?php 
        if (!isset($_SESSION['username'])) {
            header("Location: login.php");
            exit();
        }
        
        // เตรียม SQL statement โดยใช้ MySQLi
        $username = $_SESSION['username'];
        $sql = "SELECT employee.* , department.* FROM employee JOIN department ON department.department_id = employee.department_id WHERE username = '$username'";
        
        // ทำการ execute query
        $result = mysqli_query($conn, $sql);
        
        // ดึงข้อมูลพนักงานจากผลลัพธ์
        $row = mysqli_fetch_assoc($result);
        ?>
        ?>

        <div class="main">
            <div class="container">
                <div class="header">ข้อมูลพนักงาน</div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="show_em.php">ข้อมูลส่วนตัว</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="true" href="show_payment.php">ประวัติการรับเงิน</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="../controller/employee/update_em.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-2">
                                        <h5>ข้อมูลพนักงาน</h5>
                                        <div class="col-sm-2">
                                            <label class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" name="employee_id" value="<?= isset($row['employee_id']) ? htmlspecialchars($row['employee_id']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">ชื่อ - สกุล</label>
                                            <input type="text" class="form-control editable" name="employee_name" value="<?= isset($row['employee_name']) ? htmlspecialchars($row['employee_name']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">แผนก</label>
                                            <input type="text" class="form-control" name="department_name" value="<?= isset($row['department_name']) ? htmlspecialchars($row['department_name']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">ที่อยู่</label>
                                            <input type="text" class="form-control editable" name="address" value="<?= isset($row['address']) ? htmlspecialchars($row['address']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">เบอร์โทร</label>
                                            <input type="text" class="form-control editable" name="tel" value="<?= isset($row['tel']) ? htmlspecialchars($row['tel']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">เพศ</label>
                                            <input type="text" class="form-control" name="sex" value="<?= isset($row['sex']) ? htmlspecialchars($row['sex']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="form-label">วันที่เริ่มทำงาน</label>
                                            <input type="text" class="form-control" name="start_date" value="<?= isset($row['start_date']) ? htmlspecialchars($row['start_date']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="form-label">วันจบการทำงาน</label>
                                            <input type="text" class="form-control" name="end_date" value="<?= isset($row['end_date']) ? htmlspecialchars($row['end_date']) : '' ?>" readonly>
                                        </div>
                                        <hr>
                                        
                                        <h5>ข้อมูลธนาคาร</h5>
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อบัญชี</label>
                                            <input type="text" class="form-control editable" name="account_name" value="<?= isset($row['account_name']) ? htmlspecialchars($row['account_name']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อธนาคาร</label>
                                            <input type="text" class="form-control editable" name="bank" value="<?= isset($row['bank']) ? htmlspecialchars($row['bank']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">เลขที่บัญชี</label>
                                            <input type="text" class="form-control editable" name="account_num" value="<?= isset($row['account_num']) ? htmlspecialchars($row['account_num']) : '' ?>" readonly>
                                        </div>
                                        <hr>
                                    </div>
                                    <button type="button" class="btn btn-warning" id="edit-btn" onclick="enableEdit()">แก้ไขข้อมูล</button>
                                    <button type="submit" class="btn btn-primary" id="save-btn" style="display: none;">บันทึกข้อมูล</button>                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
