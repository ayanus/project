<?php
    include 'C:/xampp/htdocs/project/config/database.php';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
<style>
    .content a{
        text-decoration: none;
    }
</style>
</head>
    <body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>
        
        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>
        
            <div class="main">
                <div class="container">  
                    <div class="header">สั่งซื้ออุปกรณ์และวัตถุดิบ</div>
                    <?php if(!empty($_SESSION['message'])): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo $_SESSION['message']; ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <?php unset($_SESSION['message']); ?>
                                <?php endif; ?>
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
                                    <a class="nav-link active" href="show_cart.php">ตะกร้า (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></a>
                                </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="table-dark">
                                        <!-- <tr>
                                            <th style="width: 200px;">รูปภาพ</th>
                                            <th style="width: 200px;">รายการ</th>
                                            <th style="width: 200px;">ราคา</th>
                                            <th style="width: 200px;">จำนวน</th>
                                            <th style="width: 200px;">รวม</th>
                                            <th> </th>
                                        </tr> -->
                                    </thead>
 
                                    <?php

                                    $material_id = [];
                                    foreach (($_SESSION['cart'] ?? [])as $cartId => $cartQty) {
                                        $material_id[] = $cartId;
                                    }

                                    $ids = 0;
                                    // ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
                                    if(count($material_id) > 0) {
                                        $ids = implode(',', $material_id);  // แปลง array เป็น string
                                        
                                        // คำสั่ง SQL
                                        $query = mysqli_query($conn, "SELECT materials.* , supplier.*
                                                                    FROM materials
                                                                    INNER JOIN materials_suppliers 
                                                                    ON materials.material_id = materials_suppliers.material_id
                                                                    INNER JOIN supplier
                                                                    ON materials_suppliers.supplier_id = supplier.supplier_id
                                                                    WHERE materials.material_id IN($ids)"
                                                                    );
                                        $suppliers = [];
                                        // ตรวจสอบว่ามีผลลัพธ์หรือไม่
                                        if(mysqli_num_rows($query) > 0) {
                                            while($row = mysqli_fetch_assoc($query)) {
                                                // แสดงผลข้อมูลของสินค้าแต่ละรายการ
                                                $supplier_id = $row['supplier_id'];
            
                                                if (!isset($suppliers[$supplier_id])) {
                                                    $suppliers[$supplier_id] = [
                                                        'supplier_name' => $row['supplier_name'],
                                                        'supplier_email' => $row['supplier_email'],
                                                        'address' => $row['address'],
                                                        'tel' => $row['tel'],
                                                        'supplier_id' => $row['supplier_id'],
                                                        'materials' => []
                                                    ];
                                                }
                                                
                                                $suppliers[$supplier_id]['materials'][] = [
                                                    'material_name' => $row['material_name'],
                                                    'material_img' => $row['material_img'],
                                                    'quantity' => $_SESSION['cart'][$row['material_id']],
                                                    'price' => $row['price'],
                                                    'total' => $row['price'] * $_SESSION['cart'][$row['material_id']],
                                                    'material_id' => $row['material_id']
                                                ];
                                            }

                                            foreach ($suppliers as $supplier_data) {
                                                echo "<h3>ใบเสร็จรับเงิน</h3>";
                                                echo "<p>ผู้จำหน่าย: {$supplier_data['supplier_name']}</p>";
                                                echo "<p>เลขที่ {$supplier_data['address']}</p>";
                                                echo "<p>เบอร์โทร {$supplier_data['tel']}</p>";
                                                echo "<p>เลขประจำตัวผู้เสียภาษี {$supplier_data['supplier_id']}</p>";
                                                echo "<p>วันที่: " . date("d/m/Y") . "</p>";                                                echo "<table class='table'>
                                                        <thead class='table-dark'>
                                                            <tr>
                                                                <th>รูปภาพ</th>
                                                                <th>รายการ</th>
                                                                <th>ราคา</th>
                                                                <th>จำนวน</th>
                                                                <th>รวม</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>";
                                                        foreach ($supplier_data['materials'] as $material) {
                                                ?>
                                    
                                    <script>
                                    function updateTotal(input, price, materialId) {
                                        var quantity = input.value;  // ดึงค่าจาก input ที่เปลี่ยนแปลง
                                        var total = (quantity * price).toFixed(2);  // คำนวณราคารวม และแปลงเป็นทศนิยม 2 ตำแหน่ง

                                        // อัปเดตยอดรวมในฟิลด์ที่แสดงผล
                                        document.getElementById('total_' + materialId).textContent = total;
                                    }
                                    </script>

                                    <tbody>
                                        <tr>
                                            <td><img src="/project/uploads/<?php echo htmlspecialchars($material['material_img']); ?>" alt="Material Picture" style="width:100px;height:100px;"></td>
                                            <td><?php echo $material['material_name']; ?></td>
                                            <td><?php echo number_format($material['price'], 2); ?></td>
                                            <!-- เพิ่ม oninput เพื่อเรียกฟังก์ชันเมื่อจำนวนเปลี่ยน -->
                                            <td><input type="number" name="quantity" value="<?php echo $_SESSION['cart'][$material['material_id']]; ?>" class="form-control w-50" min="1" oninput="updateTotal(this, <?php echo $material['price']; ?>, <?php echo $material['material_id']; ?>)"></td>
                                            <!-- เพิ่ม span เพื่อแสดงราคารวม -->
                                            <td id="total_<?php echo $material['material_id']; ?>"><?php echo number_format($material['price'] * $_SESSION['cart'][$material['material_id']], 2); ?></td>
                                            <td><a href="../controller/materials/delete_mat.php?material_id=<?=$material['material_id']?>" class="btn btn-danger" onclick="Del(this.href);return false;">ลบ</a></td>
                                        </tr>
                                        <?php
                                        }
                                        echo "</tbody></table><br>";
                                    }
                                    } else {
                                        echo "<tr><td colspan='6'>ไม่มีสินค้าในตะกร้า</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>ไม่มีสินค้าในตะกร้า</td></tr>";
                                }
                                ?>
                                    </tbody>

                                </table>
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