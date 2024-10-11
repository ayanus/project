<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(!empty($_GET['material_id'])) {
    unset($_SESSION['cart'][$_GET['material_id']]);
    $_SESSION['message'] = 'ลบสินค้าออกจากตะกร้าสำเร็จ';
}

header('Location: ../../ordermat/show_cart.php');

?>