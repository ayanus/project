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
        <?php include '../../../public/php/nav_em.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar_em.php'; ?>
        </div>
            <div class="main">
                <div class="container">
                    <div class="header">ผลิตสินค้า</div>

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" href="show_production.php">ประวัติการผลิตสินค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="true" href="add_production.php">เพิ่มสินค้าที่ต้องการผลิต</a>
                                </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <table class="table mt-4">
                                    <thead class="table-dark">
                                    <tr>
                                        <th>วันที่ผลิตสินค้า</th>
                                        <th>รายการ</th>
                                        <th>จำนวน</th>
                                        <th>ผู้คุมการผลิต</th>
                                    </tr>
                                    </thead>
                                    
                                    <?php
                                        $sql = "SELECT production.production_id, production.production_date, products.product_name , products.product_id , productiondetail.quantity , productiondetail.production_id, production.employee_id, employee.employee_id, employee.employee_name
                                        FROM production 
                                        JOIN productiondetail ON production.production_id = productiondetail.production_id
                                        JOIN products ON products.product_id = productiondetail.product_id
                                        JOIN employee ON production.employee_id = employee.employee_id";
                                        $result = mysqli_query($conn, $sql);
                                    if ($result) { // ตรวจสอบว่าคำสั่ง SQL สำเร็จหรือไม่
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){ 
                                            ?>
                                            <tr>
                                                <td><?php echo $row['production_date']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td><?php echo $row['quantity']; ?></td>
                                                <td><?php echo $row['employee_name']; ?></td> <!-- เปลี่ยนจาก 'employee' เป็น 'employee_name' -->
                                            </tr>
                                            <?php
                                        }
                                        echo "</tbody>";
                                    } else {
                                        echo "Error: " . mysqli_error($conn); // แสดงข้อผิดพลาดถ้ามี
                                    }
                                    ?>

                                </table>
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