<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form">

            <div class="alert alert-primary h4 text-center mt-4" role="alert">เพิ่มวัตถุดิบ</div>

            <form action="../controller/materials/insert_mat.php" method="post">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="material_name" required>
                
                <label for="type" class="form-label mt-4">Type</label>
                <select class="form-select" id="type" name="material_type">
                    <option value="อุปกรณ์">อุปกรณ์</option>
                    <option value="วัตถุดิบ">วัตถุดิบ</option>
                </select>
                
                <label for="Quantity" class="form-label mt-4">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" required>

                <input type="submit" name="1" class="btn btn-primary mt-4" value="Submit">
                <input type="reset" name="2"class="btn btn-secondary mt-4" value="Reset">          
            </form>
        </div>
    </div>
</body>
</html>