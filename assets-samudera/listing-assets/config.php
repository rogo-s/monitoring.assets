<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "it_notes";


$db = mysqli_connect($servername, $username, $password, $database);

if (!$db) {
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

//Staff
$sqlStaff = "SELECT * FROM tbl_staf";
$resultStaff = mysqli_query($db, $sqlStaff);

//Branch
$sqlBranch = "SELECT * FROM tbl_branch";
$resultBranch = mysqli_query($db, $sqlBranch);

//Status Device
$sqlStatus = "SELECT * FROM tbl_status";
$resultStatus = mysqli_query($db, $sqlStatus);

//Device Type
$sqlDevt = "SELECT * FROM tbl_dvt";
$resultDevt = mysqli_query($db, $sqlDevt);

//Brand
$sqlBr = "SELECT * FROM tbl_brand";
$resultBr = mysqli_query($db, $sqlBr);

//Domain
$sqlDomain = "SELECT * FROM tbl_domain";
$resultDomain = mysqli_query($db, $sqlDomain);

//Antivirus
$sqlAtv = "SELECT * FROM tbl_antivirus";
$resultAtv = mysqli_query($db, $sqlAtv);

//Windows Name
$sqlWinn = "SELECT * FROM tbl_windows";
$resultWinn = mysqli_query($db, $sqlWinn);

//Windows Bit
$sqlWbit = "SELECT * FROM tbl_wbit";
$resultWbit = mysqli_query($db, $sqlWbit);


