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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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

                        <div class="header"><a href="show_sup.php"><ion-icon name="chevron-back-outline"></ion-icon></a>เพิ่มผู้จัดจำหน่าย</div>
                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="../controller/suppliers/insert_sup.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-4">
                                            <label class="form-label">ชื่อสถานประกอบการณ์</label>
                                            <input type="text" class="form-control" name="supplier_name" required>
                                        </div>

                                        <div class="col-sm-6">
                                            <label class="form-label">ที่อยู่</label>
                                            <textarea class="form-control" name="address" row="3" required></textarea>
                                        </div>

                                        <div class="col-sm-4">
                                            <label class="form-label">ตัวแทนจัดจำหน่าย (ชื่อ - สกุล)</label>
                                            <input type="text" class="form-control" name="company" required>
                                        </div>

                                        <div class="col-sm-5">
                                            <label for="formFile" class="form-label">รูปภาพผู้จัดจำหน่าย</label>
                                            <input type="file" class="form-control" name="supplier_img" accept="image/png, image/jpg,image/jpeg">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label">เบอร์โทร</label>
                                            <input type="text" class="form-control" name="tel" required>
                                        </div>

                                    </div>
                                    <hr class="my-4">

                                    <div class="form-check">                                        
                                        <h3>สินค้าที่จำหน่าย</h3>
                                        <div class="row">
                                            <?php
                                                $sql = "SELECT m.material_id, m.material_name, m.material_img, t.type_id, t.type_name 
                                                        FROM materials m
                                                        JOIN type_mat t ON m.type_id = t.type_id
                                                        ORDER BY m.type_id";
                                                $result = mysqli_query($conn, $sql);


                                                // ตรวจสอบว่ามีข้อมูลหรือไม่
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <div class="col-sm-4 mb-3"> <!-- กำหนดคอลัมน์ที่ต้องการ (3 คอลัมน์ต่อแถว) --> 
                                                            <div class="form-check">                                                           
                                                                <input class="form-check-input" type="checkbox" id="flexCheck<?=$row['material_id']?>" name="materials[<?=$row['material_id']?>]" value="<?=$row['type_id']?>">
                                                                <label class="form-check-label" for="flexCheck<?=$row['material_id']?>">
                                                                    <img src="/project/uploads/<?=$row['material_img']?>" alt="<?=$row['material_name']?>" style="width: 100px; height: 100px; margin-right: 8px; border-radius:5%;">
                                                                    <?=$row['material_name']?> <div><small class="text text-muted"><?=$row['type_name']?></small></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                } else {
                                                    echo "ไม่มีสินค้าที่จะแสดง";
                                                }
                                            ?>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                </form>
                            </div>
                        </div>
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