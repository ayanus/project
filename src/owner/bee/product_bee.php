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
                    <div class="header"><a href="show_bee.php"><ion-icon name="chevron-back-outline"></ion-icon></a>เพิ่มผลผลิตจากผึ้ง</div>

                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="true" href="show_bee.php">ข้อมูลผึ้ง</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="product_bee.php">ผลผลิตจากผึ้ง</a>
                            </li>
                            </ul>
                        </div>

                        <div class="card-body">
                        <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ผลผลิต</th>
                                        <th>จำนวนรวมในคลัง</th>
                                        <th>หน่วย</th>
                                        <th> </th>
                                    </tr>
                                </thead>

                                <?php
                            

                                $sql = "SELECT CASE WHEN pb.product_bee_name = 'น้ำผึ้ง' THEN CONCAT(b.bee_name, ' (อาหาร: ', b.bee_food, ')')
                                                ELSE pb.product_bee_name END AS product_type, SUM(bk.quantity) AS total_quantity,
                                                bk.unit, b.bee_name, b.bee_id, b.bee_food, bk.unit, pb.product_bee_name, pb.product_bee_id , bk.date
                                        FROM bee b
                                        JOIN Beekeep_detail bk ON b.bee_id = bk.bee_id
                                        JOIN product_bee pb ON pb.product_bee_id = bk.product_bee_id
                                        WHERE pb.product_bee_name IN ('น้ำผึ้ง', 'โพรพอลิส', 'ไขผึ้ง', 'นมผึ้ง', 'เกสรผึ้ง')  -- กรองเฉพาะผลผลิตที่ต้องการ
                                        GROUP BY CASE WHEN pb.product_bee_name = 'น้ำผึ้ง' THEN CONCAT(b.bee_name, ' (อาหาร: ', b.bee_food, ')')
                                                    ELSE pb.product_bee_name END ORDER BY product_bee_id;
                                    ";

                                    $result = mysqli_query($conn, $sql);

                                    // ตรวจสอบว่ามีข้อมูลหรือไม่
                                    if (!$result) {
                                        die("Error: " . mysqli_error($conn));
                                    }

                                    // แสดงผลข้อมูล
                                    while ($row = mysqli_fetch_array($result)) {
                                        // การแสดงผลตามข้อมูลที่ดึงมา

                                    ?>

                                
                                <tbody>
                                    <tr>
                                        <td><?php echo $row['product_bee_name']; ?>
                                        <?php if ($row['product_bee_name'] == 'น้ำผึ้ง') { ?>
                                            <div>
                                                <small class="text-muted"><?php echo $row['bee_name']; ?></small> ,
                                                <small class="text-muted"><?php echo $row['bee_food']; ?></small>
                                            </div>
                                        <?php } ?>
                                    </td>
                                        <td><?php echo $row['total_quantity']; ?></td>
                                        <td><?php echo $row['unit']; ?></td>                                                                             
                                        <!-- <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#probeeModal<?php echo $row['product_bee_id']; ?>">รายละเอียด</button></td> -->
                                        <!-- ปุ่มเปิด Modal ที่ส่งค่า bee_id และ product_bee_id -->
<td>
    <a href="#" data-bs-toggle="modal" data-bs-target="#viewDetailsModal" 
        data-bee-id="<?php echo $row['bee_id']; ?>" 
        data-product-id="<?php echo $row['product_bee_id']; ?>" class="btn btn-primary">
        รายละเอียด
    </a>
</td>

<!-- Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รายละเอียด</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- ตำแหน่งที่ข้อมูลจาก AJAX จะถูกแสดง -->
                <p>กำลังโหลดข้อมูล...</p>
            </div>
        </div>
    </div>
</div>

<script>
    var viewDetailsModal = document.getElementById('viewDetailsModal');
    viewDetailsModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // ปุ่มที่ถูกกด
        var beeId = button.getAttribute('data-bee-id'); // ดึงค่า bee_id
        var productId = button.getAttribute('data-product-id'); // ดึงค่า product_bee_id

        var modalBody = viewDetailsModal.querySelector('.modal-body');

        // ทำการส่งค่า bee_id และ product_bee_id ไปยัง PHP ผ่าน AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../controller/bee/fetch_data.php?bee_id=" + beeId + "&product_id=" + productId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                modalBody.innerHTML = xhr.responseText; // แสดงข้อมูลที่ดึงมาใน modal
            } else if (xhr.readyState == 4) {
                modalBody.innerHTML = "ไม่พบข้อมูล";
            }
        };
        xhr.send();
    });
</script>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    }
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
