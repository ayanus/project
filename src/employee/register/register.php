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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<style>
    body {
        margin: 0;
        display: flex;
        background-color: #F5F5F5;
        min-width: none;
    }

    .wrapper {
        display: flex;
        flex: 1;
        flex-wrap: wrap;
        height: 110vh;
    }

    .container {
        flex: 1.25;
        width: 70%;
        height: 100vh;
        background-color: #FBF8EF;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main {
        flex: 1;
        width: 30%;
        padding: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 17% 17% 17%;
    }

    .user {
        width : 20.5%;
    }
    .card {
        /* width: 20.5%; */
        display: flex;
        flex-direction: column;
        align-items: left;
    }

    .logo {
        display: flex;
        justify-content: center;
    }

    .profile {
        position: absolute;
        left: 500px;
        width: calc(80% - 500px);
        background-color: white;
        margin-top: 180px;
        border-radius: 10px;
        box-shadow: 0 0 2px rgba(0, 0, 0, 0.3);
    }

    .profile .head {
        border-radius: 10px 10px 0 0;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        width: 102.25%;
        margin-left: -8px;
    }

    .profile .head p {
        font-size: 20px;
        font-weight: 500;
        padding: 10px 20px;
    }

</style>
</head>
<body>
    <div class="wrapper">
        <div class="main ">
            <form class="row g-3" action="/project/src/login/insert_register.php" method="post">
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

                <div class="user">
                    <div class="card">
                        <header class="card-header">
                            <p class="header-title">รูปถ่าย</p>
                        </header>
                        <div class="card-image">
                            <div id="profile_image_preview" class="image is-fullwidth" style="width: 100%; height: 200px; background-image: url('https://www.w3schools.com/howto/img_avatar.png'); background-size: cover; background-position: center;"></div>
                        </div>
                    </div>
                    <div class="file is-boxed">
                        <label class="file-label">
                            <input class="file-input" type="file" name="resume" />
                            <span class="file-cta">
                            <span class="file-icon">
                                <ion-icon name="cloud-upload-outline"></ion-icon>
                            </span>
                            <span class="file-label"> Choose a file… </span>
                            </span>
                        </label>
                    </div>
                </div>

                <div class="profile">
                    <div class="head">
                        <p>ข้อมูลส่วนตัว</p>
                    </div>
                    <div class="row mb-3 mt-3 ml-5">
                        <div class="col-md-6">
                            <label for="name" class="form-label">ชื่อ - สกุล</label>
                            <input type="text" id="employee_name" name="employee_name" class="form-control" required autofocus>
                        </div>
                        <div class="col-5">
                            <label for="gender" class="form-label">เพศ</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected disabled>-------</option>
                                <option value="1" >ชาย</option>
                                <option value="2">หญิง</option>
                                <option value="3">ไม่ระบุ</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 mt-2 ml-5">
                        <div class="col-md-5">
                            <label for="tel" class="form-label">เบอร์โทร</label>
                            <input type="tel" id="tel" name="tel" class="form-control" pattern="[0-9]{10}"required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com" required autofocus>
                        </div>
                    </div>
                    
                    <div class="row mb-3 mt-2 ml-5">
                        <div class="col-md-7">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <textarea id="address" name="address" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="gender" class="form-label">แผนกงาน</label>
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

                    <div class="row mb-3 mt-2 ml-5">
                        <div class="col-md-5">
                            <label for="account_name" class="form-label">บัญชีธนาคาร</label>
                            <input type="text" id="account_name" name="account_name" class="form-control"required>
                        </div>
                        <div class="col-md-6">
                            <label for="account_num" class="form-label">เลขที่บัญชี</label>
                            <input type="text" id="account_num" name="account_num" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3 mt-2 ml-5">
                        <button class="btn btn-md btn-primary btn-block w-75" type="submit" name="register">Register</button>
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
