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
                    <div class="header">สั่งซื้อวัตถุดิบ</div>

                    <div class="content">
                        <table class="table mt-4">
                            <thead class="table-dark">
                            <tr>
                                <th>ชื่อ</th>
                                <th>ประเภทวัตถุดิบ</th>
                                <th>คงเหลือ</th>
                                <th>Supplier</th>
                                <th>สั่งซื้อ</th>
                            </tr>
                            </thead>
                        
                            <?php
                                $sql = "SELECT materials.material_name, materials.quantity, Type_Mat.type_name, Supplier.supplier_name FROM materials INNER JOIN Type_Mat ON materials.material_type = Type_Mat.type_id INNER JOIN Supplier ON Supplier.material_name = materials.material_name ORDER BY materials.material_id";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){ 
                            ?>
                            
                            <tbody>
                            <tr>
                                <td><?php echo $row['material_name']; ?></td>
                                <td><?php echo $row['type_name']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['supplier_name']; ?></td>
                                <td><a href="#">
                                        <span class="icon">
                                            <ion-icon name="cart-outline"></ion-icon>                      
                                        </span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                            
                            <?php 
                                } mysqli_close($conn);
                            ?>

                        </table>
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