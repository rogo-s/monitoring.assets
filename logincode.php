<?php
session_start();
include('dbcon.php');

if (isset($_POST['login_now_btn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $login_query = "SELECT * FROM users WHERE email=?";
        $stmt = mysqli_stmt_init($con);

        if (mysqli_stmt_prepare($stmt, $login_query)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row["password"])) {
                    if ($row['verify_status'] == "1") {
                        $_SESSION['authenticated'] = TRUE;
                        $_SESSION['auth_user'] = [
                            'branch' => $row['branch'],
                            'username' => $row['name'],
                            'phone' => $row['phone'],
                            'email' => $row['email'],
                        ];
                        $_SESSION['status'] = "Kamu Sukses Berhasil Login";
                        
                        if ($row['role'] == 'user') {
                            header("Location: dashboard.php");
                            exit;
                        } else if ($row['role'] == "admin") {
                            header("Location: assets-samudera/listing-assets/index.php");
                            exit;
                        }
                    } else {
                        $_SESSION['status'] = "Silahkan verifikasi email address untuk login";
                        header("Location: login.php");
                        exit;
                    }
                } else {
                    $_SESSION['status'] = "Password yang anda masukan salah";
                    header("Location: login.php");
                    exit;
                }
            } else {
                $_SESSION['status'] = "Invalid email atau password";
                header("Location: login.php");
                exit;
            }
        }
    } else {
        $_SESSION['status'] = "semua kolom adalah mandatory";
        header("Location: login.php");
        exit;
    }
}
?>
