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
        <?php include '../../../public/php/nav.php'; ?>
        
        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>
        
            <div class="main">
                <div class="container">
                    <div class="form">

                        <div class="header">
                            <a href="show_pro.php">สินค้า </a>
                            <a1>/</a1>
                            <a2>เพิ่มสินค้า</a2>
                        </div>

                        <div class="content">
                            <form action="../controller/products/insert_pro.php" method="post">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="product_name" required>
                                
                                <label for="Quantity" class="form-label mt-4">picture</label>
                                <input type="file" class="form-control" id="picture" name="picture" accept="image/*" required>

                                <label for="Quantity" class="form-label mt-4">price</label>
                                <input type="text" class="form-control" id="price" name="price" required>

                                <label for="Quantity" class="form-label mt-4">quantity</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" required>

                                <input type="submit" name="1" class="btn btn-primary mt-4" value="Submit">
                                <a href="show_pro.php" class="btn btn-secondary mt-4">Cancel</a>          
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