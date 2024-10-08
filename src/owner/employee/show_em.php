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
                                <th>ตำแหน่งงาน</th>
                                <th>สถานะเงินเดือน</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            
                            <?php
                                // เพิ่มการตรวจสอบ username ในเงื่อนไข SQL
                                $sql = "SELECT e.employee_id, e.picture, e.employee_name, d.department_name, d.salary, s.status FROM employee e LEFT JOIN salary s ON e.employee_id = s.employee_id LEFT JOIN department d ON e.department_id = d.department_id WHERE e.role = 'employee' ORDER BY e.employee_id";
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
                                <td><a href="showmore_em.php?employee_id=<?=$row['employee_id']?>" class="btn btn-warning">เพิ่มเติม</a>
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