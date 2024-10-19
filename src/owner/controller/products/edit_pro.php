<?php 
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['product_id'];
    $sql="SELECT * FROM products WHERE product_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
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
        <?php include '../../../../public/php/nav.php'; ?>
        
        <div class="top">
        <?php include '../../../../public/php/topbar.php'; ?>
        </div>
        
        <div class="main">
            <div class="container"> 
        <div class="form">

                    <div class="header">
                    <a href="../../../owner/materials/show_mat.php">วัตถุดิบ </a>
                        <a1>/</a1>
                        <a2>แก้ไขข้อมูลวัตถุดิบ</a2>
                    </div>

                        <div class="row g-4">
                            <div class="col-md-8 col-sm-12">
                                <form action="update_pro.php" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="product_id" value="<?= isset($row['product_id']) ? $row['product_id'] : '' ?>">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-5">
                                            <label class="form-label">รูปภาพ</label>
                                            <input type="file" class="form-control" name="picture" id="pictureInput">
                                            
                                            <?php if (isset($row['picture']) && !empty($row['picture'])): ?>
                                                <!-- แสดงรูปภาพที่เคยอัปโหลดไว้ -->
                                                <div class="mt-2">
                                                    <p>รูปภาพที่เคยอัปโหลด:</p>
                                                    <img id="uploadedImage" src="/project/uploads/<?= htmlspecialchars($row['picture']); ?>" alt="Uploaded Image" style="max-width: 50%; height: auto;">
                                                </div>
                                            <?php else: ?>
                                                <!-- กรณีที่ไม่มีรูปภาพเดิม -->
                                                <div class="mt-2">
                                                    <p>ยังไม่มีการอัปโหลดรูปภาพ</p>
                                                    <img id="uploadedImage" src="#" alt="No Image" style="max-width: 100%; height: auto; display: none;">
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <script>
                                            // JavaScript เพื่อแสดงตัวอย่างรูปภาพใหม่ที่เลือก
                                            document.getElementById('pictureInput').addEventListener('change', function(event) {
                                                var file = event.target.files[0]; // ได้ไฟล์ที่ถูกเลือกจาก input
                                                if (file) {
                                                    var reader = new FileReader(); // สร้าง FileReader เพื่ออ่านไฟล์
                                                    
                                                    reader.onload = function(e) {
                                                        var img = document.getElementById('uploadedImage');
                                                        img.src = e.target.result; // กำหนด src ของรูปภาพให้เป็นผลลัพธ์ที่อ่านได้
                                                        img.style.display = 'block'; // ทำให้รูปภาพปรากฏ
                                                    }

                                                    reader.readAsDataURL(file); // อ่านไฟล์เป็น Data URL
                                                }
                                            });
                                        </script>

                                        <div class="col-sm-5">
                                            <label class="form-label">ชื่อสินค้า</label>
                                            <input type="text" class="form-control" name="product_name" value="<?= isset($row['product_name']) ? $row['product_name'] : '' ?>">
                                        </div>

                                        <div class="col-sm-3">
                                            <label class="form-label">ราคา</label>
                                            <input type="text" class="form-control" name="price" rows="2" value="<?= isset($row['price']) ? $row['price'] : '' ?>">
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" name="1" type="submit">อัปเดต</button>
                                    <a href="../../products/show_pro.php"><button class="btn btn-secondary" type="button">ยกเลิก</button></a>
                                    <hr class="my-4">
                                </form>
                            </div>
                        </div>



                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/project/public/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>
</html>

