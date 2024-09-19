<?php 
    session_start();

    include 'C:/xampp/htdocs/project/config/database.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
    body {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #F5F5F5;
        height: 100vh;
    }

    .wrapper {
        display: flex;
        flex-direction: column;
        width: 50%;
        height: auto;
        border-radius: 15px;
        padding: 20px;
        position: relative;
    }

    .logo {
        margin-top: 30%;
        display: flex;
        justify-content: center;
    }

    .logo img {
        width: 150px;
    }

    .main {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .profile {
        width: 100%;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .profile h5 {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
    }

    button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    .sent {
        width: 100%;
        padding: 10px;
    }

</style>
</head>
<body>
    <div class="wrapper">
        <div class="main ">
            <form class="row g-3" action="/project/src/employee/register/insert_register.php" method="post">
                <a href="#" class="logo">
                    <img width="20%" src="/project/public/logo.png" alt="Big Bee Farm Logo">
                </a>
                <h1 class="h3 mb-3 font-weight-normal text-center">ลงทะเบียนพนักงานใหม่</h1>

                <!-- ถ้ามี error -->
                <?php if(isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['success']; 
                            unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>

                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['error']; 
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>

                <div class="profile">
                    <h5>ข้อมูลส่วนตัว</h5>
                    <div class="row mb-3 mt-3 ml-5">
                        <div class="col-md-6">
                            <label for="name" class="form-label">ชื่อ - สกุล</label>
                            <input type="text" id="employee_name" name="employee_name" class="form-control" required autofocus>
                        </div>
                        <div class="col-6">
                            <label for="gender" class="form-label">เพศ</label>
                            <select class="form-select" aria-label="Default select example" id="sex" name="sex">
                                <option selected disabled>-------</option>
                                <option value="1" >ชาย</option>
                                <option value="2">หญิง</option>
                                <option value="3">ไม่ระบุ</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 mt-2 ml-6">
                        <div class="col-md-6">
                            <label for="tel" class="form-label">เบอร์โทร</label>
                            <input type="tel" id="tel" name="tel" class="form-control" pattern="[0-9]{10}"required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com" required autofocus>
                        </div>
                    </div>
                    
                    <div class="row mb-3 mt-2 ml-5">
                        <div class="col-md-6">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <textarea id="address" name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="department" class="form-label">แผนกงาน</label>
                                <select class="form-select" aria-label="Default select example" id="department_id" name="department_id">
                                <option selected disabled>-------</option>
                                <?php
                                    $sql="SELECT * FROM department ORDER BY department_id ";
                                    $hand=mysqli_query($conn,$sql); //ดึงข้อมูล database
                                    while($row=mysqli_fetch_array($hand)){
                                    ?>
                                    <option value="<?=$row['department_id']?>"><?=$row['department_name']?></option>
                                    <?php 
                                        } 
                                        mysqli_close($conn)
                                    ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="profile">
                    <h5>ข้อมูลบัญชีธนาคาร</h5>
                    <div class="row mb-3 mt-3 ml-5">
                        <div class="col-md-4">
                            <label for="bank" class="form-label">ธนาคาร</label>
                            <input type="text" id="bank" name="bank" class="form-control"required>
                        </div>
                        <div class="col-md-4">
                            <label for="account_name" class="form-label">ชื่อบัญชี</label>
                            <input type="text" id="account_name" name="account_name" class="form-control"required>
                        </div>
                        <div class="col-md-4">
                            <label for="account_num" class="form-label">เลขที่บัญชี</label>
                            <input type="text" id="account_num" name="account_num" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="profile">
                    <h5>ข้อมูลการสมัครใช้งานระบบ</h5>
                    <div class="row mb-3 mt-3 ml-5">
                        <div class="col-md-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" id="bank" name="username" class="form-control"required>
                        </div>
                        <div class="col-md-6">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" id="account_name" name="password" class="form-control"required>
                        </div>
                    </div>
                </div>

                <div class="sent">
                    <div class="row mb-3 mt-2 ml-5">
                        <button class="btn btn-md btn-primary btn-block w-100 center" type="submit" name="register">Register</button>
                    </div>
                    <div class="row mb-3 mt-2 ml-5">
                        <p class="mt-2 text-body-secondary text-center">Already have an account yet? <a href="/project/login.php">Sign in</a> now</p>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
