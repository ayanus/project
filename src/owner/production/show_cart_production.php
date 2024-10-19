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
        <?php
        // ดึงข้อมูลสินค้าผลิตภัณฑ์จากฐานข้อมูล
        $products_sql = "SELECT product_id, product_name FROM products";
        $products_result = $conn->query($products_sql);

        // ดึงข้อมูลผลผลิตผึ้งจากฐานข้อมูล
        $products_bee_sql = "SELECT product_bee_id, product_bee_name FROM product_bee";
        $products_bee_result = $conn->query($products_bee_sql);

        // ดึงข้อมูลประเภทผึ้งจากฐานข้อมูล
        $type_bees_sql = "SELECT type_bee_id, bee_name FROM type_bee";
        $type_bees_result = $conn->query($type_bees_sql);

        // ดึงข้อมูลอาหารผึ้งจากฐานข้อมูล
        $beefoods_sql = "SELECT food_id, food_name FROM beefood";
        $beefoods_result = $conn->query($beefoods_sql);

        // ดึงข้อมูลอุปกรณ์บรรจุจากฐานข้อมูล
        $materials_sql = "SELECT material_id, material_name FROM materials";
        $materials_result = $conn->query($materials_sql);

        // ดึงข้อมูลพนักงานจากฐานข้อมูล
        $employee_sql = "SELECT employee_id, employee_name FROM employee";
        $employee_result = $conn->query($employee_sql);
        ?>           
            <div class="main">
                <div class="container">
                    <div class="header">ผลิตสินค้า</div>
                    <?php if(!empty($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="true" href="show_production.php">ประวัติการผลิตสินค้า</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add_production.php">เพิ่มสินค้าที่ต้องการผลิต</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="show_cart_production.php">สินค้าที่จะผลิต (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ชื่อสินค้า</th>
                                    <th>ประเภทผึ้ง</th>
                                    <th>อาหารผึ้ง</th>
                                    <th>วัตถุดิบที่ใช้</th>
                                    <th>บรรจุภัณฑ์</th>
                                    <th>จำนวน (แพ็ค)</th>
                                    <th>วันที่ผลิต</th>
                                    <th>พนักงาน</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['cart'] as $item): ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                // ดึงชื่อสินค้าจากฐานข้อมูล
                                                $product_sql = "SELECT product_name FROM products WHERE product_id = ?";
                                                $stmt = $conn->prepare($product_sql);
                                                $stmt->bind_param("i", $item['product_id']);
                                                $stmt->execute();
                                                $product_result = $stmt->get_result();
                                                $product = $product_result->fetch_assoc();
                                                echo $product['product_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                // ถ้ามีประเภทผึ้งแสดงประเภทผึ้ง
                                                if (!empty($item['type_bee_id'])) {
                                                    $bee_sql = "SELECT bee_name FROM type_bee WHERE type_bee_id = ?";
                                                    $stmt = $conn->prepare($bee_sql);
                                                    $stmt->bind_param("i", $item['type_bee_id']);
                                                    $stmt->execute();
                                                    $bee_result = $stmt->get_result();
                                                    $bee = $bee_result->fetch_assoc();
                                                    echo $bee['bee_name'];
                                                } else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                // ถ้ามีอาหารผึ้งแสดงอาหารผึ้ง
                                                if (!empty($item['food_id'])) {
                                                    $food_sql = "SELECT food_name FROM beefood WHERE food_id = ?";
                                                    $stmt = $conn->prepare($food_sql);
                                                    $stmt->bind_param("i", $item['food_id']);
                                                    $stmt->execute();
                                                    $food_result = $stmt->get_result();
                                                    $food = $food_result->fetch_assoc();
                                                    echo $food['food_name'];
                                                } else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                // แสดงวัตถุดิบที่ใช้
                                                $product_bee_sql = "SELECT product_bee_name FROM product_bee WHERE product_bee_id = ?";
                                                $stmt = $conn->prepare($product_bee_sql);
                                                $stmt->bind_param("i", $item['product_bee_id']);
                                                $stmt->execute();
                                                $product_bee_result = $stmt->get_result();
                                                $product_bee = $product_bee_result->fetch_assoc();
                                                echo $product_bee['product_bee_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                // แสดงบรรจุภัณฑ์
                                                $material_sql = "SELECT material_name FROM materials WHERE material_id = ?";
                                                $stmt = $conn->prepare($material_sql);
                                                $stmt->bind_param("i", $item['material_id']);
                                                $stmt->execute();
                                                $material_result = $stmt->get_result();
                                                $material = $material_result->fetch_assoc();
                                                echo $material['material_name'];
                                            ?>
                                        </td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td><?php echo $item['production_date']; ?></td>
                                        <td>
                                            <?php 
                                                // แสดงพนักงาน
                                                $employee_sql = "SELECT employee_name FROM employee WHERE employee_id = ?";
                                                $stmt = $conn->prepare($employee_sql);
                                                $stmt->bind_param("i", $item['employee_id']);
                                                $stmt->execute();
                                                $employee_result = $stmt->get_result();
                                                $employee = $employee_result->fetch_assoc();
                                                echo $employee['employee_name'];
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>ยังไม่มีสินค้าในตะกร้า</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>