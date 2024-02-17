<?php
session_start();

include("../config.php");
require_once('../tcpdf/tcpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../phpmailer/src/Exception.php";
require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";

$date = date('d');
$month = date('F');
$year = date('Y');
$today = $date . ' ' . $month . ' ' .  $year;

if (isset($_POST['submit-chck'])) {
    $nik = $_POST['nik'];
    $stn = $_POST['staff_name'];
    $gen = $_POST['gender'];
    $email = $_POST['email'];
    $brc = $_POST['branch'];

    $sqlCheckNik = "SELECT COUNT(*) as count FROM tbl_staf  WHERE nik = '$nik'";
    $resultCheckNik = $db->query($sqlCheckNik);
    $rowCheckNik = $resultCheckNik->fetch_assoc();

    // Cek apakah ada akun dengan nama yang sama
    $sqlCheckName = "SELECT COUNT(*) as count FROM tbl_staf WHERE staf_name = '$stn'";
    $resultCheckName = $db->query($sqlCheckName);
    $rowCheckName = $resultCheckName->fetch_assoc();

    if (!($rowCheckNik['count'] > 0)) {

        $sqlStaff = "INSERT INTO tbl_staf
        (nik, staf_name, gender, email, branch_id)
        VALUES ('$nik', '$stn', '$gen', '$email','$brc')";
        $db->query($sqlStaff);

        header('Location: ../index.php?status=Data Karyawan Behasil Tersimpan.');
    }else {
        header('Location: ../index.php?status=NIK sudah terdapat di database');
    }

} else if (isset($_POST['submit-adc'])) {
    $stf = $_POST['staff_id'];
    $sd = $_POST['status_device'];
    $devt = $_POST['device_type'];
    $sn = $_POST['serial_number'];
    $br = $_POST['brand'];
    $lt = $_POST['laptop_type'];
    $winn = $_POST['windows_name'];
    $winb = $_POST['windows_bit'];
    $atv = $_POST['antivirus_name'];
    $atvv = $_POST['antivirus_version'];
    $dom = $_POST['domain'];

    $sqlGetStaffInfo = "SELECT * FROM tbl_staf WHERE staff_id = '$stf'";
    $result = $db->query($sqlGetStaffInfo);

    if ($result->num_rows > 0) {
        $staffInfo = $result->fetch_assoc();
        $nik = $staffInfo['nik'];
        $nik1 = NULL;
        $stn = $staffInfo['staf_name'];
        $gen = $staffInfo['gender'];
        $email = $staffInfo['email'];
        $brc = $staffInfo['branch_id'];

        if (isset($_POST['serial_number']) && !empty($_POST['serial_number']) && isset($_POST['brand']) && !empty($_POST['brand']) && isset($_POST['laptop_type']) && !empty($_POST['laptop_type'])) {
            $sn = $_POST['serial_number'];
            $br = $_POST['brand'];
            $lt = $_POST['laptop_type'];
        } else {
            $pcn = $_POST['pc_name'];
            $sn = $pcn;
            $br = NULL;
            $lt = NULL;
        }

        $sqlDev = "INSERT INTO device_assets_computer 
            (nik_firstuser, nik, staff_name, gender, email, branch_id, status_id, dvt_id, serial_number, brand_id, laptop_type, windows_id, wbit_id, antivirus_id, antivirus_version, domain_id)
            VALUES ('$nik1', '$nik', '$stn', '$gen', '$email', '$brc', '$sd', '$devt', '$sn', '$br', '$lt', '$winn', '$winb', '$atv', '$atvv', '$dom')";
        $db->query($sqlDev);

        header('Location: ../index.php?status=Device baru berhasil disimpan');
    }
} else if (isset($_POST['add_device_non'])) {
    $sd = $_POST['status_device'];
    $devt = $_POST['device_type'];
    $br = $_POST['brand'];
    $sn = $_POST['serial_number'];
    $loc = $_POST['loc'];

    if (isset($_POST['ip']) && !empty($_POST['ip'])) {
        $ip = $_POST['ip'];
    } else {
        $ip = NULL;
    }

    $sqlNonDev = "INSERT INTO tbl_non_device (status_id, dvt_id, brand_id, serial_number, ip, loc) VALUES ('$sd', '$devt', '$br', '$sn', '$ip', '$loc')";
    $db->query($sqlNonDev);

    header('Location: ../index.php?status=Device Non-Staff baru berhasil disimpan');
} else {
    header('Location: ../index.php?status=Gagal');
}
