<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['employee_id'];
    $sql = "SELECT employee.* , department.* FROM employee JOIN department ON employee.department_id = department.department_id WHERE employee_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จ่ายเงินเดือนพนักงาน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
<body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>
        
        <div class="main">
            <div class="container">    
                <div class="header"><a href="show_em.php"><ion-icon name="chevron-back-outline"></ion-icon></a>เงินเดือนพนักงาน</div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="payment.php">จ่ายเงินเดือนพนักงาน</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" aria-current="true" href="show_payment.php">ประวัติการจ่ายเงินเดือน</a>
                        </li> -->
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="process_payment.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-2">
                                        <h5>ข้อมูลพนักงาน</h5>
                                        <div class="col-sm-2">
                                            <label class="form-label">รหัสพนักงาน</label>
                                            <input type="text" class="form-control" name="employee_id" value="<?= isset($row['employee_id']) ? htmlspecialchars($row['employee_id']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="form-label">ชื่อ - สกุล</label>
                                            <input type="text" class="form-control" name="employee_name" value="<?= isset($row['employee_name']) ? htmlspecialchars($row['employee_name']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">แผนก</label>
                                            <input type="text" class="form-control" name="department_name" value="<?= isset($row['department_name']) ? htmlspecialchars($row['department_name']) : '' ?>" readonly>
                                        </div>
                                        <hr>
                                        
                                        <h5>ข้อมูลธนาคาร</h5>
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อบัญชี</label>
                                            <input type="text" class="form-control" name="account_name" value="<?= isset($row['account_name']) ? htmlspecialchars($row['account_name']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อธนาคาร</label>
                                            <input type="text" class="form-control" name="bank" value="<?= isset($row['bank']) ? htmlspecialchars($row['bank']) : '' ?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <label class="form-label">เลขที่บัญชี</label>
                                            <input type="text" class="form-control" name="account_num" value="<?= isset($row['account_num']) ? htmlspecialchars($row['account_num']) : '' ?>" readonly>
                                        </div>
                                        <hr>

                                        <h5>รายละเอียดการจ่ายเงินเดือน</h5>
                                        <div class="col-sm-4">
                                            <label class="form-label">วันที่จ่ายเงิน</label>
                                            <input type="date" class="form-control" name="date" required>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="form-label" class="form-label">จำนวนเงินเดือน</label>
                                            <input type="number" step="0.01" class="form-control" name="salary" value="<?= isset($row['salary']) ? htmlspecialchars($row['salary']) : '' ?>" readonly>
                                        </div>

                                        <div class="col-sm-5">
                                            <label for="formFile" class="form-label">แนบหลักฐานการจ่าย</label>
                                            <input type="file" class="form-control" name="slip" accept="image/png, image/jpg,image/jpeg" required>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">บันทึกการจ่าย</button>
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