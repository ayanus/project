<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['employee_id'];
    $sql="SELECT * FROM employee WHERE employee_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
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
        </div>
        
            <div class="main">
                <div class="container">    
                    <div class="header"><a href="show_em.php"><ion-icon name="chevron-back-outline"></ion-icon></a>ข้อมูลเพิ่มเติม</div>
                        <div class="content">
                            <div class="data">
                                <h4 class="pb-3">ข้อมูลทั่วไป</h4>
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

                                <h4 class="pb-3 pt-4">ข้อมูลธนาคาร</h4>
                                <div class="row mb-3 mt-2 ml-6">
                                    <div class="col-auto">
                                        <label class="col-form-label ">ชื่อบัญชี</label>
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

<script language="Javascript">
    function Del(mypage){
        var agree=confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?");
        if(agree){
            window.location = mypage;
        }
    }
</script>