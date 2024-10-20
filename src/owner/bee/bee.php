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
                    <div class="header">ข้อมูลผึ้ง</div>

                    <a href="add_data_bee.php"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่มผลผลิต</button></a>
                    <a href="add_bee.php"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">เพิ่มสายพันธุ์ผึ้ง</button></a>
                      
                    <div class="d-flex flex-row gap-3 justify-content-center">
                        <?php
                            $sql = "
                            SELECT bee.bee_id, bee.bee_name, SUM(bee.quantity) AS total_quantity, 
                            GROUP_CONCAT(DISTINCT bee_food SEPARATOR ', ') AS food_list, 
                            type_bee.* FROM bee 
                            INNER JOIN type_bee ON bee.bee_name = type_bee.bee_name 
                            GROUP BY bee.bee_name 
                            ORDER BY type_bee.bee_name";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result)){ 
                        ?>
                            <div class="card mb-3" style="max-width: 500px;">
                                <div class="row g-2">
                                    <div class="col-md-7">
                                        <img src="/project/img-product/ผึ้งชันโรง.jpg" class="img-fluid rounded-start" alt="..." style="height:200px;">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $row['bee_name']; ?></h5>
                                            <h1 class="card-text text-center"><?php echo $row['total_quantity']; ?> ลัง</h1>
                                            <h5 class="card-text">อาหารที่ใช้เลี้ยง</h5>
                                            <p class="food-list">
                                                <?php echo htmlspecialchars($row['food_list']); ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php } ?>  
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="bee.php">ข้อมูลผึ้ง</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="true" href="show_bee.php">ข้อมูลผลผลิตจากผึ้ง</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="true" href="product_bee.php">ผลผลิตจากผึ้ง</a>
                            </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="table-dark">
                                    <tr>
                                        <th>รหัสลังผึ้ง</th>
                                        <th>สายพันธุ์ผึ้ง</th>
                                        <th>อาหารที่ใช้เลี้ยง</th>
                                        <th>สถานที่เลี้ยง</th>
                                        <th> </th>
                                    </tr>
                                </thead>

                                <?php
                            

                                    $sql = "SELECT * FROM bee";

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
                                        <td><?php echo $row['bee_id']; ?></td>
                                        <td><?php echo $row['bee_name']; ?></td>
                                        <td><?php echo $row['bee_food']; ?></td>
                                        <td><?php echo $row['bee_detail']; ?></td>
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
