<?php 
session_start();

$page_title = "Password Change Update";
include('includes/header.php');
include('includes/navbar.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 
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
                <div class="card">
                    <div class="card-header">
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body p-4">
                         
                        <form action="password-reset-code.php" method="POST">
                        <input type="hidden" name="password_token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">


                            <div class="form-group mb-3">
                                <label for="">Alamat E-mail</label>
                                <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>" class="form-control" placeholder="Masukan alamat email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Masukan Password Baru">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Konfirmasi Password</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_update" class="btn btn-success w-100">Update now</button>
                            </div>
                        </form>
                        </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>

 
<?php include('includes/footer.php'); ?>
</body>
</html>