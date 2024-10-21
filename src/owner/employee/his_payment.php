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
                    <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="true" href="show_em.php">ข้อมูลพนักงาน</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" href="his_payment.php">ประวัติการจ่ายเงินเดือน</a>
                                </li>
                                </ul>
                            </div>
                            <div class="card-body">
                        <table class="table mt-4">
                            <thead class="table-dark ">
                            <tr>
                                <th>วันที่</th>
                                <th>ชื่อ - สกุล</th>
                                <th>ตำแหน่งงาน</th>
                                <th>จำนวนเงิน</th>
                                <th>สถานะทำงาน</th>
                                <th> </th>
                            </tr>
                            </thead>
                            
                            <?php
                                // เพิ่มการตรวจสอบ username ในเงื่อนไข SQL
                                $sql = "SELECT e.employee_name , s.salary , d.department_name, s.date
                                        FROM employee e 
                                        LEFT JOIN salary s ON e.employee_id = s.employee_id 
                                        LEFT JOIN department d ON e.department_id = d.department_id 
                                        WHERE e.role = 'employee' and s.salary_id IS NOT NULL
                                        ORDER BY s.date DESC";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){ 
                            ?> 

                            <tbody>
                            <tr>
                                <td><?php echo $row['date']; ?></td>
                                <td><?php echo $row['employee_name']; ?></td>
                                <td><?php echo $row['department_name']; ?></td></td>
                                <td><?php echo $row['salary']; ?></td>
                                <td>
                                    <?php 
                                    // ตรวจสอบว่า end_date เป็นค่าว่างหรือไม่
                                    if (empty($row['end_date'])) {
                                        echo "ทำงาน"; // หาก end_date เป็นค่าว่าง
                                    } else {
                                        echo "พ้นสภาพพนักงาน"; // หาก end_date มีค่า
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                            <?php } ?>
                            

                        </table>
                            </div>
                    </div>
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