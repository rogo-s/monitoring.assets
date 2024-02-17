<?php
session_start();
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token){
    $mail = new PHPMailer(true);
    // hasil smpt debug
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "subandonorogo@gmail.com";
    $mail->Password = "bweo iboj repb uhtl";

    $mail->SMTPSecure = "tls";
    $mail->Port = "587";

    $mail->setFrom("subandonorogo@gmail.com", $get_name);
    $mail->addAddress($get_email);

    $mail->isHTML(true);
    $mail->Subject = "Reset Password - Web Service IT";

    $email_template = "
        <html>
        <head>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    text-align: center;
                }
                .container {
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    margin: 20px auto;
                    padding: 20px;
                    width: 60%;
                }
                h2 {
                    color: #3498db;
                }
                h5 {
                    color: #555555;
                    margin-bottom: 20px;
                }
                a {
                    background-color: #3498db;
                    color: #ffffff;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 4px;
                    transition: background-color 0.3s ease;
                }
                a:hover {
                    background-color: #2980b9;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Hello Pengguna</h2>
                <h5>Silahkan Klik link dibawah ini agar menuju page ganti password</h5>
                <a href='http://localhost/monitoring.assets/password-change.php?token=$token&email=$get_email'>Klik Saya</a>
            </div>
        </body>
        </html>
    ";

    $mail->Body =$email_template;
    $mail->send();

}

if(isset($_POST['password_reset_link'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token =  md5(rand());

    $check_email = "SELECT email, name FROM users WHERE email='$email' LIMIT 1";

    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run)>0){
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE users SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run){
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "Kami telah mengirim ulang password baru anda!";
            header("Location: login.php");
            exit(0); 

        }else{
            $_SESSION['status'] = "Terjadi Kesalahan. #1";
            header("Location: password-reset.php");
            exit(0); 
        }

    }else{
       $_SESSION['status'] = "Email tidak ditemukan";
       header("Location: password-reset.php");
       exit(0); 
    }
}

if(isset($_POST['password_update'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if(!empty($token)){
        if(!empty($new_password) && !empty($confirm_password)){
            // Periksa apakah token ada di database
            $check_token = "SELECT verify_token FROM users WHERE verify_token='$token' LIMIT 1";
            $check_token_run = mysqli_query($con, $check_token);

            if($check_token_run && mysqli_num_rows($check_token_run) > 0){
                if($new_password == $confirm_password){
                    $update_password = "UPDATE users SET password='$new_password' WHERE verify_token='$token' LIMIT 1";
                    $update_password_run = mysqli_query($con, $update_password);

                    if($update_password_run){

                        $new_token = md5(rand())."Service";
                        $update_to_new_token = "UPDATE users SET verify_token='$new_token' WHERE verify_token='$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($con, $update_to_new_token);

                        $_SESSION['status'] = "Password baru telah ter-update";
                        header("Location: login.php");
                    }else{
                        $_SESSION['status'] = "Password tidak terupdate. Terjadi Sesuatu!";
                        header("Location: password-change.php?token=$token&email=$email");
                    }
                }else{
                    $_SESSION['status'] = "Password dan konfirmasi password tidak sama!";
                    header("Location: password-change.php?token=$token&email=$email");
                }
            }else{
                $_SESSION['status'] = "Token tidak ditemukan!";
                header("Location: password-change.php?token=$token&email=$email");
            }
        }else{
            $_SESSION['status'] = "Semua kolom wajib di isi!";
            header("Location: password-change.php?token=$token&email=$email");
        }
    }else{
        $_SESSION['status'] = "Token Tidak Tersedia";
        header("Location: password-change.php");
    }
}


?>