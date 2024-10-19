<?php
session_start();
include 'C:/xampp/htdocs/project/config/database.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if(!empty($_GET['product_id'])) {
    if(empty($_SESSION['cart'][$_GET['product_id']])) {
        $_SESSION['cart'][$_GET['product_id']] = 1;
    } else {
        $_SESSION['cart'][$_GET['product_id']] += 1;
    }

    $_SESSION['message'] = 'เพิ่มการผลิตสำเร็จ';
}

header('Location: add_production.php');

?>