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
                    <!-- <h4>เพิ่มข้อมูลวัตถุดิบและอุปกรณ์</h4>     -->
                    <div class="header">วัตถุดิบและอุปกรณ์</div>
                    <!-- <a href="add_mat.php"><button type="button" class="btn btn-success mb-3">เพิ่มอุปกรณ์และวัตถุดิบ+</button></a> -->
                    <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="../controller/materials/update_mat.php" method="post" enctype="multipart/form-data">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-4">
                                            <label class="form-label">วัตถุดิบและอุปกรณ์</label>
                                            <select class="form-select" aria-label="Default select example" id="type" name="material_id">
                                                <?php
                                                $sql="SELECT * FROM materials ORDER BY material_id ";
                                                $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                                while($row=mysqli_fetch_array($hand)){
                                                ?>
                                                <option value="<?=$row['material_id']?>"><?=$row['material_name']?></option>
                                                <?php 
                                                    } 
                                                ?>
                                            </select>                                    
                                        </div>

                                        <div class="col-sm-2">
                                            <label class="form-label">จำนวน</label>
                                            <input type="text" class="form-control" name="quantity" required>
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label">หน่วย</label>
                                            <select id="base_unit" name="base_unit" class="form-select" required>
                                                <option value="แพ็ค">แพ็ค</option>
                                                <option value="กิโลกรัม">กิโลกรัม</option>
                                            </select>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                    <a href="add_mat.php"><button class="btn btn-secondary" type="button">+ เพิ่มวัตถุดิบอุปกรณ์ใหม่</button></a>
                                    <hr class="my-4">
                                </form>
                            </div>
                        </div>
                    
                    <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="show_mat.php">วัตถุดิบและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="true" href="../ordermat/show_odrmat.php">สั่งซื้อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../ordermat/show_cart.php">ตะกร้า (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></a>

                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>ชื่อ</th>
                                            <th class="dropdown">
                                                    <button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">                                                   
                                                        ประเภท
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="show_mat.php">ทั้งหมด</a></li>
                                                        <?php
                                                            $sql = "SELECT * FROM Type_Mat ORDER BY type_name";
                                                            $hand = mysqli_query($conn, $sql);
                                                            while ($row = mysqli_fetch_array($hand)) {
                                                        ?>
                                                        <li><a class="dropdown-item" href="?type_id=<?php echo $row['type_id']; ?>">
                                                                <?php echo $row['type_name']; ?>
                                                            </a>
                                                        </li>
                                                        
                                                        <?php } ?>
                                                        
                                                    </ul>
                                                </div>
                                            </th>
                                            <th>จำนวนคงเหลือ</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
 
                                    <?php
                                    // ตรวจสอบว่าได้รับ type_id จาก URL หรือไม่
                                    $type_id = isset($_GET['type_id']) ? $_GET['type_id'] : 0;

                                    // ปรับ Query ขึ้นอยู่กับการเลือกประเภท
                                    if ($type_id == 0) {
                                        // ถ้าไม่มีการเลือกประเภท ให้แสดงสินค้าทั้งหมด
                                        $sql = "SELECT * FROM materials INNER JOIN Type_Mat ON materials.type_id = Type_Mat.type_id ORDER BY material_id";
                                    } else {
                                        // ถ้าเลือกประเภท ให้แสดงเฉพาะสินค้านั้น
                                        $sql = "SELECT * FROM materials INNER JOIN Type_Mat ON materials.type_id = Type_Mat.type_id WHERE materials.type_id = $type_id ORDER BY material_id";
                                    }

                                    $result = mysqli_query($conn, $sql);

                                    if (!$result) {
                                        die("Error: " . mysqli_error($conn));
                                    }

                                    // แสดงผลข้อมูล
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    
                                    <tbody>
                                        <tr>
                                            <td><img src="/project/uploads/<?php echo htmlspecialchars($row['material_img']); ?>" alt="Material Picture" style="width:100px;height:100px;"></td>
                                            <td><?php echo $row['material_name']; ?>
                                                <div>
                                                    <small class="text-muted"><?php echo $row['material_detail']; ?></small>
                                                </div>
                                            </td>
                                            <td><?php echo $row['type_name']; ?></td>
                                            <td><?php echo $row['quantity']; ?> <?php echo $row['base_unit']; ?>
                                                <div>
                                                    <small class="text-muted"><?php echo $row['stock_quantity']; ?> <?php echo $row['unit_type']; ?></small>
                                                </div>
                                            </td>

                                            <td><a href="../controller/materials/edit_mat.php?material_id=<?=$row['material_id']?>" class="btn btn-warning">แก้ไข</a>
                                            <a href="../controller/materials/delete_mat.php?material_id=<?=$row['material_id']?>" class="btn btn-danger" onclick="Del(this.href);return false;">ลบ</a></td>
                                        </tr>
                                    </tbody>
                                    <?php
                                        }
                                    ?>
                                </table>
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