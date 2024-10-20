<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขายสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
    <style>
    .product-image {
        max-width: 100%; /* ทำให้ภาพขยายเต็มขนาด */
        height: auto; /* รักษาสัดส่วนของภาพ */
    }

    .product-details {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .product-label {
        margin-left: 10px;
        font-weight: bold; /* ทำให้ชื่อสินค้าหนาขึ้น */
    }

    .input-group {
        margin-top: 10px;
    }

    .card {
        transition: transform 0.2s; /* เพิ่มการเคลื่อนไหว */
    }

    .card:hover {
        transform: scale(1.05); /* ทำให้การ์ดขยายเมื่อวางเมาส์ */
    }
    </style>
</head>
    <body>
    <div class="containerr">
        <?php include '../../../public/php/nav_em.php'; ?>
        
        <div class="top">
            <?php include '../../../public/php/topbar_em.php'; ?>
        </div>

        <script>
        let selectedProducts = {}; // เก็บสินค้าที่ถูกเลือก

        // ฟังก์ชันเมื่อเลือกสินค้าจาก checkbox
        function selectProduct(productId, productName, productPrice) {
            let quantityInput = document.getElementById(`quantity_${productId}`);
            let quantity = parseInt(quantityInput.value);

            // ถ้ามีการเลือก checkbox
            if (document.getElementById(`checkbox_${productId}`).checked) {
                selectedProducts[productId] = {
                    name: productName,
                    price: productPrice,
                    quantity: quantity
                };
            } else {
                delete selectedProducts[productId]; // เอาสินค้าออกถ้าไม่ได้ถูกเลือก
            }

            updateSelectedProductList();
            calculateTotalPrice();
        }

        // ฟังก์ชันอัปเดตรายการสินค้าที่เลือก
        function updateSelectedProductList() {
            let productListElement = document.getElementById('selectedProducts');
            productListElement.innerHTML = ''; // ล้างรายการเก่า

            for (let productId in selectedProducts) {
                let product = selectedProducts[productId];
                productListElement.innerHTML += `
                    <p>${product.name} - จำนวน: ${product.quantity} ราคา: ${product.price * product.quantity} บาท</p>
                `;
            }
        }

        // ฟังก์ชันคำนวณราคารวม
        function calculateTotalPrice() {
            let total = 0;
            for (let productId in selectedProducts) {
                let product = selectedProducts[productId];
                total += product.price * product.quantity;
            }
            document.getElementById('totalPrice').innerText = total + " บาท";
        }

        // ฟังก์ชันเพิ่มจำนวนสินค้า
        function increaseQuantity(productId, productPrice) {
            let quantityInput = document.getElementById(`quantity_${productId}`);
            let quantity = parseInt(quantityInput.value) + 1;
            quantityInput.value = quantity;

            if (selectedProducts[productId]) {
                selectedProducts[productId].quantity = quantity;
                updateSelectedProductList();
                calculateTotalPrice();
            }
        }

        // ฟังก์ชันลดจำนวนสินค้า
        function decreaseQuantity(productId, productPrice) {
            let quantityInput = document.getElementById(`quantity_${productId}`);
            let quantity = parseInt(quantityInput.value) - 1;
            if (quantity >= 1) {
                quantityInput.value = quantity;

                if (selectedProducts[productId]) {
                    selectedProducts[productId].quantity = quantity;
                    updateSelectedProductList();
                    calculateTotalPrice();
                }
            }
        }

        // ฟังก์ชันพิมพ์ใบการขาย
        function printInvoice() {
            let invoiceContent = document.getElementById('selectedProducts').innerHTML;
            let totalPrice = document.getElementById('totalPrice').innerText;

            let printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>ใบการขาย</title></head><body>');
            printWindow.document.write('<h2>ใบการขาย</h2>');
            printWindow.document.write(invoiceContent);
            printWindow.document.write('<h3>ราคารวม: ' + totalPrice + '</h3>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
        
            <div class="main">
                <div class="container">      
                    <div class="header">สินค้า</div>

        <div class="row">
            <!-- คอลัมน์รายการสินค้า -->
            <div class="col-md-7">
                <h4>รายการสินค้า</h4>
                <div class="product-list">
                    <div class="row">
                        <?php
                        $sql = "SELECT product_id, product_name, price, quantity, picture FROM products ORDER BY product_id";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_price = $row['price'];
                            $product_quantity = $row['quantity'];
                            $product_picture = $row['picture'];
                        ?>
                        <div class="col-md-4 mb-4"> <!-- เปลี่ยนจาก li เป็น div -->
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="product-details">
                                        <input type="checkbox" id="checkbox_<?php echo $product_id; ?>" onclick="selectProduct(<?php echo $product_id; ?>, '<?php echo $product_name; ?>', <?php echo $product_price; ?>)">
                                        <img src="/project/uploads/<?php echo htmlspecialchars($row['picture']); ?>" class="product-image" style="height:70px;">
                                        <label for="checkbox_<?php echo $product_id; ?>" class="product-label"><?php echo $product_name; ?> (<?php echo $product_price; ?> บาท)</label>
                                    </div>

                                    <!-- ฟอร์มเลือกจำนวน -->
                                    <div class="input-group mt-2">
                                        <button class="btn btn-outline-secondary" onclick="decreaseQuantity(<?php echo $product_id; ?>, <?php echo $product_price; ?>)">-</button>
                                        <input type="text" class="form-control text-center" id="quantity_<?php echo $product_id; ?>" value="1" readonly>
                                        <button class="btn btn-outline-secondary" onclick="increaseQuantity(<?php echo $product_id; ?>, <?php echo $product_price; ?>)">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>

            <!-- คอลัมน์แสดงสินค้าที่เลือก -->
            <div class="col-md-5">
                <h4>สินค้าที่เลือก</h4>
                <div id="selectedProducts" class="border rounded p-3" style="min-height: 200px;">
                    <!-- สินค้าที่เลือกจะแสดงที่นี่ -->
                </div>

                <h5 class="mt-3">ราคารวม : <span id="totalPrice">0 บาท</span></h5>

                <!-- ปุ่มพิมพ์ใบการขาย -->
                <button class="btn btn-success mt-2" onclick="printInvoice()">พิมพ์ใบการขาย</button>
            </div>
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