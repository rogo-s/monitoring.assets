<?php 
session_start();
include("assets-samudera/listing-assets/config.php");
include('dbcon.php');
if(!$_SESSION["auth_user"]) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Samudera - User Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="assets-samudera/assets/img/logo_samudera.ico" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-c0+XrJJNp+k/zraUnkKQ0j0HVcv1P+Wq2A2j1fe57fwMMLrMrj7iDbb1EGI4OidGgV5nS02MTZ+U6J3m1lEH7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    /* Styling untuk tabel */
    .table-wrapper {
        overflow-x: auto;
        max-height: 400px;
        }

        .table {
        width: 100%;
        border-collapse: collapse;
        background-color: #f9f9f9;
        box-shadow: 0 4px 6px rgb(95, 181, 230);
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        border-radius: 8px;
        overflow: hidden;
        }

        .table th,
        .table td {
        padding: 14px 20px;
        border: 1px solid #e0e0e0;
        text-align: left;
        transition: transform 0.2s ease-in-out;
        }

        .table th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #444;
        }

        .table tbody tr:nth-child(odd) {
        background-color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
        background-color: #f7f7f7;
        }

        .table tbody tr:hover td {
        transform: scale(1.1);
        z-index: 1;
        background-color: #f0f0f0;
        }

        /* Styling untuk tombol cari */
        .btn-primary {
        background-color: #007bff;
        color: #ffffff;
        border: none;
        padding: 12px 24px;
        cursor: pointer;
        font-weight: bold;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgb(95, 181, 230);
        transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
        }
    /* style chat */
    .live-chat-container {
        cursor: pointer;
        padding: 15px; /* Increase padding for a more spacious look */
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }

    .user-profile {
        display: flex;
        align-items: center;
    }

    .user-profile .avatar-sm {
        margin-right: 15px; /* Increase margin for more spacing */
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: bold;
    }

    .user-status {
        color: green;
    }

    .last-message {
        flex-grow: 1;
        text-align: right;
        margin-left: 15px; /* Increase margin for more spacing */
        color: #777;
    }

    .search-container {
        padding: 10px;
    }

    #search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .example-chats {
        margin-top: 20px;
    }

    .example-chats .user {
        font-weight: bold;
    }

    .example-chats .message {
        margin-top: 5px;
    }
    .custom-dropdown {
    width: 350px !important; /* Use !important to override existing styles if necessary */
    }

        .chat-container{
        z-index: 9999;
        position: fixed;
        bottom: 0;
        right: 50px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        }
        .chat-header {
        background-color: #3498db;
        color: #fff;
        padding: 10px;
        display: flex;
        justify-content: space-between;
        }

        .chat-header > p{
        font-size: 18px;
        padding: 0;
        margin: 0;
        }

        .chat-body {
        padding: 10px;
        width: 350px;
        height: 300px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        
        }

        .message {
        width: fit-content;
        background-color: #e0e0e0;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 5px;
        align-self: flex-start;
        }

        .user-message {
        background-color: #3498db;
        color: #fff;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 5px;
        align-self: flex-end;
        }

        .input-container {
        padding: 10px;
        border-top: 1px solid #ccc;
        display: flex;
        }

        .message-input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        }

        .send-button {
        background-color: #3498db;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        }

        .btn-close{
        border: none;
        background: none;
        cursor: pointer;
        color: white;
        }

        .btn-close:hover{
        color: #e8ebe9;
        }

        .btn-close > i{
        font-size: 24px;
        }
        .test {
        display: none;
        }
        .show{
        display: block;
        }

        /* Tambahkan gaya untuk kotak-kotak statistik */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out; /* Animasi ketika kursor diarahkan */
            font-family: 'Roboto', sans-serif; /* Ganti dengan font yang Anda inginkan */
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Efek box shadow saat kursor diarahkan */
        }

        .card-body {
            padding: 20px;
            text-align: left; /* Posisi teks di sebelah kiri */
        }

        .card h5 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #3498db; /* Ubah warna teks sesuai keinginan Anda */
            display: flex;
            align-items: center; /* Posisikan ikon dan teks secara vertikal di tengah */
        }

        .card h5 i {
            margin-right: 10px; /* Atur jarak antara ikon dan teks */
        }

        .card p {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333; /* Ubah warna teks sesuai keinginan Anda */
        }

        /* Tambahkan gaya untuk baris */
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        /* Tambahkan padding ke container utama */
        .container {
            padding: 20px;
        }
  </style>

  <!-- Fonts and icons -->
  <script src="assets-samudera/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Lato:300,400,700,900"]
      },
      custom: {
        families: [
          "Flaticon",
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["assets-samudera/assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="assets-samudera/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets-samudera/assets/css/atlantis.min.css" />
</head>

<body>
  <div class="wrapper">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="blue">
        <a href="dashboard.php" class="logo">
          <img src="assets-samudera/assets/img/white.png" width="200px" height="40px" alt="navbar brand" class="navbar-brand" />
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon">
            <i class="icon-menu"></i>
          </span>
        </button>
        <button class="topbar-toggler more">
          <i class="icon-options-vertical"></i>
        </button>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="icon-menu"></i>
          </button>
        </div>
      </div>
      <!-- End Logo Header -->

      <?php include('includes/navbar-user-add.php');?>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="user">
            <div class="avatar-sm float-left mr-2">
              <img src="assets-samudera/assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
            </div>
            <div class="info">
              <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                  <h4> <?=$_SESSION['auth_user']['username'];?></h4>
                  <span class="user-level">User</span>
                  <span class="caret"></span>
                </span>
              </a>
              <div class="clearfix"></div>

              <div class="collapse in" id="collapseExample">
                <ul class="nav">
                  <li>
                    <a href="user-akses/profile.php">
                      <span class="link-collapse">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="destroy-session.php">
                      <span class="link-collapse">Log Out</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <ul class="nav nav-primary">
            <li class="nav-item active">
              <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="dashboard">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="dashboard.php">
                      <span class="sub-item">Listing Assets</span>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.samudera.id/mtki/id">
                      <span class="sub-item">Portal Information</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
              <h4 class="text-section">Components</h4>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>Berkas Assets</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="user-akses/graph-user.php">
                      <span class="sub-item">Graph User</span>
                    </a>
                  </li>
                  <li>
                    <a href="user-akses/graph-device.php">
                      <span class="sub-item">Graph Device</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#tables">
                <i class="fas fa-table"></i>
                <p>Tables</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="tables">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="user-akses/datables.php">
                      <span class="sub-item">Datatables</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#calender">
                <i class="fas fa-table"></i>
                <p>Calender</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="calender">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="schedule/kalender-user.php">
                      <span class="sub-item">Calender</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- End Sidebar -->
    <div class="main-panel">
      <div class="content">
        <div class="panel-header bg-primary-gradient">
          <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
              <div>
                <h2 class="text-white pb-2 fw-bold">Dashboard Lissting Assets</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-inner mt--5">
          <div class="row mt--2">
            <div class="col-md-6">
              <div class="card full-height">
                <div class="card-body">
                  <div class="card-title">Device Type Chart</div>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                  </div>
                </div>
              </div>
            </div>
          
            <?php
            $branch = $_SESSION['auth_user']['branch'];
            $dev = "SELECT dvt.dvt_name , COUNT(*) as count FROM device_assets_computer dac 
            LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id
            LEFT JOIN tbl_branch brc on dac.branch_id = brc.branch_id where brc.branch_name ='$branch' GROUP BY dvt_name";
            $query = $db->query($dev);
            $devCount = array(
              'Laptop' => 0,
              'PC (Desktop)' => 0,
            );

            while ($row = $query->fetch_assoc()) {
              $device = $row['dvt_name'];
              $count = (int)$row['count'];
              $devCount[$device] = $count;
            }

            $dataDev = json_encode($devCount);
            ?>

            <div class="col-md-6">
              <div class="card full-height">
                <div class="card-body">
                  <div class="card-title">Antivirus Chart</div>
                </div>
                <div class="card-body">
                  <div class="chart-container">
                    <canvas id="donutChart" style="width: 50%; height: 50%"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <?php
            $branch = $_SESSION['auth_user']['branch'];
            $atv = "SELECT atv.antivirus_name, COUNT(*) as count FROM device_assets_computer dac 
            LEFT JOIN tbl_antivirus atv ON dac.antivirus_id = atv.antivirus_id
            LEFT JOIN tbl_branch brc on dac.branch_id = brc.branch_id where brc.branch_name ='$branch' GROUP BY antivirus_name";
            $queryAtv = $db->query($atv);

            $atvCount = array(
              'Symmantec End Point Protection' => 0,
              'McAffee' => 0,
            );

            while ($row = $queryAtv->fetch_assoc()) {
              $antivirus = $row['antivirus_name'];
              $aCount = (int)$row['count'];
              $atvCount[$antivirus] = $aCount;
            }
            $dataAtv = json_encode($atvCount);
            ?>
          </div>

          <div class="row row-card-no-pd">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Assets Monitoring</div>
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <form id="search-form-staff">
                        <div class="input-group mb-1">
                          <input type="text" class="form-control" placeholder="Cari berdasarkan NIK, Nama, Email, dll..." name="keyword" id="search-keyword-staff">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-head-row card-tools-still-right">
                  <div class="table-responsive table-wrapper">
                    <table id="add-row-staff" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                         
                          <th>NIK</th>
                          <th>Full Name</th>
                          <th>Email</th>
                          <th>Branch Name</th>
                          <th>Device Name</th>
                          <th>Serial Number</th>
                          <th>Brand Name</th>
                          <th>Laptop Type</th>
                          <th>Domain</th>
                          <th>Windows Name</th>
                          <th>Windows Bit</th>
                          <th>Antivirus Name</th>
                          <th>Antivirus Version</th>
                          <th>Status Device</th>
                          <th>Details</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $device_id = '';

                        if (isset($_POST['device_id'])) {
                          $device_id = $_POST['device_id'];
                        }
                        $branch = $_SESSION['auth_user']['branch'];
                        $sql = "SELECT 
                        dac.device_id, dac.serial_number, dac.laptop_type, dac.antivirus_version, dac.status_id,
                        dac.nik, dac.staff_name, dac.email,
                        brc.branch_name, sts.status_device,
                        dvt.dvt_name, atv.antivirus_name, br.brand_name, dom.domain_name, winn.windows_name, 
                        winb.windows_bit
                        FROM device_assets_computer dac
                        LEFT JOIN tbl_branch brc ON dac.branch_id = brc.branch_id
                        LEFT JOIN tbl_status sts ON dac.status_id = sts.status_id 
                        LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id
                        LEFT JOIN tbl_antivirus atv ON dac.antivirus_id = atv.antivirus_id
                        LEFT JOIN tbl_brand br ON dac.brand_id = br.brand_id
                        LEFT JOIN tbl_domain dom ON dac.domain_id = dom.domain_id
                        LEFT JOIN tbl_windows winn ON dac.windows_id = winn.windows_id
                        LEFT JOIN tbl_wbit winb ON dac.wbit_id = winb.wbit_id where brc.branch_name='$branch' ORDER BY dac.device_id ASC";
                       
                        if (!empty($device_id)) {
                          $sql .= " WHERE dac.device_id = '$device_id'  && brc.branch_name='$branch'";
                        }
                        $query = $db->query($sql);

                        if ($query->num_rows > 0) {
                          while ($row = $query->fetch_assoc()) {
                            if ($row['status_device'] === 'Active') {
                              $status = '<a href="#" onclick="openFloatingPDF(' . $row['device_id'] . ');">View File</a>';
                            } else if ($row['status_device'] === 'Repair') {
                              $status = "On Process";
                            } else {
                              $status = "Stock";
                            }
                            echo "<tr class='search-row'>";
                            echo "<td>" . $row['device_id'] . "</td>";
                            echo "<td>" . $row['nik'] . "</td>";
                            echo "<td>" . $row['staff_name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['branch_name'] . "</td>";
                            echo "<td>" . $row['dvt_name'] . "</td>";
                            echo "<td>" . $row['serial_number'] . "</td>";
                            echo "<td>" . $row['brand_name'] . "</td>";
                            echo "<td>" . $row['laptop_type'] . "</td>";
                            echo "<td>" . $row['domain_name'] . "</td>";
                            echo "<td>" . $row['windows_name'] . "</td>";
                            echo "<td>" . $row['windows_bit'] . "</td>";
                            echo "<td>" . $row['antivirus_name'] . "</td>";
                            echo "<td>" . $row['antivirus_version'] . "</td>";
                            echo "<td>" . $row['status_device'] . "</td>";
                            echo "<td>" . $status . "</td>";
                            echo "</tr>";
                          }
                        } else {
                          // Jika data tidak ditemukan, tampilkan pesan kosong
                          echo "<tr><td colspan='18' style='text-align: center;'>Tidak ada data.</td></tr>";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- kotak info assets non user-->
          <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $totalDeviceTypeQuery = "SELECT COUNT(DISTINCT dvt.dvt_name) as total FROM tbl_non_device dn
                            LEFT JOIN tbl_dvt dvt ON dn.dvt_id = dvt.dvt_id";
                            $totalDeviceTypeResult = $db->query($totalDeviceTypeQuery);
                            $totalDeviceType = $totalDeviceTypeResult->fetch_assoc()['total'];

                            echo "<h5><i class='fas fa-laptop'></i> Total Device Type</h5>"; /* Ganti kelas ikon dengan yang sesuai dari Font Awesome */
                            echo "<p>{$totalDeviceType} Device</p>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $totalBrandQuery = "SELECT COUNT(DISTINCT br.brand_name) as total FROM tbl_non_device dn
                            LEFT JOIN tbl_brand br ON dn.brand_id = br.brand_id";
                            $totalBrandResult = $db->query($totalBrandQuery);
                            $totalBrand = $totalBrandResult->fetch_assoc()['total'];

                            echo "<h5><i class='fas fa-mobile-alt'></i> Total Brand</h5>"; /* Ganti kelas ikon dengan yang sesuai dari Font Awesome */
                            echo "<p>{$totalBrand} Brand</p>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            echo "<h5><i class='fas fa-chart-pie'></i> Total Status</h5>";

                            $totalStatusQuery = "SELECT 
                                COUNT(*) as total,
                                COUNT(CASE WHEN sts.status_device = 'Active' THEN 1 END) as totalActive,
                                COUNT(CASE WHEN sts.status_device = 'Repair' THEN 1 END) as totalRepair,
                                COUNT(CASE WHEN sts.status_device = 'Non-Active' THEN 1 END) as totalNonActive
                                FROM tbl_non_device dn
                                LEFT JOIN tbl_status sts ON dn.status_id = sts.status_id";
                            $totalStatusResult = $db->query($totalStatusQuery);
                            $totalStatus = $totalStatusResult->fetch_assoc();

                            echo "<p>Active: {$totalStatus['totalActive']}</p>";
                            echo "<p>Repair: {$totalStatus['totalRepair']}</p>";
                            echo "<p>Non-Active: {$totalStatus['totalNonActive']}</p>";
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $totalVendorQuery = "SELECT COUNT(DISTINCT rp.vendor_name) as total FROM tbl_non_device dn
                            LEFT JOIN tbl_repair rp ON dn.serial_number = rp.serial_number";
                            $totalVendorResult = $db->query($totalVendorQuery);
                            $totalVendor = $totalVendorResult->fetch_assoc()['total'];

                            echo "<h5><i class='fas fa-cogs'></i> Total Vendor</h5>"; /* Ganti kelas ikon dengan yang sesuai dari Font Awesome */
                            echo "<p>{$totalVendor} Vendor</p>";
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
          <div class="row row-card-no-pd">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Non-Staff Assets Monitoring</div>
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <form id="search-form-non-staff">
                        <div class="input-group mb-1">
                          <input type="text" class="form-control" placeholder="Cari berdasarkan Nama_Brand, type_brnad, dll..." name="keyword" id="search-keyword-non-staff">
                          <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="card-head-row card-tools-still-right">
                  <div class="table-responsive table-wrapper">
                    <table id="add-row-non-staff" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Device Type</th>
                          <th>Brand</th>
                          <th>Serial Number</th>
                          <th>Internet Protocol</th>
                          <th>Location</th>
                          <th>Vendor Name</th>
                          <th>Status Device</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          // Query SELECT untuk mengambil data dari tabel tbl_non_device
                          $sql = "SELECT 
                          dn.nonDev_id, dn.serial_number, dn.ip, dn.loc, 
                          sts.status_device, dvt.dvt_name, br.brand_name,
                          rp.startDate, rp.endDate, rp.vendor_name
                          FROM tbl_non_device dn
                          LEFT JOIN tbl_status sts ON dn.status_id = sts.status_id 
                          LEFT JOIN tbl_dvt dvt ON dn.dvt_id = dvt.dvt_id
                          LEFT JOIN tbl_brand br ON dn.brand_id = br.brand_id
                          LEFT JOIN tbl_repair rp ON dn.serial_number = rp.serial_number";
                          $result = $db->query($sql);

                          // Jika data ditemukan, tampilkan dalam bentuk tabel
                          if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                              echo "<tr>";
                              echo "<td>" . $row['nonDev_id'] . "</td>";
                              echo "<td>" . $row['dvt_name'] . "</td>";
                              echo "<td>" . $row['brand_name'] . "</td>";
                              echo "<td>" . $row['serial_number'] . "</td>";
                              echo "<td>" . $row['ip'] . "</td>";
                              echo "<td>" . $row['loc'] . "</td>";
                              echo "<td>" . $row['vendor_name'] . "</td>";
                              echo "<td>" . $row['status_device'] . "</td>";
                              echo "</tr>";
                            }
                          } else {
                            // Jika data tidak ditemukan, tampilkan pesan kosong
                            echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
                          }
                          ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="https://www.samudera.id/mtki/id">
                  Samudera Indonesia
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright ml-auto">
            2023, create by
            <a href="https://www.samudera.id/mtki/id">Samudera Indonesia</a>
          </div>
        </div>
      </footer>
    </div>

  </div>
    <div class="chat-container test">
        <div class="chat-header">
            <p class="name-chat-box">Chat Box</p>
            <button class="btn-close" onclick="closeChat()"><i class="fa fa-close"></i></button>

          </div>
          <div class="chat-body" id="chatBody">
          </div>
          <div class="input-container">
            <input type="text" class="message-input" placeholder="Type your message...">
            <button class="send-button">Send</button>
        </div>
    </div>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- Include core scripts -->
  <script src="assets-samudera/assets/js/core/popper.min.js"></script>
  <script src="assets-samudera/assets/js/core/bootstrap.min.js"></script>

  <!-- Include jQuery UI and related plugins -->
  <script src="assets-samudera/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="assets-samudera/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

  <!-- Include jQuery Scrollbar -->
  <script src="assets-samudera/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Include Chart Pie from CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Include Atlantis JS -->
  <script src="assets-samudera/assets/js/atlantis.min.js"></script>
  <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script>
    let showChatData = false;
    const nameChatBox = document.querySelector(".name-chat-box")
    const socket = io("ws://localhost:3000/");
    const userLoggedIn = '<?php echo $_SESSION['auth_user']['username']; ?>';
    socket.emit("register", userLoggedIn)        
    const button = document.querySelector(".send-button")
    const message = document.querySelector('.message-input')
    const chatBodyEl = document.getElementById("chatBody");
    var divEl = document.createElement('div')
    let receiverId ="";
  
    button.addEventListener('click', async function(e) {
      divEl.className = 'user-message';
      const time = moment().format("h:mm A")
      console.log(message.value + "<-----")
      divEl.textContent = message.value ;
      const startIndex = nameChatBox.textContent.indexOf('[');
      const name = nameChatBox.textContent.substring(0, startIndex).trim();
     const data = await axios.post("http://localhost:3000/savechat", {
      message: message.value,
      receiver: name,
      sender: '<?=$_SESSION['auth_user']['username'] ?>'
     })
     console.log(message.value  + "<--------");
      socket.emit("sendmessage", {to:name, from:userLoggedIn, message: message.value})
      message.value =""
      chatBodyEl.appendChild(divEl.cloneNode(true));
    })

    socket.on("receivemessage", ({ from, message }) => {
      if(showChatData) { 
        const datapesan = message
      divEl.className = 'message';
      divEl.textContent= datapesan
      chatBodyEl.appendChild(divEl.cloneNode(true));
      }
    });



    var chartPie = <?php echo $dataDev; ?>;
    var chartDonut = <?php echo $dataAtv; ?>;
    // Menggunakan data yang telah dikirim dari PHP
    var pie = chartPie;
    var donut = chartDonut;

    // Membuat chart pie menggunakan Chart.js
    var pieChart = document.getElementById('pieChart').getContext('2d');
    var donutChart = document.getElementById('donutChart').getContext('2d');

    var myPieChart = new Chart(pieChart, {
      type: 'pie',
      data: {
        labels: Object.keys(pie),
        datasets: [{
          data: Object.values(pie),
          backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b", "green"],
          borderWidth: 0,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          position: "bottom",
          labels: {
            fontColor: "rgb(154, 154, 154)",
            fontSize: 11,
            usePointStyle: true,
            padding: 20,
          },
        },
        pieceLabel: {
          render: "percentage",
          fontColor: "white",
          fontSize: 14,
        },
        tooltips: false,
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
          },
        },
      },
    });

    var myDonutChart = new Chart(donutChart, {
      type: 'doughnut', // Use 'doughnut' for donut chart
      data: {
        labels: Object.keys(donut),
        datasets: [{
          data: Object.values(donut),
          backgroundColor: ["#1d7af3", "#f3545d", "#fdaf4b"],
          borderWidth: 0,
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutoutPercentage: 70, // Adjust the cutoutPercentage to change the size of the donut hole
        legend: {
          position: "bottom",
          labels: {
            fontColor: "rgb(154, 154, 154)",
            fontSize: 11,
            usePointStyle: true,
            padding: 20,
          },
        },
        pieceLabel: {
          render: "percentage",
          fontColor: "white",
          fontSize: 14,
        },
        tooltips: false,
        layout: {
          padding: {
            left: 20,
            right: 20,
            top: 20,
            bottom: 20,
          },
        },
      },
    });
    // end of chart
    $(document).ready(function() {
      // Fungsi pencarian untuk tabel staf
      $("#search-form-staff").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-staff").val().toLowerCase();
        $("#add-row-staff tbody tr").each(function() {
          const rowData = $(this).text().toLowerCase();
          if (rowData.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });

      // Fungsi pencarian untuk tabel non-staf
      $("#search-form-non-staff").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-non-staff").val().toLowerCase();
        $("#add-row-non-staff tbody tr").each(function() {
          const rowData = $(this).text().toLowerCase();
          if (rowData.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
    });

    function openFloatingPDF(device_id) {
      // Membuka jendela pop-up dengan dokumen PDF
      window.open('assets-samudera/listing-assets/user/view.php?id=' + device_id, '_blank', 'width=800,height=600');
      if (!popup) {
        alert('Pop-up blocked! Please allow pop-ups for this site.');
      }
    }

    function confirmDelete() {
      return confirm("Apakah Anda yakin ingin menghapus data ini?");
    }
    
      async function showChat(name) {
        showChatData = true;
        const testElement = document.querySelector('.chat-container');
        testElement.classList.remove('test');
        nameChatBox.textContent = name;
        testElement.classList.add('show');
        const sender = '<?php echo $_SESSION['auth_user']['username'] ?>';
        const {data }= await axios.get(`http://localhost:3000/getchat?sender=${sender}&receiver=${name}`)
        const {result} = data;
        
        socket.emit("checkonline", {receiver: name, sender: userLoggedIn} )

        socket.on('validateonline', ({message}) => {
          nameChatBox.textContent = name + " [" + message + "] ";
        })
    
        for(let i = 0; i < result.length; i++) {
          if(result[i].sender === sender) {
            divEl.className = 'user-message';
            divEl.textContent = result[i].chat + " (" + result[i].time + ")";
            chatBodyEl.appendChild(divEl.cloneNode(true));
          }else {
          divEl.className = 'message';
          divEl.textContent = result[i].chat + " (" + result[i].time + ")";
          chatBodyEl.appendChild(divEl.cloneNode(true));
          }
        }

      }

        function closeChat(){
          const btnClose = document.querySelector(".chat-container");
      
      const chatContainer = document.querySelector(".chat-container");
  const chatBodyEl = chatContainer.querySelector(".chat-body");

  // Clear existing messages in the chat window
  while (chatBodyEl.firstChild) {
    chatBodyEl.removeChild(chatBodyEl.firstChild);
  }

  // Reset classes
  chatContainer.classList.remove('show');
  chatContainer.classList.add('test');
        }
  </script>
</body>
</html>