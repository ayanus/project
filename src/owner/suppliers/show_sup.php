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
        
        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>

            <div class="main">
                <div class="container">    
                    <div class="header">ผู้จัดจำหน่าย</div>
                        <a href="add_sup.php"><button type="button" class="btn btn-success mb-3">Add+</button></a>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>รูป</th>
                                    <th>ชื่อ</th>
                                    <th>เบอร์โทร</th>
                                    <th>ที่อยู่</th>
                                    <th> </th>
                                </tr>
                            </thead>

                            <?php
                                $sql = "SELECT supplier.supplier_name, supplier.company, GROUP_CONCAT(materials.material_name SEPARATOR ', ') as material_list, supplier.supplier_id, supplier.tel, supplier.address, supplier.supplier_img, supplier.supplier_email
                                        FROM supplier 
                                        INNER JOIN materials_suppliers ON materials_suppliers.supplier_id = supplier.supplier_id
                                        INNER JOIN materials ON materials_suppliers.material_id = materials.material_id 
                                        GROUP BY supplier.supplier_id
                                        ORDER BY supplier.supplier_id ";
                                $result = mysqli_query($conn, $sql);
                                if (!$result) {
                                    die("Error: " . mysqli_error($conn));
                                }

                                // แสดงผลข้อมูล
                                while ($row = mysqli_fetch_array($result)) {
                                    // การแสดงผลตามข้อมูลที่ดึงมา

                                ?>
                            

                            <tbody>
                                <tr>
                                    <td><img src="/project/uploads/<?php echo htmlspecialchars($row['supplier_img']); ?>" alt="supplier Picture" style="height:100px;"></td>
                                    <td><?php echo $row['supplier_name']; ?></td>
                                    <td><?php echo $row['tel']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supModal<?php echo $row['supplier_id']; ?>">รายละเอียด</button>
                                        <a href="../controller/suppliers/edit_sup.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-warning">Edit</a>
                                    <a href="../controller/suppliers/delete_sup.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a></td>
                                </tr>
                            </tbody>

                            <!-- Modal -->
                            <div class="modal fade" id="supModal<?php echo $row['supplier_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">ผู้จัดจำหน่าย : <?php echo $row['supplier_id']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>บริษัท : </strong> <?php echo $row['supplier_name']; ?></p>
                                                <p><strong>ตัวแทนขาย : </strong> <?php echo $row['company']; ?></p>
                                                <p><strong>E-mail : </strong> <?php echo $row['supplier_email']; ?></p>                                                
                                                <p><strong>สินค้า : </strong> </p>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT supplier.supplier_name, supplier.company, materials_suppliers.mat_sup_id , materials.material_name
                                                        FROM supplier 
                                                        INNER JOIN materials_suppliers ON materials_suppliers.supplier_id = supplier.supplier_id
                                                        INNER JOIN materials ON materials_suppliers.material_id = materials.material_id 
                                                        WHERE supplier.supplier_id = ?");
                                                        $stmt->bind_param("i", $row['supplier_id']);
                                                        $stmt->execute();
                                                        $result_product = $stmt->get_result();
                                                        if ($result_product && mysqli_num_rows($result_product) > 0) {
                                                            $products = array();
                                                            while ($row_product = mysqli_fetch_assoc($result_product)) {
                                                                $products[] = '<li>' . htmlspecialchars($row_product['material_name']) . '</li>';
                                                            }
                                                            echo '<ul>' . implode('', $products) . '</ul>';
                                                        } else {
                                                            echo "ไม่มีข้อมูลผลผลิต";
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
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