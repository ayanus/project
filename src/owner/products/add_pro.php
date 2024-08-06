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
</head>
<body>
    <div class="container">
        <div class="form">

            <div class="alert alert-primary h4 text-center mt-4" role="alert">เพิ่มสินค้า</div>

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
</body>
</html>