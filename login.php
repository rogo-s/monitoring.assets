<?php 
session_start();
if(isset($_SESSION['authenticated'])){
    $_SESSION['status'] = "Kamu Sudah Berhasil Login.!";
    header("Location: dashboard.php");
    exit(0);
}

$page_title = "Login form";
include('includes/header.php');
include('includes/navbar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert">
                    <?php
                    if(isset($_SESSION['status'])){
                    ?>
                    <div class="alert alert-success">
                        <h5><?= $_SESSION['status'];?></h5>
                    </div>
                    <?php
                    unset($_SESSION['status']);
                    }
                    ?>
                </div>
                <div class="card login-container"> <!-- Added 'login-container' class -->
                    <div class="card-header">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>
                                <a href="password-reset.php" class="float-end">Forgot Your Password</a>
                            </div>
                        </form>
                        <hr>
                        <h5>
                            Masih belum menerima E-mail?
                            <a href="resend-email-verification.php">Resend</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
</body>
</html>