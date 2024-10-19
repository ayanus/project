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

                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="update.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="material_id" value="<?= isset($row['material_id']) ? $row['material_id'] : '' ?>">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-2">
                                            <label class="form-label">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="material_name" value="<?= isset($row['material_name']) ? $row['material_name'] : '' ?>">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label">ประเภท</label>
                                            <select class="form-select" aria-label="Default select example" id="type" name="type_id">
                                                <?php
                                                $sql="SELECT * FROM Type_Mat ORDER BY type_name ";
                                                $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                                while($typerow=mysqli_fetch_array($hand)){
                                                ?>
                                                <option value="<?=$typerow['type_id']?>"><?=$typerow['type_name']?></option>
                                                <?php 
                                                    } 
                                                ?>
                                            </select>                                    
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">รายละเอียด</label>
                                            <textarea class="form-control" name="material_detail" rows="2"><?= isset($row['material_detail']) ? $row['material_detail'] : '' ?></textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" name="1" type="submit">อัปเดต</button>
                                    <a href="../../materials/show_mat.php"><button class="btn btn-secondary" type="button">ยกเลิก</button></a>
                                    <hr class="my-4">
                                </form>
                            </div>
                        </div>



                            
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

