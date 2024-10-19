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
                                    <a class="nav-link active" aria-current="true" href="show_production.php">ประวัติการผลิตสินค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="true" href="add_production.php">เพิ่มสินค้าที่ต้องการผลิต</a>
                                </li>
                                </ul>
                            </div>

                            <div class="card-body">
                        
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