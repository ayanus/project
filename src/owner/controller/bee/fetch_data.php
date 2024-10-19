<?php
    include 'C:/xampp/htdocs/project/config/database.php'; // เชื่อมต่อฐานข้อมูล

    if (isset($_GET['bee_id']) && isset($_GET['product_id'])) {
        $bee_id = $_GET['bee_id'];
        $product_id = $_GET['product_id'];

        // กรองข้อมูลตาม bee_id และ product_bee_id
        $sql_product = "SELECT product_bee.product_bee_name, beekeep_detail.quantity, beekeep_detail.unit, beekeep_detail.date
                        FROM beekeep_detail
                        INNER JOIN product_bee ON beekeep_detail.product_bee_id = product_bee.product_bee_id
                        WHERE beekeep_detail.bee_id = '" . $bee_id . "' 
                        AND beekeep_detail.product_bee_id = '" . $product_id . "'";

        $result_product = mysqli_query($conn, $sql_product);
        if ($result_product && mysqli_num_rows($result_product) > 0) {
            echo "<ul>";
            while ($row_product = mysqli_fetch_assoc($result_product)) {
                echo '<li>' . htmlspecialchars(' (' . $row_product['date'] . ') ' . $row_product['product_bee_name'] . ' ' . $row_product['quantity'] . ' ' . $row_product['unit']) . '</li>';
            }
            echo "</ul>";
        } else {
            echo "ไม่มีข้อมูลผลผลิต";
        }
    } else {
        echo "ข้อมูลไม่สมบูรณ์";
    }
?>
