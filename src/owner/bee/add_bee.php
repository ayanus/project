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
                <div class="header">ข้อมูลลังผึ้งใหม่</div>

                    <div class="row g-4">
                        <div class="col-md-8 col-sm-12">
                            <form action="../controller/bee/insert_bee.php" method="post" enctype="multipart/form-data">
                                <div class="row g-3 mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">สายพันธุ์ผึ้ง</label>
                                        <select class="form-select" aria-label="Default select example" id="type" name="bee_name">
                                            <?php
                                            $sql="SELECT * FROM Type_bee ORDER BY bee_name ";
                                            $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                            while($row=mysqli_fetch_array($hand)){
                                            ?>
                                            <option value="<?=$row['bee_name']?>"><?=$row['bee_name'] ?></option>
                                            <?php 
                                                } 
                                            ?>
                                        </select>                                    
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">จำนวน(ลัง)</label>
                                        <input type="text" class="form-control" name="quantity" required>
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">อาหารที่ใช้เลี้ยง</label>
                                        <select class="form-select" aria-label="Default select example" id="type" name="bee_food">
                                            <?php
                                            $sql="SELECT * FROM beefood ORDER BY food_name ";
                                            $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                            while($row=mysqli_fetch_array($hand)){
                                            ?>
                                            <option value="<?=$row['food_name']?>"><?=$row['food_name'] ?></option>
                                            <?php 
                                                } 
                                            ?>
                                        </select>                                    
                                    </div>

                                    <div class="col-sm-5">
                                        <label class="form-label">สถานที่เลี้ยง</label>
                                        <textarea class="form-control" name="bee_detail" row="2" required></textarea>
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">+ เพิ่มข้อมูลผึ้ง</button>
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
