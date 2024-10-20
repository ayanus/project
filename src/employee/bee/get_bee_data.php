<?php
include 'C:/xampp/htdocs/project/config/database.php';

if (isset($_GET['bee_id'])) {
    $bee_id = $_GET['bee_id'];

    // Query ข้อมูลจากตาราง bee ตาม bee_id ที่ส่งมา
    $sql = "SELECT bee_name, bee_food FROM bee WHERE bee_id = '$bee_id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // ส่งข้อมูลในรูปแบบ JSON
        echo json_encode($row);
    } else {
        // ถ้าไม่มีข้อมูล
        echo json_encode(['bee_name' => '', 'bee_food' => '']);
    }
}
?>
