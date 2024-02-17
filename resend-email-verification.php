<?php 
session_start();

$page_title = "Resend E-Mail form";
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
                    <div class="card">
                    <div class="card-header">
                        <h5>Resend Email Verifikasi</h5>
                    </div>
                    <div class="card-body">
                         
                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="resend_email_verify_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
<?php include('includes/footer.php'); ?>
</body>
</html>

