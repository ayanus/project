<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Materials</title>
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
                    <div class="form">

                        <div class="header">
                            <a href="show_pro.php">สินค้า </a>
                            <a1>/</a1>
                            <a2>เพิ่มสินค้า</a2>
                        </div>

                        <div class="row g-4">
                        <div class="col-md-8 col-sm-12">
                            <form action="../controller/products/insert_pro.php" method="post" enctype="multipart/form-data">
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">ชื่อสินค้า</label>
                                        <input type="text" class="form-control" name="product_name" required>                                    
                                    </div>

                                    <div class="col-sm-5">
                                            <label for="formFile" class="form-label">รูปภาพสินค้า</label>
                                            <input type="file" class="form-control" name="picture" accept="image/png, image/jpg,image/jpeg">
                                        </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">ราคา</label>
                                        <input type="number" class="form-control" name="price" required>
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">อายุสินค้า (ปี)</label>
                                        <input type="number" class="form-control" name="product_age" required>
                                    </div>

                                    
                                <button class="btn btn-primary" type="submit">+ เพิ่มข้อมูลสินค้า</button>
                                <hr class="my-4">
                            </form>
                        </div>
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