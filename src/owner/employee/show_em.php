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
                    <div class="header">พนักงาน</div>
                    <div class="content"> 
                        <table class="table mt-4">
                            <thead class="table-dark ">
                            <tr>
                                <th>รูป</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ตำแหน่งงาน</th>
                                <th>สถานะเงินเดือน</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            
                            <?php
                                // เพิ่มการตรวจสอบ username ในเงื่อนไข SQL
                                $sql = "SELECT e.employee_id, 
                                            e.picture, 
                                            e.employee_name, 
                                            e.sex, 
                                            e.tel, 
                                            e.email, 
                                            e.address, 
                                            d.department_name, 
                                            s.status, 
                                            e.account_name,
                                            e.bank, 
                                            e.account_num, 
                                            e.start_date, 
                                            e.end_date 
                                        FROM employee e 
                                        LEFT JOIN salary s ON e.employee_id = s.employee_id 
                                        LEFT JOIN department d ON e.department_id = d.department_id 
                                        WHERE e.role = 'employee' AND e.end_date IS NULL
                                        ORDER BY e.employee_id";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){ 
                            ?> 

                            <tbody>
                            <tr>
                                <td><img src="/project/uploads/<?php echo htmlspecialchars($row['picture']); ?>" alt="Employee Picture" style="width:100px;height:100px;"></td>
                                <td><?php echo $row['employee_name']; ?></td>
                                <td><?php echo $row['department_name']; ?></td>
                                <td>
                                    <?php if($row['status'] == 'paid'): ?>
                                        <a href="" class="badge bg-success ">จ่ายแล้ว</a>
                                    <?php else: ?>
                                        <a href="" class="badge bg-danger">ยังไม่จ่าย</a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="payment.php?employee_id=<?php echo $row['employee_id']; ?>" class="btn btn-success">ดูข้อมูลเงินเดือน</a>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#employeeModal<?php echo $row['employee_id']; ?>">เพิ่มเติม</button>
                                    <a href="../controller/employee/change_status.php?employee_id=<?php echo $row['employee_id']; ?>" class="btn btn-danger">จบการทำงาน</a>
                                </td>
                            </tr>
                            </tbody>

                            <div class="modal fade" id="employeeModal<?php echo $row['employee_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">ข้อมูลพนักงาน: <?php echo $row['employee_name']; ?></h5>
                                        </div>
                                        <div class="modal-body">
                                            <!-- ข้อมูลทั่วไป -->
                                            <h5>ข้อมูลทั่วไป</h5>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img src="/project/uploads/<?php echo $row['picture']; ?>" class="img-fluid" alt="Employee Picture">
                                                </div>
                                                <div class="row-md-5">
                                                    <p><strong>ชื่อ:</strong> <?php echo $row['employee_name']; ?></p>
                                                    <p><strong>เพศ:</strong> <?php echo $row['sex']; ?></p>
                                                    <p><strong>เบอร์โทร:</strong> <?php echo $row['tel']; ?></p>
                                                    <p><strong>อีเมล:</strong> <?php echo $row['email']; ?></p>
                                                    <p><strong>ที่อยู่:</strong> <?php echo $row['address']; ?></p>
                                                    <hr class="my-4">

                                                    <h5>ข้อมูลธนาคาร</h5>
                                                    <p><strong>ชื่อบัญชี:</strong> <?php echo $row['account_name']; ?></p>
                                                    <p><strong>ธนาคาร:</strong> <?php echo $row['bank']; ?></p>
                                                    <p><strong>เลขบัญชี:</strong> <?php echo $row['account_num']; ?></p>
                                                    <hr class="my-4">

                                                    <!-- ข้อมูลการทำงาน -->
                                                    <h5>ข้อมูลการทำงาน</h5>
                                                    <p><strong>รหัสพนักงาน:</strong> <?php echo $row['employee_id']; ?></p>
                                                    <p><strong>แผนก:</strong> <?php echo $row['department_name']; ?></p>
                                                    <p><strong>วันที่เริ่มงาน:</strong> <?php echo $row['start_date']; ?></p>
                                                    <p><strong>วันที่จบงาน:</strong> <?php echo $row['end_date'] ? $row['end_date'] : 'ยังทำงานอยู่'; ?></p>
                                        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


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