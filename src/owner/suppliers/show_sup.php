<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
    <body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>
        <div class="main">
        <?php include '../../../public/php/topbar.php'; ?>
            <div class="container">    
            <div class="alert alert-success h4 text-center mt-4 " role="alert">Supplier</div>
                    <a href="add_sup.php"><button type="button" class="btn btn-success">Add+</button></a>
                        <table class="table table-striped table-hover mt-4">
                            <tr>
                                <th>ชื่อ</th>
                                <th>เบอร์โทร</th>
                                <th>ที่อยู่</th>
                                <th>สินค้า</th>
                                <th>ประเภทสินค้า</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                            <?php
                                $sql = "SELECT * FROM supplier, Type_Mat WHERE supplier.supplier_type = Type_Mat.type_id ORDER BY supplier_id";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_array($result)){ 
                            ?>

                            <tr>
                                <td><?php echo $row['supplier_name']; ?></td>
                                <td><?php echo $row['tel']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td><?php echo $row['material_name']; ?></td>
                                <td><?php echo $row['type_name']; ?></td>
                                <td><a href="../controller/materials/edit_mat.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-warning">Edit</a></td>
                                <td><a href="../controller/materials/delete_mat.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a></td>
                            </tr>
                            
                            <?php 
                                } mysqli_close($conn);
                            ?>
                            </table>
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