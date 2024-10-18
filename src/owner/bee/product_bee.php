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
                                        <th>สายพันธุ์ผึ้ง</th>
                                        <th>อาหารที่ใช้เลี้ยง</th>
                                        <th> </th>
                                    </tr>
                                </thead>

                                <?php
                            

                                $sql = "SELECT 
        CASE 
            -- ถ้าเป็นน้ำผึ้ง ให้แยกตามสายพันธุ์ผึ้งและอาหาร
            WHEN pb.product_bee_name = 'น้ำผึ้ง' THEN CONCAT(b.bee_name, ' (อาหาร: ', b.bee_food, ')')
            -- สำหรับผลผลิตชนิดอื่น (โพรพอลิส, ไขผึ้ง, นมผึ้ง) ให้รวมตามชื่อของผลผลิต
            ELSE pb.product_bee_name 
        END AS product_type,  
        SUM(bk.quantity) AS total_quantity,  -- รวมจำนวนสินค้า
        bk.unit, b.bee_name, b.bee_id, b.bee_food, bk.unit, pb.product_bee_name
    FROM bee b
    JOIN Beekeep_detail bk ON b.bee_id = bk.bee_id
    JOIN product_bee pb ON pb.product_bee_id = bk.product_bee_id
    WHERE pb.product_bee_name IN ('น้ำผึ้ง', 'โพรพอลิส', 'ไขผึ้ง', 'นมผึ้ง')  -- กรองเฉพาะผลผลิตที่ต้องการ
    GROUP BY 
        CASE 
            -- จัดกลุ่มสำหรับน้ำผึ้ง (แยกตามสายพันธุ์ผึ้งและอาหาร)
            WHEN pb.product_bee_name = 'น้ำผึ้ง' THEN CONCAT(b.bee_name, ' (อาหาร: ', b.bee_food, ')')
            -- จัดกลุ่มสำหรับผลผลิตอื่น ๆ (ตามชื่อของผลผลิต)
            ELSE pb.product_bee_name 
        END
    ORDER BY product_type;
";

                                    // เพิ่มการเรียงลำดับตามสายพันธุ์ผึ้ง
                                    // $sql .= "GROUP BY bee.bee_name, bee.bee_food ORDER BY type_bee.bee_name";

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
                                        <td><?php echo $row['product_bee_name']; ?></td>
                                        <td><?php echo $row['total_quantity'] . ' ' . $row['unit']; ?></td>                                        
                                        <td><?php echo $row['bee_name']; ?></td>
                                        <td><?php echo $row['bee_food']; ?></td>
                                        <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#beeModal<?php echo $row['bee_id']; ?>">รายละเอียด</button></td>
                                    </tr>
                                </tbody>
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
