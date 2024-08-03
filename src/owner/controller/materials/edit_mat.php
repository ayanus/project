<?php 
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['material_id'];
    $sql="SELECT * FROM materials WHERE material_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form">

            <div class="alert alert-primary h4 text-center mt-4" role="alert">แก้ไขข้อมูลวัตถุดิบ</div>

            <form action="update_mat.php" method="post">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" id="id" name="material_id" value=<?=$row['material_id']?> >
                
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="material_name" value=<?=$row['material_name']?>>
                
                <label for="type" class="form-label mt-4">Type</label>
                <select class="form-select" aria-label="Default select example" id="type" name="material_type">
                    <?php
                    $sql="SELECT * FROM Type_Mat ORDER BY type_name ";
                    $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                    while($row=mysqli_fetch_array($hand)){
                    ?>
                    <option value="<?=$row['type_id']?>"><?=$row['type_name']?></option>
                    <?php 
                        } 
                        mysqli_close($conn)
                    ?>
                </select>
                
                <label for="Quantity" class="form-label mt-4">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value=<?=$row['quantity']?>>

                <input type="submit" name="1" class="btn btn-primary mt-4" value="Update">
                <a href="../../materials/show_mat.php" class="btn btn-secondary mt-4">Cancel</a>          
            </form>
        </div>
    </div>
</body>
</html>