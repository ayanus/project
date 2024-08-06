<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Suppliers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
    <body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>
        <div class="main">
        <?php include '../../../public/php/topbar.php'; ?>
    <div class="container">
        <div class="form">

            <div class="alert alert-primary h4 text-center mt-4" role="alert">เพิ่มวัตถุดิบ</div>

            <form action="../controller/suppliers/insert_sup.php" method="post">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" required>
                
                <label for="tel" class="form-label">Tel</label>
                <input type="tel" class="form-control" id="tel" name="tel" required>
                
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
                
                <label for="type" class="form-label mt-4">ประเภทสินค้า</label>
                <select class="form-select" aria-label="Default select example" id="type" name="supplier_type">
                    <?php
                    $sql="SELECT * FROM Type_Mat ORDER BY type_name ";
                    $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                    while($row=mysqli_fetch_array($hand)){
                    ?>
                    <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
                    <?php 
                        } 
                        mysqli_close($conn)
                    ?>
                </select>
                
                <label for="material" class="form-label">ชื่อสินค้า</label>
                <input type="text" class="form-control" id="material_name" name="material_name" required>
                
                <input type="submit" name="1" class="btn btn-primary mt-4" value="Submit">
                <a href="show_sup.php" class="btn btn-secondary mt-4">Cancel</a>          
            </form>
        </div>
    </div>

    <script src="/project/public/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>