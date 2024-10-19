<?php
    ob_start();
    include 'C:/xampp/htdocs/project/config/database.php';
    // เตรียม Statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("SELECT * FROM employee WHERE employee_id = ?");
    $stmt->bind_param("i", $_GET['employee_id']); // กำหนดว่าค่าที่จะส่งเข้าเป็นประเภท integer (i)
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
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
<style>
    .content {
        display: flex;
        justify-content: space-between; /* ทำให้ช่องว่างระหว่าง .data และ .profile */
    }

    .data {
        width: 60%;
    }

    .text-center {
        border-radius: 10px;
        width: 200px;
        border: 2px solid #000;
        margin-right: 150px;
        margin-top: 15px;
        height: 200px;
        overflow: hidden;
    }
    .picture p {
        margin-top: 20px;
    }

    .picture img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .popup {
        display: none;
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        text-align: center;
        width: 500px;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
    }
    

</style>
</head>
    <body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>
        
            <div class="main">
                <div class="container">    
                    <div class="header"><a href="show_em.php"><ion-icon name="chevron-back-outline"></ion-icon></a>ข้อมูลเพิ่มเติม</div>
                        <div class="content">
                            <div class="data">
                                <h5 class="pb-3 fw-semibold">ข้อมูลทั่วไป</h5>
                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label ">ชื่อ - สกุล</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="employee_name" class="form-control" value="<?= isset($row['employee_name']) ? $row['employee_name'] : '' ?>" readonly>
                                    </div>
                                    <div class="col-auto">
                                        <label class="col-form-label ">เพศ</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="sex" class="form-control" value="<?= isset($row['sex']) ? $row['sex'] : '' ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label for="tel" class="col-form-label">เบอร์โทร</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="tel" id="tel" name="tel" class="form-control"  value="<?= isset($row['tel']) ? $row['tel'] : '' ?>" readonly>
                                    </div>

                                    <div class="col-auto">                            
                                        <label for="email" class="col-form-label">Email</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="email" id="email" name="email" class="form-control" value="<?= isset($row['email']) ? $row['email'] : '' ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label ">ที่อยู่</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="address" class="form-control" value="<?= isset($row['address']) ? $row['address'] : '' ?>" style="width: 100%;" readonly>
                                    </div>
                                </div>

                                <h5 class="pb-3 pt-4 fw-semibold">ข้อมูลธนาคาร</h5>
                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label">ชื่อบัญชี</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="account_name" class="form-control" value="<?= isset($row['account_name']) ? $row['account_name'] : '' ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label ">ธนาคาร</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="bank" class="form-control" value="<?= isset($row['bank']) ? $row['bank'] : '' ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label ">เลขบัญชี</label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="text" name="account_num" class="form-control" value="<?= isset($row['account_num']) ? $row['account_num'] : '' ?>" readonly>
                                    </div>

                                    <button class="btn btn-md btn-success btn-block w-25 center" type="button" name="status" id="payrollBtn">จ่ายเงินเดือนพนักงาน</button>
                                </div>


                                <div id="popup" class="popup">
                                    <div class="popup-content">
                                        <span id="closePopup" class="close">&times;</span>
                                        <h2>อัปโหลดสลิปการโอน</h2>
                                        <form action="../controller/employee/upload_slip.php" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="employee_id" value="<?= isset($row['employee_id']) ? $row['employee_id'] : '' ?>">
                                            <input class="form-control" type="file" id="formFile" name="slip" required><br>
                                            <button class="btn btn-md btn-success btn-block" type="submit">อัปโหลด</button>
                                        </form>
                                    </div>
                                </div>

                                <script>
                                    document.getElementById('payrollBtn').addEventListener('click', function() {
                                    document.getElementById('popup').style.display = 'flex';
                                });

                                document.getElementById('closePopup').addEventListener('click', function() {
                                    document.getElementById('popup').style.display = 'none';
                                });
                                </script>
                                </form>
                            </div>

                            <div class="picture">
                                <div class="text-center">
                                    <label>
                                        <img src="/project/uploads/<?= isset($row['picture']) ? $row['picture'] : '' ?>" alt="profile" style="width:100px;height:100px;">
                                    </label>
                                </div>
                                <p>รหัสพนักงาน : <?= isset($row['employee_id']) ? $row['employee_id'] : '' ?></p>
                                <p>แผนก : <a href="#"><?= isset($row['department_name']) ? $row['department_name'] : '' ?></a></p>
                                <p>เริ่มงานวันที่ : <?= isset($row['start_date']) ? $row['start_date'] : '' ?></p>
                                <p>จบงานวันที่ : <?= isset($row['end_date']) ? $row['end_date'] : '' ?></p>
                            </div> 
                        </div>    
                </div>
            </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <?
    ob_end_flush();
    ?>
    </body>
</html>