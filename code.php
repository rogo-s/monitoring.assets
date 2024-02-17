<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function sendemail_verify($name, $email, $verify_token) {
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
    $mail->Subject = "Email Verifikasi dari Web Service IT";
    
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
                p {
                    color: #777777;
                    line-height: 1.6;
                    margin-bottom: 20px;
                }
                .footer {
                    background-color: #f9f9f9;
                    padding: 20px;
                    border-radius: 0 0 8px 8px;
                    margin-top: 30px;
                }
                .footer p {
                    color: #888888;
                    font-size: 14px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Selamat Datang di Webserver</h2>
                <h5>Terima kasih telah bergabung dengan kami. Untuk melanjutkan, verifikasi email Anda dengan mengklik tautan di bawah:</h5>
                <a href='http://localhost/monitoring.assets/verify-email.php?token=$verify_token'>Verifikasi Email</a>
                <p>Harap verifikasi email Anda segera untuk menikmati semua fitur kami.</p>
            </div>
            <div class='footer'>
                <p>Email ini dikirim secara otomatis, mohon tidak membalas.</p>
            </div>
        </body>
        </html>
    ";

    $mail->Body = $email_template;
    $mail->send();
}

if (isset($_POST['register_btn'])) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $verify_token = md5(rand());
    $branch = $_POST['branch']; // New line to retrieve branch value

    // Validasi alamat email
    if (!preg_match('/^[\w.-]+@[\w.-]+\.\w+$/', $email)) {
        $_SESSION['status'] = "Format email tidak valid. Harap masukkan alamat email yang valid.";
        header("location: register.php");
        exit;
    }

    // email exists apa ngga
    $check_email_query = "SELECT email FROM users WHERE email=?";
    $stmt = mysqli_stmt_init($con);

    if (mysqli_stmt_prepare($stmt, $check_email_query)) {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['status'] = "Email sudah ada";
            header("location: register.php");
            exit;
        } else {
            // insert user / register data user
            $query = "INSERT INTO users (name, phone, email, password, verify_token, branch) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($con);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $name, $phone, $email, $password, $verify_token, $branch);
                mysqli_stmt_execute($stmt);

                sendemail_verify($name, $email, $verify_token);
                $_SESSION['status'] = "Registrasi sukses, silahkan verifikasi email anda";
                header("location: register.php");
                exit;
            } else {
                $_SESSION['status'] = "Registrasi gagal";
                header("location: register.php");
                exit;
            }
        }
    } else {
        $_SESSION['status'] = "Error: " . mysqli_error($con);
        header("location: register.php");
        exit;
    }
}
?>

