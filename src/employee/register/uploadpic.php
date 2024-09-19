<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    // $picture = $_FILES['picture']['name'];
    $targetDir = "picture/";

    if (isset($_POST['submit'])) {
        if (!empty($_FILES['picture'])) {
            $picture = $_FILES['picture']['name'];
            $targetFile = $targetDir . basename($_FILES['picture']['name']);
            $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                    $employee_name = $_POST['employee_name'];
    }
?>