<?php 
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['supplier_id'];
    $sql="SELECT * FROM supplier WHERE supplier_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
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
        <?php include '../../../../public/php/nav.php'; ?>
        
        <div class="top">
        <?php include '../../../../public/php/topbar.php'; ?>
        
        <div class="main">
            <div class="container"> 
        <div class="form">

                    <div class="header">
                    <a href="../../../owner/suppliers/show_sup.php">Suppliers</a>
                        <a1>/</a1>
                        <a2>แก้ไขข้อมูล Supplier</a2>
                    </div>

                    <div class="content">
                        <form action="update_sup.php" method="post">
                            <input type="hidden" name="supplier_id" value="<?= isset($row['supplier_id']) ? $row['supplier_id'] : '' ?>">
                            
                            <label for="name" class="form-label">ชื่อ - สกุล</label>
                                <input type="text" class="form-control" id="name" name="supplier_name" value="<?= isset($row['supplier_name']) ? $row['supplier_name'] : '' ?>">

                            <label for="tel" class="form-label mt-4">เบอร์โทร</label>
                                <input type="tel" class="form-control" id="tel" name="tel" value="<?= isset($row['tel']) ? $row['tel'] : '' ?>">

                            <label for="address" class="form-label mt-4">ที่อยุ่</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= isset($row['address']) ? $row['address'] : '' ?>">

                             <label for="material" class="form-label mt-4">สินค้า</label>
                                <input type="text" class="form-control" id="material_name" name="material_name" value="<?= isset($row['material_name']) ? $row['material_name'] : '' ?>">
                            
                                <input type="submit" name="1" class="btn btn-primary mt-4" value="อัพเดต">
                                <a href="../../suppliers/show_sup.php" class="btn btn-secondary mt-4">ยกเลิก</a>          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/project/public/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>
</html>

