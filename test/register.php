<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/src/views/admin/login/login.css">
</head>
<body>
<main class="form-signin w-100 m-auto">
    <form action="/project/src/views/admin/login/insert_register.php" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Sign up</h1>

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

        <div class="form-floating">
        <input type="text" class="form-control my-2" name="employee_name" placeholder="Enter your name">
        <label for="name">Name</label>
        </div>

        <div class="form-floating">
        <input type="email" class="form-control my-2" name="email" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
        </div>

        <div class="form-floating">
        <input type="text" class="form-control my-2" name="username" placeholder="Enter your username">
        <label for="username">Username</label>
        </div>

        <div class="form-floating">
        <input type="password" class="form-control my-2" name="password" placeholder="Password">
        <label for="floatingPassword">Password</label>
        </div>

        <div class="form-floating">
        <input type="password" class="form-control my-2"  name="confirm_password" placeholder="Confirm password">
        <label for="floatingPassword">Confirm Password</label>
        </div>

        </div>
        <button class="btn btn-primary w-100 py-2 my-2" type="submit" name="register">Register</button>
        <p class="mt-2 text-body-secondary text-center">Don't have an account yet? <a href="login.php">Sign in</a> now</p>
    </form>

    







    
    </main>
</body>
</html>