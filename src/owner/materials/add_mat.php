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
                    <div class="header">เพิ่มอุปกรณ์และวัตถุดิบ</div>
                    <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="../controller/materials/insert_mat.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อวัตถุดิบและอุปกรณ์</label>
                                            <input type="text" class="form-control" name="material_name" required>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label">ประเภท</label>
                                            <select class="form-select" aria-label="Default select example" id="type" name="type_id">
                                                <?php
                                                $sql="SELECT * FROM Type_Mat ORDER BY type_name ";
                                                $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                                while($row=mysqli_fetch_array($hand)){
                                                ?>
                                                <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
                                                <?php 
                                                    } 
                                                ?>
                                            </select>                                    
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="form-label">ราคา (ต่อ 1 หน่วย)</label>
                                            <input type="text" class="form-control" name="price" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="formFile" class="form-label">รูปภาพ</label>
                                            <input type="file" class="form-control" name="material_img" accept="image/png, image/jpg,image/jpeg">
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label">รายละเอียด</label>
                                            <textarea class="form-control" name="material_detail" row="3" required></textarea>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                    <button class="btn btn-danger" type="reset">ยกเลิก</button>
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

<script language="Javascript">
    function Del(mypage){
        var agree=confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?");
        if(agree){
            window.location = mypage;
        }
    }
</script>