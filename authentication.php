<?php
session_start();

if(!isset($_SESSION['authenticated'])){
$_SESSION['status'] = "Silahkan login untuk akses user dashboard.!";
header("Location: login.php");
exit(0);

}

?>