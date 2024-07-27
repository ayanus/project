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
            <form action="materials.php" method="post">

                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="material_name">

                    <label for="Quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity">

                    <label for="type" class="form-label">Type</label>
                    <select class="form-select" id="type" name="material_type">
                        <option value="1">อุปกรณ์</option>
                        <option value="2">วัตถุดิบ</option><br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                
            </form>
        </div>
    </div>
</body>
</html>