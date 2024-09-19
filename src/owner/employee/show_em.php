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
                                <th>Username</th>
                                <th>ตำแหน่งงาน</th>
                                <th>เงินเดือน</th>
                                <th>สถานะ</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            
                            <?php
                                // เพิ่มการตรวจสอบ username ในเงื่อนไข SQL
                                $sql = "SELECT * FROM employee, department  WHERE employee.department_id = department.department_id ORDER BY employee_id";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){ 
                            ?>

                            <tbody>
                            <tr>
                                <td><?php echo $row['picture']; ?></td>
                                <td><?php echo $row['employee_name']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['department_name']; ?></td>
                                <td><?php echo $row['salary']; ?></td>
                                <td>
                                    <!-- <?php if($row['status'] == 'paid'): ?>
                                        <span class="badge bg-success">จ่ายแล้ว</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">ยังไม่จ่าย</span>
                                    <?php endif; ?> -->
                                </td>
                                <td><a href="../controller/employee/showall_em.php?employee_id=<?=$row['employee_id']?>" class="btn btn-warning">เพิ่มเติม</a>
                                <a href="../controller/employee/delete_em.php?employee_id=<?=$row['employee_id']?>" class="btn btn-danger" onclick="Del(this.href);return false;">ลบพนักงาน</a></td>
                            </tr>
                            </tbody>
                            
                            <?php 
                                } mysqli_close($conn);
                            ?>

                        </table>
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