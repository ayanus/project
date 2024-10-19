<?php
    session_start(); // เริ่มต้นเซสชัน

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $product_id = $_POST['product_id'];
        $type_bee_id = $_POST['type_bee_id'] ?? null;
        $food_id = $_POST['food_id'] ?? null;
        $product_bee_id = $_POST['product_bee_id'];
        $material_id = $_POST['material_id'];
        $quantity = $_POST['quantity'];
        $production_date = $_POST['production_date'];
        $employee_id = $_POST['employee_id'];

        // สร้างรายการใหม่ในตะกร้า
        $newItem = [
            'product_id' => $product_id,
            'type_bee_id' => $type_bee_id,
            'food_id' => $food_id,
            'product_bee_id' => $product_bee_id,
            'material_id' => $material_id,
            'quantity' => $quantity,
            'production_date' => $production_date,
            'employee_id' => $employee_id
        ];

        // ตรวจสอบว่ามีเซสชัน cart หรือไม่ ถ้าไม่มีก็สร้างใหม่
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // เพิ่มสินค้าใหม่ลงในตะกร้า
        $_SESSION['cart'][] = $newItem;

        // นำผู้ใช้ไปยังหน้าตะกร้าการผลิต
        header("Location: show_cart_production.php");
        exit();
    }
?>
