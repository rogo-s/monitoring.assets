<?php

// include 'konek.php';
session_start();
$id = $_POST['TXTuname'];
$pass = $_POST['TXTpass'];


$ch = curl_init('http://10.28.252.86/basic/index.php?action=Login_Fauzi_dev&username=' . $id . '&password=' . $pass);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// var_dump($ch); exit;
$result = curl_exec($ch);
if (curl_exec($ch) === false) {
	echo 'Curl error: ' . curl_error($ch) . '<br>';
	$info = curl_getinfo($ch);
	print_r($info);
}
curl_close($ch);

$split1 = explode("{", $result);
$split2 = explode("}", $split1[1]);
// var_dump($split2); echo '<br> ini Split 3 explode :';
$split3 = explode(":", $split2[0]);
// var_dump($split3); '<br> ini Split 4 explode ';

$username = explode(",", $split3[1]);
$branch = explode(",", $split3[3]);
$groupname = explode(",", $split3[4]);
$fullname = explode(",", $split3[2]);
$groupid = $split3[5];
// var_dump($branch); exit;
$_SESSION['user'] = substr($username[0], 1, -1);
$_SESSION['branch'] = substr($branch[0], 1, -1);
$_SESSION['group'] = substr($groupid, 1, -1);
$_SESSION['groupname'] = substr($groupname[0], 1, -1);
$_SESSION['fullname'] = substr($fullname[0], 1, -1);
// exit;
// echo $_SESSION['user'] . ' - '. $_SESSION['branch'] . ' - ' . $_SESSION['group'] . ' - ' . $_SESSION['groupname'];exit;
// echo $_SESSION['fullname']; exit;
if (strlen($_SESSION['user']) > 0) {
	header("Location: ../listing-assets/index.php");
} else {
	header("Location: ../index.php");
}
