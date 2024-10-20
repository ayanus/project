<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $id = $_GET['employee_id'];
    $sql="SELECT employee.* , department.* FROM employee JOIN department ON employee.department_id =  department.department_id WHERE employee_id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
<body>
    <div class="containerr">
        <?php include '../../../public/php/nav.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar.php'; ?>
        </div>
        
            <div class="main">
                <div class="container">    
                    <div class="header"><a href="show_em.php"><ion-icon name="chevron-back-outline"></ion-icon></a>เงินเดือนพนักงาน</div>

                        <div class="card">
                            <div class="card-header">
                                <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" href="payment.php">จ่ายเงินเดือนพนักงาน</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="true" href="show_payment.php">ประวัติการจ่ายเงินเดือน</a>
                                </li>
                                </ul>
                            </div>

                            <div class="card-body">
                            </div>
                        </div>
                </div>
            </div>
    </div>
    <script>
        // เพิ่ม JavaScript สำหรับแสดง alert
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const successMessage = urlParams.get('success');
            const errorMessage = urlParams.get('error');
            
            if (successMessage) {
                alert(decodeURIComponent(successMessage));
            } else if (errorMessage) {
                alert(decodeURIComponent(errorMessage));
            }
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    </body>
</html>
