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
    <script>
        // JavaScript สำหรับซ่อนหรือแสดงประเภทผึ้งและอาหารผึ้ง
        function toggleBeeFields() {
            const productSelect = document.getElementById("product_id");
            const beeFields = document.getElementById("beeFields");
            const selectedProduct = productSelect.options[productSelect.selectedIndex].text;

            if (selectedProduct.includes("น้ำผึ้ง")) {
                beeFields.style.display = "block";
            } else {
                beeFields.style.display = "none";
            }
        }
    </script>
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

                    <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link " aria-current="true" href="show_production.php">ประวัติการผลิตสินค้า</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" href="add_production.php">เพิ่มสินค้าที่ต้องการผลิต</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="show_cart_production.php">สินค้าที่จะผลิต (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></a>
                                </li>
                                </ul>
                            </div>

                            <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="../controller/production/insert_production.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-12">
                                            <label for="product_id" class="form-label">สินค้าที่ต้องการผลิต</label>
                                            <select class="form-select" aria-label="Default select example" id="product_id" name="product_id" onchange="toggleBeeFields()">
                                            <?php while ($product = $products_result->fetch_assoc()): ?>
                                                <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                                            <?php endwhile; ?>
                                            </select>                                  
                                        </div>

                                        <div id="beeFields" style="display: none;">
                                            <div class="row g-3">
                                                <div class="col-sm-3">
                                                    <label for="type_bee_id" class="form-label">ประเภทผึ้ง</label>
                                                    <select class="form-select" aria-label="Default select example" id="type_bee_id" name="type_bee_id">
                                                    <?php while ($bee = $type_bees_result->fetch_assoc()): ?>
                                                        <option value="<?= $bee['type_bee_id'] ?>"><?= $bee['bee_name'] ?></option>
                                                    <?php endwhile; ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-3">
                                                    <label for="food_id" class="form-label">อาหารผึ้ง</label>
                                                    <select class="form-select" aria-label="Default select example" id="food_id" name="food_id">
                                                        <?php while ($food = $beefoods_result->fetch_assoc()): ?>
                                                            <option value="<?= $food['food_id'] ?>"><?= $food['food_name'] ?></option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="product_bee_id" class="form-label">วัตถุดิบที่ต้องใช้</label>
                                            <select class="form-select" aria-label="Default select example" id="product_bee_id" name="product_bee_id">
                                            <?php while ($products_bee = $products_bee_result->fetch_assoc()): ?>
                                                <option value="<?= $products_bee['product_bee_id'] ?>"><?= $products_bee['product_bee_name'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="material_id" class="form-label">บรรจุภัณฑ์</label>
                                            <select class="form-select" aria-label="Default select example" id="material_id" name="material_id">
                                            <?php while ($materials = $materials_result->fetch_assoc()): ?>
                                                <option value="<?= $materials['material_id'] ?>"><?= $materials['material_name'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="quantity" class="form-label">จำนวนที่ต้องการผลิต (แพ็ค)</label>
                                            <input type="number" class="form-control" step="0.01" id="quantity" name="quantity" required> 
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="production_date" class="form-label">วันที่ผลิต</label>
                                            <input type="date" class="form-control" step="0.01" id="production_date" name="production_date" required>
                                        </div>

                                        <div class="col-sm-4">
                                            <label for="employee_id" class="form-label">พนักงานผู้คุมการผลิต</label>
                                            <select class="form-select" aria-label="Default select example" id="employee_id" name="employee_id">
                                            <?php while ($employee = $employee_result->fetch_assoc()): ?>
                                                <option value="<?= $employee['employee_id'] ?>"><?= $employee['employee_name'] ?></option>
                                            <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <a href="cart_production.php?product_id=<?php echo $product['product_id']?>" class="btn btn-primary mt-2 w-100">เพิ่มลงตะกร้า</a>
                                    <hr class="my-4">
                                </form>
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