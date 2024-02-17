<?php
session_start(); 
include('dbcon.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function resend_email_verify($name, $email, $verify_token){
    $mail = new PHPMailer(true);
    // hasil smpt debug
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->Username = "subandonorogo@gmail.com";
    $mail->Password = "bweo iboj repb uhtl";

    $mail->SMTPSecure = "tls";
    $mail->Port = "587";

    $mail->setFrom("subandonorogo@gmail.com", $name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = " Resend - Email Verifikasi Web Service IT";

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
                <h2>Silahkan verifikasi kembali</h2>
                <h5>Verifikasi email kamu untuk login dengan link di bawah ini</h5>
                <a href='http://localhost/monitoring.assets/verify-email.php?token=$verify_token'>Klik Saya</a>
            </div>
        </body>
        </html>
    ";

    $mail->Body =$email_template;
    $mail->send();
}

if(isset($_POST['resend_email_verify_btn'])){
    if(!empty(trim($_POST['email']))){
        $email = mysqli_escape_string($con, $_POST['email']);
        $checkmail_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $checkmail_query_run = mysqli_query($con, $checkmail_query);

        if(mysqli_num_rows($checkmail_query_run) > 0){
            $row = mysqli_fetch_array($checkmail_query_run);
            if($row['verify_status'] == "0"){
                $name = $row['name'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];

                resend_email_verify($name, $email, $verify_token);
                
                $_SESSION['status'] = "Verifikasi link email telah dikirim ke alamat email";
                header("Location: login.php");
                exit(0);
            }else{
                $_SESSION['status'] = "Email telah terverifikasi, Silahkan login sekarang";
                header("Location: login.php");
                exit(0);
            }
        }else{
            $_SESSION['status'] = "Email tidak terverifikasi, Silahkan register sekarang";
            header("Location: register.php");
            exit(0);
        }


    }else{
        $_SESSION['status'] = "Silahkan enter kolom email";
        header("Location: resend-email-verification.php");
        exit(0);
    }
}

?>