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
                            <a class="nav-link" aria-current="true" href="../materials/show_mat.php">วัตถุดิบและอุปกรณ์</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="true" href="show_odrmat.php">สั่งซื้อ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="show_cart.php">ตะกร้า (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="../ordermat/show_his_odrmat.php">ประวัติการสั่งซื้อ</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>รหัสออเดอร์</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>ราคารวม</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <?php 
                                    $sql = "SELECT ordermaterials.OrderMat_id, ordermaterials.OrderMat_date, ordermaterials.total, 
                                                GROUP_CONCAT(materials.material_name SEPARATOR ', ') AS material_list,
                                                GROUP_CONCAT(ordermat_detail.quantity SEPARATOR ', ') AS quantity_list,
                                                GROUP_CONCAT(ordermat_detail.price SEPARATOR ', ') AS price_list,
                                                GROUP_CONCAT(supplier.supplier_name SEPARATOR ', ') AS supplier_list
                                            FROM ordermaterials 
                                            JOIN ordermat_detail ON ordermaterials.ordermat_id = ordermat_detail.ordermat_id
                                            JOIN materials ON ordermat_detail.material_id = materials.material_id
                                            JOIN supplier ON ordermat_detail.supplier_id = supplier.supplier_id
                                            GROUP BY ordermaterials.ordermat_id
                                            ORDER BY ordermaterials.ordermat_id";
                                            
                                    $hand = mysqli_query($conn, $sql);

                                    // ตรวจสอบว่าการ query สำเร็จหรือไม่
                                    if (!$hand) {
                                        // แสดง error message
                                        echo "Error: " . mysqli_error($conn);
                                        exit();
                                    }

                                    while ($row = mysqli_fetch_array($hand)) {
                                        // โค้ดการแสดงผลที่เหลือ
                                    ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['OrderMat_id']; ?></td>
                                                <td><?php echo $row['OrderMat_date']; ?></td>
                                                <td><?php echo $row['total']; ?> บาท</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#orderDetailModal<?php echo $row['OrderMat_id']; ?>">
                                                        รายละเอียดการสั่งซื้อ
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <!-- Modal แสดงรายละเอียด -->
                                        <div class="modal fade" id="orderDetailModal<?php echo $row['OrderMat_id']; ?>" tabindex="-1" aria-labelledby="orderDetailLabel<?php echo $row['OrderMat_id']; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="orderDetailLabel<?php echo $row['OrderMat_id']; ?>">รายละเอียดการสั่งซื้อ <?php echo $row['OrderMat_id']; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>รหัสออเดอร์: <?php echo $row['OrderMat_id']; ?></p>
                                                        <p>วันที่สั่งซื้อ: <?php echo $row['OrderMat_date']; ?></p>
                                                        <p>สินค้าที่สั่งซื้อ:</p>
                                                        <ul>
                                                            <?php 
                                                            $materials = explode(", ", $row['material_list']);
                                                            $quantities = explode(", ", $row['quantity_list']);
                                                            $prices = explode(", ", $row['price_list']);
                                                            $suppliers = explode(", ", $row['supplier_list']);

                                                            for ($i = 0; $i < count($materials); $i++) {
                                                                echo "<li>รายการ : " . $materials[$i] . "<br> จำนวน " . $quantities[$i] . "<br> ราคา " . $prices[$i] . " บาท " . "<br> ซัพพลายเออร์ : " . $suppliers[$i] . "</li>";
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    </table>
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