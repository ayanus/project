<?php 
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['material_id'];
    $sql="SELECT * FROM materials WHERE material_id = $id";
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
        </div>
        
        <div class="main">
            <div class="container"> 
        <div class="form">

                    <div class="header">
                    <a href="../../../owner/materials/show_mat.php">วัตถุดิบ </a>
                        <a1>/</a1>
                        <a2>แก้ไขข้อมูลวัตถุดิบ</a2>
                    </div>

                    <div class="content">
                        <form action="update_mat.php" method="post">
                            <input type="hidden" name="material_id" value="<?= isset($row['material_id']) ? $row['material_id'] : '' ?>">
                            
                            <label for="name" class="form-label">ชื่อสินค้า</label>
                                <input type="text" class="form-control" id="name" name="material_name" value="<?= isset($row['material_name']) ? $row['material_name'] : '' ?>">
                            
                            <label for="type" class="form-label mt-4">ประเภทสินค้า</label>
                                <select class="form-select" aria-label="Default select example" id="type" name="material_type">
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

                            <label for="Quantity" class="form-label mt-4">จำนวนคงเหลือ</label>
                                <input type="text" class="form-control" id="quantity" name="quantity" value="<?= isset($row['quantity']) ? $row['quantity'] : '' ?>">

                            <label for="unit" class="form-label mt-4">หน่วย</label>
                                <input type="text" class="form-control" id="unit" name="material_unit" value="<?= isset($row['material_unit']) ? $row['material_unit'] : '' ?>">

                                <input type="submit" name="1" class="btn btn-primary mt-4" value="อัปเดต">
                                <a href="../../materials/show_mat.php" class="btn btn-secondary mt-4">ยกเลิก</a>          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/project/public/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>
</html>

