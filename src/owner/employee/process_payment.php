<?php
include 'C:/xampp/htdocs/project/config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_POST['employee_id'];
    $date = $_POST['date'];
    $salary = $_POST['salary'];
    $status = 'paid';

    // ดึงเดือนและปีจากวันที่ที่พยายามบันทึก
    $new_month = date('m', strtotime($date));
    $new_year = date('Y', strtotime($date));

    // ตรวจสอบว่ามีการบันทึกเดือนและปีซ้ำกันในฐานข้อมูลแล้วหรือยัง
    $sql_check = "SELECT * FROM salary WHERE employee_id = ? AND MONTH(date) = ? AND YEAR(date) = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "iii", $employee_id, $new_month, $new_year);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        // ถ้ามีข้อมูลเดือนและปีซ้ำกัน ให้แสดงข้อความว่าไม่สามารถบันทึกได้
        echo "<script>alert('มีการบันทึกข้อมูลในเดือนและปีนี้แล้วสำหรับพนักงานคนนี้');</script>";
        echo "<script>window.location = 'show_em.php'</script>";
        // header("Location: payment.php?error=" . urlencode("มีการบันทึกข้อมูลในเดือนและปีนี้แล้วสำหรับพนักงานคนนี้"));
        exit();
    } else {
        // ดำเนินการบันทึกข้อมูลตามปกติ

        // กำหนดพาธที่แน่นอนสำหรับโฟลเดอร์ uploads
        $target_dir = __DIR__ . "/uploads/";
        
        // ตรวจสอบว่าโฟลเดอร์ uploads มีอยู่หรือไม่ ถ้าไม่มีให้สร้างขึ้น
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // สร้างชื่อไฟล์ที่ไม่ซ้ำกัน
        $file_extension = pathinfo($_FILES["slip"]["name"], PATHINFO_EXTENSION);
        $new_filename = uniqid() . "." . $file_extension;
        $target_file = $target_dir . $new_filename;

        $uploadOk = 1;
        $imageFileType = strtolower($file_extension);

        // ตรวจสอบว่าไฟล์เป็นรูปภาพจริงหรือไม่
        $check = getimagesize($_FILES["slip"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "ไฟล์ไม่ใช่รูปภาพ";
            $uploadOk = 0;
        }

        // ตรวจสอบขนาดไฟล์
        if ($_FILES["slip"]["size"] > 500000) {
            echo "ขออภัย ไฟล์ของคุณมีขนาดใหญ่เกินไป";
            $uploadOk = 0;
        }

        // อนุญาตเฉพาะไฟล์บางประเภท
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "ขออภัย อนุญาตเฉพาะไฟล์ JPG, JPEG, PNG เท่านั้น";
            $uploadOk = 0;
        }

        // ถ้าทุกอย่างโอเค ให้ลองอัปโหลดไฟล์
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["slip"]["tmp_name"], $target_file)) {
                // อัปโหลดไฟล์สำเร็จ ตอนนี้ให้เพิ่มข้อมูลลงในฐานข้อมูล
                $sql = "INSERT INTO salary (employee_id, date, slip, status, salary) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "isssd", $employee_id, $date, $new_filename, $status, $salary);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location: payment.php?success=" . urlencode("บันทึกการจ่ายเงินเดือนสำเร็จ"));
                    exit();
                } else {
                    header("Location: payment.php?error=" . urlencode("เกิดข้อผิดพลาดในการบันทึกข้อมูล: " . mysqli_error($conn)));
                    exit();
                }
                mysqli_stmt_close($stmt);
            } else {
                header("Location: payment.php?error=" . urlencode("ขออภัย เกิดข้อผิดพลาดในการอัปโหลดไฟล์ของคุณ"));
                exit();
            }
        }
    }

    mysqli_stmt_close($stmt_check);
}
mysqli_close($conn);
?>
