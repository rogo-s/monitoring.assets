<?php
session_start();

include("../config.php");
require_once('../tcpdf/tcpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "../phpmailer/src/Exception.php";
require "../phpmailer/src/PHPMailer.php";
require "../phpmailer/src/SMTP.php";

// cek apakah tombol simpan sudah diklik atau blum?
if (isset($_POST['submit-edt'])) {
  // ambil data dari formulir
  $id = $_POST['id'];
  $nik = $_POST['nik'];
  $stn = $_POST['staff_name'];
  $gen = $_POST['gender'];
  $email = $_POST['email'];
  $brc = $_POST['branch'];
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

  function getInfoByID($id, $field){
    global $db;
    $fields = array(
      'nik' => 'NIK tidak ditemukan',
    );
    if (array_key_exists($field, $fields)) {
      $query = "SELECT $field FROM device_assets_computer WHERE device_id = $id";
        $result = $db->query($query);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          return $row[$field];
        } else {
        return $fields[$field];
      }
    } else {
      return "Field tidak valid";
    }
  }
  $exOwnerNIK = getInfoByID($id, 'nik');

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

  if ($sd === '1') {
    if (isset($_FILES['bast']) && $_FILES['bast']['error'] === UPLOAD_ERR_OK) {
      $image = $_FILES['bast']['tmp_name'];
      $imageType = $_FILES['bast']["type"];
      $allowedImageTypes = array("image/jpeg", "image/png", "image/gif", "application/pdf");
      if (in_array($imageType, $allowedImageTypes)) {
        $targetFileName = $nik . '_' . $sn . '.' . pathinfo($_FILES['bast']['name'], PATHINFO_EXTENSION);

        $sql = "SELECT dvt.dvt_name FROM device_assets_computer dac LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id 
        WHERE dac.device_id=$id";
        $query = $db->query($sql);
        while ($row = mysqli_fetch_array($query)) {

          $smtpHost = 'smtp.gmail.com';
          $smtpUsername = 'subandonorogo@gmail.com';
          $smtpPassword = 'bweo iboj repb uhtl';
          $senderEmail = 'subandonorogo@gmail.com';
          $subject = $row['dvt_name'] . "_SN " . $sn . "_IT Samudera_" . $stn;
          $message = "Berikut adalah berita acara serah terima barang yang telah dibuat dan terlampir dalam file PDF.";

          $mail = new PHPMailer(true);

          try {
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($senderEmail);
            $mail->addAddress($_POST["email"]);
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Lampirkan file PDF
            $mail->addAttachment($image, $targetFileName);

            // Kirim email
            $mail->send();

            // Update data setelah pengiriman email
            $sqlDev = "UPDATE device_assets_computer SET nik_firstuser = '$exOwnerNIK', nik = '$nik', staff_name='$stn', gender='$gen', email='$email', branch_id='$brc', 
            status_id = '$sd', dvt_id = '$devt', serial_number = '$sn', brand_id = '$br', laptop_type = '$lt', windows_id = '$winn', 
            wbit_id = '$winb', antivirus_id = '$atv', antivirus_version='$atvv', domain_id = '$dom' WHERE device_id = $id";

            if ($db->query($sqlDev)) {
              header('Location: ../index.php?status=Data Device Berhasil Terupdate.');
            } else {
              echo "Terjadi kesalahan dalam memperbarui data.";
            }

          } catch (Exception $e) {
            echo "Terjadi kesalahan: {$mail->ErrorInfo}";
          }
        }
      } else {
        header('Location: ../index.php?status=Tipe file yang diunggah tidak valid. Hanya file gambar & PDF yang diperbolehkan.');
      }
    } else {
      header('Location: ../index.php?status=Tipe file yang diunggah tidak valid. Hanya file gambar & PDF yang diperbolehkan.');
    }
  } else if ($sd === '3') {
    $startDate = $_POST['startDate'];

    $sqlDev = "UPDATE device_assets_computer SET status_id = '$sd' WHERE device_id = $id";
    $db->query($sqlDev);

    if (isset($_POST['endDate']) && !empty($_POST['endDate'])) {
      $endDate = $_POST['endDate'];
    } else {
      $endDate = date('Y-m-d', strtotime($endDate));
    }

    $sqlCheckID = "SELECT COUNT(*) as count FROM tbl_repair WHERE serial_number = '$sn'";
    $result = $db->query($sqlCheckID);

    if (isset($_POST['vendor_name']) && !empty($_POST['vendor_name']) && isset($_FILES['detailsFile']) && $_FILES['detailsFile']['error'] === UPLOAD_ERR_OK) {
      $vendor = $_POST['vendor_name'];

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
          // ID exists, perform an UPDATE operation
          $sqlRepair = "UPDATE tbl_repair SET startDate = '$startDate', endDate = '$endDate', vendor_name = '$vendor' WHERE serial_number = '$sn'";
          $action = 'edit';
        } else {
          // ID doesn't exist, perform an INSERT operation
          $sqlRepair = "INSERT INTO tbl_repair (serial_number, startDate, endDate, vendor_name) VALUES ('$sn', '$startDate', '$endDate', '$vendor')";
          $action = 'insert';
        }
      } else {
        die("Error: Unable to check ID in the database.");
      }

      $image = $_FILES['detailsFile']['tmp_name'];
      $imageType = $_FILES['detailsFile']["type"];
      $allowedImageTypes = array("image/jpeg", "image/png", "image/gif", "application/pdf");
      if (in_array($imageType, $allowedImageTypes)) {
        $targetFileName = $nik . '_' . $sn . '.' . pathinfo($_FILES['detailsFile']['name'], PATHINFO_EXTENSION);

        $sql = "SELECT dvt.dvt_name FROM device_assets_computer dac LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id 
        WHERE dac.device_id=$id";
        $query = $db->query($sql);
        while ($row = mysqli_fetch_array($query)) {

          $smtpHost = 'smtp.gmail.com';
          $smtpUsername = 'subandonorogo@gmail.com';
          $smtpPassword = 'bweo iboj repb uhtl';
          $senderEmail = 'subandonorogo@gmail.com';
          $subject = $row['dvt_name'] . "_SN " . $sn . "_IT Samudera_" . $stn;
          $message = "Berikut adalah berita acara serah terima barang yang telah dibuat dan terlampir dalam file PDF.";

          $mail = new PHPMailer(true);

          try {
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($senderEmail);
            $mail->addAddress('subandonorogo@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Lampirkan file PDF
            $mail->addAttachment($image, $targetFileName);

            // Kirim email
            $mail->send();
            header('Location: ../index.php?status=Laporan Detail Perbaikan dikirim ke email.');
          } catch (Exception $e) {
            echo "Terjadi kesalahan: {$mail->ErrorInfo}";
          }
        }
      } else {
        header('Location: ../index.php?status=Tipe file yang diunggah tidak valid. Hanya file gambar & PDF yang diperbolehkan.');
      }
    } else {
      $vendor = NULL;
      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
          // ID exists, perform an UPDATE operation
          $sqlRepair = "UPDATE tbl_repair SET startDate = '$startDate', endDate = '$endDate', vendor_name = '$vendor' WHERE serial_number = '$sn'";
          $action = 'edit';
        } else {
          // ID doesn't exist, perform an INSERT operation
          $sqlRepair = "INSERT INTO tbl_repair (serial_number, startDate, endDate, vendor_name) VALUES ('$sn', '$startDate', '$endDate', '$vendor')";
          $action = 'insert';
        }
      } else {
        die("Error: Unable to check ID in the database.");
      }
    }

    // Perform the query
    if ($db->query($sqlRepair) === TRUE) {
      // Redirect back to the index page with success message
      header("Location: ../index.php?status=Device Repair berhasil $action");
    } else {
      // Redirect back to the index page with error message
      header("Location: ../index.php?status=Gagal melakukan $action Device Repair");
    }
  } else {
    $sqlDev = "UPDATE device_assets_computer SET status_id = '$sd' WHERE device_id = $id";
    $db->query($sqlDev);
    header('Location: ../index.php?status=Data Device Berhasil Terupdate');
  }
} else if (isset($_POST['update_device_non'])) {
  $id = $_POST['id'];
  $sd = $_POST['status_device'];
  $devt = $_POST['device_type'];
  $br = $_POST['brand'];
  $sn = $_POST['serial_number'];
  $ip = $_POST['ip'];
  $loc = $_POST['loc'];

  $sqlNonDev = "UPDATE tbl_non_device SET status_id = '$sd' WHERE nonDev_id = $id";
  $db->query($sqlNonDev);

  if ($sd == '3') {
    $startDate = $_POST['startDate'];

    if (isset($_POST['endDate']) && !empty($_POST['endDate'])) {
      $endDate = $_POST['endDate'];
    } else {
      $endDate = date('Y-m-d', strtotime($endDate));
    }

    $sqlCheckID = "SELECT COUNT(*) as count FROM tbl_repair WHERE serial_number = '$sn'";
    $result = $db->query($sqlCheckID);

    if (isset($_POST['vendor_name']) && !empty($_POST['vendor_name']) && isset($_FILES['detailsFile']) && $_FILES['detailsFile']['error'] === UPLOAD_ERR_OK) {
      $vendor = $_POST['vendor_name'];

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
          // ID exists, perform an UPDATE operation
          $sqlRepair = "UPDATE tbl_repair SET startDate = '$startDate', endDate = '$endDate', vendor_name = '$vendor' WHERE serial_number = '$sn'";
          $action = 'edit';
        } else {
          // ID doesn't exist, perform an INSERT operation
          $sqlRepair = "INSERT INTO tbl_repair (serial_number, startDate, endDate, vendor_name) VALUES ('$sn', '$startDate', '$endDate', '$vendor')";
          $action = 'insert';
        }
      } else {
        die("Error: Unable to check ID in the database.");
      }

      $image = $_FILES['detailsFile']['tmp_name'];
      $imageType = $_FILES['detailsFile']["type"];
      $allowedImageTypes = array("image/jpeg", "image/png", "image/gif", "application/pdf");
      if (in_array($imageType, $allowedImageTypes)) {
        $targetFileName = $nik . '_' . $sn . '.' . pathinfo($_FILES['detailsFile']['name'], PATHINFO_EXTENSION);

        $sql = "SELECT dvt.dvt_name FROM device_assets_computer dac LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id 
        WHERE dac.device_id=$id";
        $query = $db->query($sql);
        while ($row = mysqli_fetch_array($query)) {

          $smtpHost = 'smtp.gmail.com';
          $smtpUsername = 'subandonorogo@gmail.com';
          $smtpPassword = 'bweo iboj repb uhtl';
          $senderEmail = 'subandonorogo@gmail.com';
          $subject = $row['dvt_name'] . "_SN " . $sn . "_IT Samudera_" . $stn;
          $message = "Berikut adalah berita acara serah terima barang yang telah dibuat dan terlampir dalam file PDF.";

          $mail = new PHPMailer(true);

          try {
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom($senderEmail);
            $mail->addAddress('subandonorogo@gmail.com');
            $mail->Subject = $subject;
            $mail->Body = $message;

            // Lampirkan file PDF
            $mail->addAttachment($image, $targetFileName);

            // Kirim email
            $mail->send();
            header('Location: ../index.php?status=Laporan Detail Perbaikan dikirim ke email.');
          } catch (Exception $e) {
            echo "Terjadi kesalahan: {$mail->ErrorInfo}";
          }
        }
      } else {
        header('Location: ../index.php?status=Tipe file yang diunggah tidak valid. Hanya file gambar & PDF yang diperbolehkan.');
      }
    } else {
      $vendor = NULL;
      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
          // ID exists, perform an UPDATE operation
          $sqlRepair = "UPDATE tbl_repair SET startDate = '$startDate', endDate = '$endDate', vendor_name = '$vendor' WHERE serial_number = '$sn'";
          $action = 'edit';
        } else {
          // ID doesn't exist, perform an INSERT operation
          $sqlRepair = "INSERT INTO tbl_repair (serial_number, startDate, endDate, vendor_name) VALUES ('$sn', '$startDate', '$endDate', '$vendor')";
          $action = 'insert';
        }
      } else {
        die("Error: Unable to check ID in the database.");
      }
    }

    // Perform the query
    if ($db->query($sqlRepair) === TRUE) {
      // Redirect back to the index page with success message
      header("Location: ../index.php?status=Device Repair berhasil $action");
    } else {
      // Redirect back to the index page with error message
      header("Location: ../index.php?status=Gagal melakukan $action Device Repair");
    }
  } else {
    header('Location: ../index.php?status=Data Device Non-Staff berhasil Terupdate');
  }
} else {
  header('Location: ../index.php?status=Gagal');
}
