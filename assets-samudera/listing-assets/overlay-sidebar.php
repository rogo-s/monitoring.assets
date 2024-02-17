<?php include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Samudera - Admin Dashboard</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="../assets/img/logo_samudera.ico" type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
        urls: ["../assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/atlantis.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../assets/css/demo.css" />
</head>

<body>
  <div class="wrapper overlay-sidebar">
    <div class="main-header">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="blue2">
        <a href="index.php" class="logo">
          <img src="../assets/img/samudera-foto2.png" alt="navbar brand" class="navbar-brand" />
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
          <button class="btn btn-toggle sidenav-overlay-toggler">
            <i class="icon-menu"></i>
          </button>
        </div>
      </div>
      <!-- End Logo Header -->

      <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
        <div class="container-fluid">
          <div class="collapse" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pr-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input type="text" placeholder="Search ..." class="form-control" />
              </div>
            </form>
          </div>

          <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item toggle-nav-search hidden-caret">
              <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                <i class="fa fa-search"></i>
              </a>
            </li>
            <li class="nav-item dropdown hidden-caret">
              <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope"></i>
              </a>
              <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                <li>
                  <div class="dropdown-title d-flex justify-content-between align-items-center">
                    Messages
                    <a href="#" class="small">Mark all as read</a>
                  </div>
                </li>

                <li>
                  <div class="message-notif-scroll scrollbar-outer">
                    <div class="notif-center">
                      <a href="#">
                        <div class="notif-img">
                          <img src="../assets/img/jm_denis.jpg" alt="Img Profile" />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jimmy Denis</span>
                          <span class="block"> How are you ? </span>
                          <span class="time">5 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img src="../assets/img/chadengle.jpg" alt="Img Profile" />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Chad</span>
                          <span class="block"> Ok, Thanks ! </span>
                          <span class="time">12 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img src="../assets/img/mlane.jpg" alt="Img Profile" />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Jhon Doe</span>
                          <span class="block">
                            Ready for the meeting today...
                          </span>
                          <span class="time">12 minutes ago</span>
                        </div>
                      </a>
                      <a href="#">
                        <div class="notif-img">
                          <img src="../assets/img/talha.jpg" alt="Img Profile" />
                        </div>
                        <div class="notif-content">
                          <span class="subject">Talha</span>
                          <span class="block"> Hi, Apa Kabar ? </span>
                          <span class="time">17 minutes ago</span>
                        </div>
                      </a>
                    </div>
                  </div>
                </li>
                <li>
                  <a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item dropdown hidden-caret">
              <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="../assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
                </div>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <div class="dropdown-user-scroll scrollbar-outer">
                  <li>
                    <div class="user-box">
                      <div class="avatar-lg">
                        <img src="../assets/img/profile.png" alt="image profile" class="avatar-img rounded" />
                      </div>
                      <div class="u-text">
                        <h4>Hizrian</h4>
                        <p class="text-muted">hello@example.com</p>
                        <a href="profile.php" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="#">My Balance</a>
                    <a class="dropdown-item" href="#">Inbox</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Account Setting</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                  </li>
                </div>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- End Navbar -->
    </div>

    <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="user">
            <div class="avatar-sm float-left mr-2">
              <img src="../assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
            </div>
            <div class="info">
              <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                  Hizrian
                  <span class="user-level">Administrator</span>
                  <span class="caret"></span>
                </span>
              </a>
              <div class="clearfix"></div>

              <div class="collapse in" id="collapseExample">
                <ul class="nav">
                  <li>
                    <a href="#profile">
                      <span class="link-collapse">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="#edit">
                      <span class="link-collapse">Edit Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="#settings">
                      <span class="link-collapse">Settings</span>
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
                    <a href="index.php">
                      <span class="sub-item">Dashboard</span>
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
              <a data-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Sidebar Layouts</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="overlay-sidebar.php">
                      <span class="sub-item">Overlay Sidebar</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a data-toggle="collapse" href="#forms">
                <i class="fas fa-pen-square"></i>
                <p>User</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="forms">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="user/add-user.php">
                      <span class="sub-item">Add User</span>
                    </a>
                  </li>
                  <li>
                    <a href="user/add-device.php">
                      <span class="sub-item">Add Device</span>
                    </a>
                  </li>
                  <li>
                    <a href="user/add-device-non.php">
                      <span class="sub-item">Add Device Non-User</span>
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
                    <a href="tables/datatables.php">
                      <span class="sub-item">Datatables</span>
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
                <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
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
            $dev = "SELECT dvt.dvt_name, COUNT(*) as count FROM device_assets_computer dac
            LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id
            GROUP BY dvt_name";
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
            $atv = "SELECT atv.antivirus_name, COUNT(*) as count FROM device_assets_computer dac LEFT JOIN tbl_antivirus atv ON dac.antivirus_id = atv.antivirus_id GROUP BY antivirus_name";
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
                  <div class="table-responsive">
                    <table id="add-row-staff" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>NIK</th>
                          <th>Full Name</th>
                          <th>Gender</th>
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
                          <th style="width: 10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $device_id_input = '';


                          if (isset($_POST['device_id'])) {
                            $device_id_input = $_POST['device_id'];
                          }

                          $sql = "SELECT 
                          dac.device_id, dac.serial_number, dac.laptop_type, dac.antivirus_version,
                          dac.nik, dac.staff_name, dac.gender, dac.email,
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
                          LEFT JOIN tbl_wbit winb ON dac.wbit_id = winb.wbit_id";


                          if (!empty($device_id_input)) {
                            $sql .= " WHERE dac.device_id = '$device_id_input'";
                          }
                          $query = $db->query($sql);

                          if ($query->num_rows > 0) {
                            while ($row = $query->fetch_assoc()) {
                              echo "<tr class='search-row'>"; // Tambahkan class 'search-row' pada setiap baris tabel
                              echo "<td>" . $row['device_id'] . "</td>";
                              echo "<td>" . $row['nik'] . "</td>";
                              echo "<td>" . $row['staff_name'] . "</td>";
                              echo "<td>" . $row['gender'] . "</td>";
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
                              echo "<td>";
                              echo '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" onclick="window.location.href=\'../listing-assets/user/detail-user.php?id=' . $row['device_id'] . '\'">';
                              echo '<i class="fas fa-edit"></i>';
                              echo '</button>';
                              echo "</td>";
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

          <div class="row row-card-no-pd">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Assets Monitoring Non-Staff</div>
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
                  <div class="table-responsive">
                    <table id="add-row-non-staff" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Device Type</th>
                          <th>Brand</th>
                          <th>Serial Number</th>
                          <th>Internet Protocol</th>
                          <th>Location</th>
                          <th>Status Device</th>
                          <th style="width: 10%">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          // Query SELECT untuk mengambil data dari tabel tbl_non_device
                          $sql = "SELECT 
                          dn.nonDev_id, dn.serial_number, dn.ip, dn.loc, 
                          sts.status_device, dvt.dvt_name, br.brand_name,
                          rp.startDate, rp.endDate, rp.detailsFile
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
                              echo "<td>" . $row['status_device'] . "</td>";
                              echo "<td>";
                              echo '<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" onclick="window.location.href=\'../listing-assets/user/detail-non.php?id=' . $row['nonDev_id'] . '\'">';
                              echo '<i class="fas fa-edit"></i>';
                              echo '</a>';
                              echo "</td>";
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

          <div class="row row-card-no-pd">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">Staff</div>
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
                  <div class="table-responsive">
                    <table id="add-row-staff" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>NIK</th>
                          <th>Full Name</th>
                          <th>Gender</th>
                          <th>Email</th>
                          <th>Branch Name</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $sqlStaff = "SELECT 
                          stf.staff_id, stf.nik, stf.staff_name, stf.gender, stf.email,
                          brc.branch_id, brc.branch_name
                          FROM tbl_staf stf
                          LEFT JOIN tbl_branch brc ON stf.branch_id = brc.branch_id";

                          $queryStaff = $db->query($sqlStaff);

                          if (!$queryStaff) {
                            // Penanganan kesalahan jika query gagal dieksekusi
                            echo "Error executing the query: " . $db->error;
                          } else {

                            while ($row = mysqli_fetch_array($queryStaff)) {
                              echo "<tr>";
                              echo "<td>" . $row['staff_id'] . "</td>";
                              echo "<td>" . $row['nik'] . "</td>";
                              echo "<td>" . $row['staff_name'] . "</td>";
                              echo "<td>" . $row['gender'] . "</td>";
                              echo "<td>" . $row['email'] . "</td>";
                              echo "<td>" . $row['branch_name'] . "</td>";
                              echo "</tr>";
                            }
                          }

                          // Jangan lupa untuk menutup koneksi jika digunakan
                          $db->close();
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

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeSideBarColor" data-color="white"></button>
              <button type="button" class="changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Background</h4>
            <div class="btnSwitch">
              <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
              <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
              <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
              <button type="button" class="changeBackgroundColor" data-color="dark"></button>
            </div>
          </div>
        </div>
      </div>
      <div class="custom-toggle">
        <i class="flaticon-settings"></i>
      </div>
    </div>
    <!-- End Custom template -->
  </div>

  <!-- Custom template | don't include it in your project! -->
  <div class="custom-template">
    <div class="title">Settings</div>
    <div class="custom-content">
      <div class="switcher">
        <div class="switch-block">
          <h4>Logo Header</h4>
          <div class="btnSwitch">
            <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
            <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
            <br />
            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Navbar Header</h4>
          <div class="btnSwitch">
            <button type="button" class="changeTopBarColor" data-color="dark"></button>
            <button type="button" class="changeTopBarColor" data-color="blue"></button>
            <button type="button" class="changeTopBarColor" data-color="purple"></button>
            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
            <button type="button" class="changeTopBarColor" data-color="green"></button>
            <button type="button" class="changeTopBarColor" data-color="orange"></button>
            <button type="button" class="changeTopBarColor" data-color="red"></button>
            <button type="button" class="changeTopBarColor" data-color="white"></button>
            <br />
            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
            <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
            <button type="button" class="changeTopBarColor" data-color="green2"></button>
            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
            <button type="button" class="changeTopBarColor" data-color="red2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Sidebar</h4>
          <div class="btnSwitch">
            <button type="button" class="selected changeSideBarColor" data-color="white"></button>
            <button type="button" class="changeSideBarColor" data-color="dark"></button>
            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
          </div>
        </div>
        <div class="switch-block">
          <h4>Background</h4>
          <div class="btnSwitch">
            <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
            <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
            <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
            <button type="button" class="changeBackgroundColor" data-color="dark"></button>
          </div>
        </div>
      </div>
    </div>
    <div class="custom-toggle">
      <i class="flaticon-settings"></i>
    </div>
  </div>
  <!-- End Custom template -->
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery UI -->
  <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

  <!-- Chart JS -->
  <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
  <script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

  <!-- Sweet Alert -->
  <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Atlantis JS -->
  <script src="../assets/js/atlantis.min.js"></script>
  <script>
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
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
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

      // Funsi pencarian untuk table just staff
      $("#search-form-staff-just").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-staff-just").val().toLowerCase();
        $("#add-row-staff-just tbody tr").each(function() {
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
  </script>
</body>

</html>