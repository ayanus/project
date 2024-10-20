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
    <title>Materials</title>
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
        <?php include '../../../public/php/nav_em.php'; ?>
        
        <div class="top">
            <?php include '../../../public/php/topbar_em.php'; ?>
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
                                    <a class="nav-link active" aria-current="true" href="show_odrmat.php">สั่งซื้อ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="show_cart.php">ตะกร้า (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)</a></a>
                                </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="btn-group">
                                    <button id="dropdownMenuButton" class="btn btn-secondary btn-sm dropdown-toggle mb-3" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        ประเภท
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="show_odrmat.php" onclick="changeButtonText('ทั้งหมด');">ทั้งหมด</a></li>
                                        <?php
                                            $sql = "SELECT * FROM Type_Mat ORDER BY type_id";
                                            $hand = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_array($hand)) {
                                        ?>
                                        <li><a class="dropdown-item" href="?type_id=<?php echo $row['type_id']; ?>" onclick="changeButtonText('<?php echo $row['type_name']; ?>');">
                                                <?php echo $row['type_name']; ?>
                                            </a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>

                                <script>
                                    // ฟังก์ชันสำหรับเปลี่ยนข้อความของปุ่ม
                                    function changeButtonText(newText) {
                                        document.getElementById("dropdownMenuButton").innerText = newText;
                                        localStorage.setItem("selectedType", newText); // เก็บข้อความที่เลือกใน localStorage
                                    }

                                    // เมื่อโหลดหน้าใหม่ ให้ตั้งค่าข้อความของปุ่มจาก localStorage
                                    window.onload = function() {
                                        const selectedType = localStorage.getItem("selectedType");
                                        if (selectedType) {
                                            document.getElementById("dropdownMenuButton").innerText = selectedType;
                                        }
                                    }
                                </script>

                                <?php
                                    $type_id = isset($_GET['type_id']) ? $_GET['type_id'] : 0;

                                    // ปรับ Query ขึ้นอยู่กับการเลือกประเภท
                                    if ($type_id == 0) {
                                        // ถ้าไม่มีการเลือกประเภท ให้แสดงสินค้าทั้งหมด
                                        $query =  mysqli_query($conn, "SELECT materials.*, supplier.supplier_id, materials_suppliers.material_id, type_mat.type_name
                                                                        FROM materials
                                                                        INNER JOIN materials_suppliers 
                                                                            ON materials.material_id = materials_suppliers.material_id
                                                                        INNER JOIN supplier
                                                                            ON materials_suppliers.supplier_id = supplier.supplier_id
                                                                        INNER JOIN type_mat
                                                                            ON materials.type_id = type_mat.type_id ORDER BY materials.material_id");
                                    } else {
                                        // ถ้าเลือกประเภท ให้แสดงเฉพาะสินค้านั้น
                                        $query =  mysqli_query($conn, "SELECT materials.*, supplier.supplier_id, materials_suppliers.material_id, type_mat.type_name
                                                                        FROM materials
                                                                        INNER JOIN materials_suppliers 
                                                                            ON materials.material_id = materials_suppliers.material_id
                                                                        INNER JOIN supplier
                                                                            ON materials_suppliers.supplier_id = supplier.supplier_id
                                                                        INNER JOIN type_mat
                                                                            ON materials.type_id = type_mat.type_id WHERE materials.type_id = $type_id ORDER BY materials.material_id");
                                    }
                                    $rows = mysqli_num_rows($query);
                                ?>

                                <div class="row row-cols-1 row-cols-md-5 g-4">
                                    <?php if($rows > 0): ?>
                                        <?php while($mat = mysqli_fetch_assoc($query)): ?>
                                            <div class="col">
                                                <div class="card">
                                                    <?php if(!empty($mat['material_img'])): ?>
                                                        <img src="/project/uploads/<?php echo $mat['material_img'] ?>" class="card-img-top" style="height: 200px;" alt="material image">
                                                    <?php else: ?>
                                                        <img src="/project/img-product/no-img.jpg" class="card-img-top" alt="...">
                                                    <?php endif; ?>
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?= $mat['material_name'] ?></h5>
                                                        <p class="card-text text-success mb-0 fw-bold"><?= $mat['price'] ?> บาท</p>
                                                        <p class="card-text text-muted"><?= $mat['material_detail'] ?></p>
                                                        <div>
                                                            <small class="card-text">คงเหลือ <?= $mat['quantity'] ?> <?= $mat['base_unit'] ?></small>
                                                            <small class="card-text"><?= $mat['stock_quantity'] ?> <?= $mat['unit_type'] ?></small>
                                                        </div>
                                                        <a href="cart.php?material_id=<?php echo $mat['material_id']?>" class="btn btn-primary mt-2 w-100">เพิ่มลงตะกร้า</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
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

<script language="Javascript">
    function Del(mypage){
        var agree=confirm("คุณต้องการลบข้อมูลนี้ใช่หรือไม่?");
        if(agree){
            window.location = mypage;
        }
    }
</script>