<?php 
session_start();

$page_title = "Register form";
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
                <div class="card">
                    <div class="card-shadow">
                    <div class="card-header">
                        <h5>Registrasi Form</h5>
                    </div>
                    <div class="card-body">
                        
                        <form action="code.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Name User</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email Address</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="branch">Branch</label>
                                <select name="branch" class="form-control" required>
                                <option value="Branch O">Choose Branch</option>
                                    <option value="Jakarta">Jakarta</option>
                                    <option value="Palembang">Palembang</option>
                                    <option value="Semarang">Semarang</option>
                                    <option value="Surabaya">Surabaya</option>
                                    <option value="Makassar">Makassar</option>
                                    <option value="Panjang">Panjang</option>
                                    <option value="Medan">Medan</option>
                                    <option value="Batam">Batam</option>
                                    <option value="Jambi">Jambi</option>
                                    <option value="Padang">Padang</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="register_btn" class="btn btn-primary">Register Now</button>
                            </div>
                        </form>
                        <hr>
                        <H6>
                            Sudah Punya Akun?
                            <a href="login.php">Masuk</a>
                        </H6>
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