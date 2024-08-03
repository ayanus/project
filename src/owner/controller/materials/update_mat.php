<?php 
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_POST['material_id'];
    $material_name = $_POST['material_name'];
    
    $sql="SELECT * FROM materials WHERE material_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>