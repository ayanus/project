<?php
    include 'C:/xampp/htdocs/project/config/database.php';
    $employee_name = $_POST['employee_name'];
    $sex = $_POST['sex'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $department_id = $_POST['department_id'];
    $bank = $_POST['bank'];
    $account_name = $_POST['account_name'];
    $account_num = $_POST['account_num'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = "employee";

    $sql = "INSERT INTO employee (employee_name, sex, tel, email, address, department_id, bank, account_name, account_num, username, password, role, start_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }
    

    $stmt->bind_param("ssssssssssss", $employee_name, $sex, $tel, $email, $address, $department_id, $bank, $account_name, $account_num, $username, $password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "บันทึกข้อมูลเรียบร้อย";
        echo "<script>window.location = '/project/login.php'</script>";
    } else {
        $_SESSION['error'] = "บันทึกข้อมูลไม่สำเร็จ: " . $stmt->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
    
    header("Location: /project/login.php");
    exit();
?>
