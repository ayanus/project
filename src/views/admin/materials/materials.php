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
            <!-- สร้างปุ่มเพิ่มข้อมูลวัตถุดิบ โดยมีการอ้างอิงถึงไฟล์อื่น -->
            <div class="btn-add">
            <a href="/project/src/controller/add.php"><button type="button" class="btn btn-primary">Add</button></a>
            </div>

            <div class="table">
                <table border="1" align="left" width="50%" height="20%">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Date of order</th>
                        <th>Quantity</th>
                    </tr>
                </table>
            </div>

            <div class="add"></div>
            
        </div>
    </body>
</html>