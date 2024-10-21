<?php
include 'C:/xampp/htdocs/project/config/database.php';

// เพิ่ม error reporting เพื่อแสดงข้อผิดพลาดทั้งหมด (ใช้สำหรับการ debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการจ่ายเงินเดือน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/public/css/style.css">
</head>
<body>
    <div class="containerr">
        <?php include '../../../public/php/nav_em.php'; ?>

        <div class="top">
            <?php include '../../../public/php/topbar_em.php'; ?>
        </div>
        
        <div class="main">
            <div class="container">
                <div class="header">ข้อมูลการจ่ายเงินเดือน</div>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="show_em.php">ข้อมูลส่วนตัว</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="true" href="show_payment.php">ประวัติการจ่ายเงิน</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <?php
                        // ดึงข้อมูลจากตาราง salary
                        $sql = "SELECT s.*, e.employee_name FROM salary s 
                                JOIN employee e ON s.employee_id = e.employee_id
                                WHERE e.username = '" . $_SESSION['username'] . "' 
                                ORDER BY s.date DESC";
                        $result = mysqli_query($conn, $sql);

                        if (!$result) {
                            die("Query failed: " . mysqli_error($conn));
                        }

                        if (mysqli_num_rows($result) > 0) {
                        ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ชื่อพนักงาน</th>
                                            <th>วันที่จ่ายเงินเดือน</th>
                                            <th>สถานะการจ่ายเงิน</th>
                                            <th>จำนวนเงิน (บาท)</th>
                                            <th>หลักฐานการจ่าย</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . htmlspecialchars($row['employee_name']) . "</td>";
                                            echo "<td>" . date('d/m/Y', strtotime($row['date'])) . "</td>";
                                            echo "<td>" . ($row['status'] == 'paid' ? 'จ่ายแล้ว' : 'ยังไม่จ่าย') . "</td>";
                                            echo "<td>" . number_format($row['salary'], 2) . "</td>";
                                            echo "<td><button class='btn btn-sm btn-primary view-slip' data-bs-toggle='modal' data-bs-target='#slipModal' data-slip='/project/src/uploads/" . htmlspecialchars($row['slip']) . "'>ดูสลิป</button></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            echo "<div class='alert alert-info'>ยังไม่มีข้อมูลการจ่ายเงินเดือน</div>";
                        }
                        mysqli_free_result($result);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="slipModal" tabindex="-1" aria-labelledby="slipModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="slipModalLabel">สลิปเงินเดือน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="slipImage" src="" alt="สลิปเงินเดือน" style="width: 100%; height: auto;">
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var slipModal = document.getElementById('slipModal')
            slipModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget
                var slipPath = button.getAttribute('data-slip')
                var modalImage = slipModal.querySelector('#slipImage')
                modalImage.src = slipPath
            })
        })
    </script>
</body>
</html>