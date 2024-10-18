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
                    <div class="header"><a href="show_bee.php"><ion-icon name="chevron-back-outline"></ion-icon></a>เพิ่มผลผลิตจากผึ้ง</div>
                    <div class="row g-4">
                        <div class="col-md-8 col-sm-12">
                            <form action="../controller/bee/insert_productbee.php" method="post" enctype="multipart/form-data">
                            <div class="row g-3 mb-3">
                                    <div class="col-sm-3">
                                        <label class="form-label">รหัสลังผึ้ง</label> 
                                        <select class="form-select" aria-label="Default select example" id="type" name="bee_id" onchange="fetchBeeData(this.value)">
                                                <option value="">เลือก</option>
                                                <?php
                                                $sql="SELECT * FROM bee ORDER BY bee_id ";
                                                $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                                while($row=mysqli_fetch_array($hand)){
                                                ?>
                                                <option value="<?=$row['bee_id']?>"><?=$row['bee_id']?></option>
                                                <?php 
                                                    } 
                                                ?>
                                            </select> 
                                    </div>

                                    <script>
                                        function fetchBeeData(bee_id) {
                                            if (bee_id === "") {
                                                document.getElementById("bee_name").value = "";
                                                document.getElementById("bee_food").value = "";
                                                return;
                                            }

                                            // สร้าง XMLHttpRequest เพื่อดึงข้อมูล
                                            var xhr = new XMLHttpRequest();
                                            xhr.onreadystatechange = function () {
                                                if (this.readyState === 4 && this.status === 200) {
                                                    // แสดงผลลัพธ์ที่ได้จาก PHP
                                                    var result = JSON.parse(this.responseText);
                                                    document.getElementById("bee_name").value = result.bee_name;
                                                    document.getElementById("bee_food").value = result.bee_food;
                                                }
                                            };
                                            xhr.open("GET", "get_bee_data.php?bee_id=" + bee_id, true);
                                            xhr.send();
                                        }
                                    </script>

                                    <div class="col-sm-3">
                                        <label class="form-label">สายพันธุ์ผึ้ง</label>
                                        <input type="text" class="form-control" id="bee_name" name="bee_name" readonly>                                  
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="form-label">อาหารผึ้ง</label>
                                        <input type="text" class="form-control" id="bee_food" name="bee_food" readonly>                                
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="form-label">วันที่เก็บผลผลิต</label>
                                        <input type="date" class="form-control" name="date" required>                                
                                    </div>
                                

                                    <h6 style="font-weight:bold;">ผลผลิตจากผึ้ง</h6>
                                    <table class="table">
                                        <thead class="table-borderless">
                                            <tr>
                                                <th>รายการ</th>
                                                <th>จำนวน</th></th>
                                                <th>หน่วย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            // ดึงข้อมูลผลผลิตจากฐานข้อมูล
                                            $sql = "SELECT product_bee_name, unit, product_bee_id  FROM product_bee";
                                            $result = mysqli_query($conn, $sql);

                                            // ลูปแสดงข้อมูลผลผลิต
                                            while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <!-- แสดงชื่อผลผลิต -->
                                            <td><input type="text" class="form-control" name="product_bee_id[]" value="<?= htmlspecialchars($row['product_bee_id'] . ' . ' . $row['product_bee_name'] . ''); ?>" readonly></td>
                                            
                                            <!-- ช่องกรอกจำนวน -->
                                            <td><input type="number"  class="form-control" name="quantity[]" required></td>
                                            
                                            <!-- หน่วยผลผลิต -->
                                            <td><input type="text" class="form-control" name="unit[]" value="<?= htmlspecialchars($row['unit']); ?>" readonly></td>

                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>  
                                    
                                    <div class="col-sm-3">
                                        <label class="form-label">ผู้บันทึก</label>  
                                        <select class="form-select" aria-label="Default select example" id="type" name="employee_id">
                                            <?php
                                            $sql="SELECT * FROM employee ORDER BY employee_id ";
                                            $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                            while($row=mysqli_fetch_array($hand)){
                                            ?>
                                            <option value="<?=$row['employee_id']?>"><?=$row['employee_name'] ?></option>
                                            <?php 
                                                } 
                                            ?>
                                        </select>   
                                    </div>

                                <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
                                <hr class="my-4">
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>
</html>
