<?php
    include 'C:/xampp/htdocs/project/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
    <body>
        <div class="container">    
            <div class="alert alert-success h4 text-center mt-4" role="alert">แสดงข้อมูลวัตถุดิบ</div>
                <a href="add_mat.php"><button type="button" class="btn btn-success">Add+</button></a>
                    <table class="table table-striped table-hover mt-4">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        
                        <?php
                            $sql = "SELECT * FROM materials";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_array($result)){ 
                        ?>

                        <tr>
                            <td><?php echo $row['material_id']; ?></td>
                            <td><?php echo $row['material_name']; ?></td>
                            <td><?php echo $row['material_type']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><a href="" class="btn btn-warning">Edit</a></td>
                            <td><a href="../controller/materials/delete_mat.php?material_id=<?=$row['material_id']?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                        
                        <?php 
                            } mysqli_close($conn);
                        ?>

                    </table>
        </div>
    </body>
</html>