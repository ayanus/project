<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(!empty($_GET['material_id'])) {
    if(empty($_SESSION['cart'][$_GET['material_id']])) {
        $_SESSION['cart'][$_GET['material_id']] = 1;
    } else {
        $_SESSION['cart'][$_GET['material_id']] += 1;
    }

    $_SESSION['message'] = 'เพิ่มสินค้าลงในตะกร้าสำเร็จ';
}

header('Location: show_odrmat.php');

?>