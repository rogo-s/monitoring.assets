<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "Kamu Telah Logout :)";
header("Location: login.php")

?>