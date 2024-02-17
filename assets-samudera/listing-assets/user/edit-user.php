<?php
session_start();

include("../config.php");
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  
if(!$_SESSION["auth_user"]) {
  header("Location: ../../../login.php");
}
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Samudera - Edit User</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../../assets/img/logo_samudera.ico" type="image/x-icon" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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
    .user__chat-container {
        max-height: 400px;
        overflow-y: auto;
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
    </style>
    <!-- Fonts and icons -->
    <script src="../../assets/js/plugin/webfont/webfont.min.js"></script>
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
          urls: ["../../assets/css/fonts.min.css"],
        },
        active: function() {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <style>
      #form-option3 label,
      #form-option3 input {
        display: block;
        margin-bottom: 5px;
      }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../assets/css/atlantis.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

  </head>

  <body>
    <div class="wrapper sidebar_minimize">
      <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">
          <a href="../index.php" class="logo">
            <img src="../../assets/img/white.png" width="200px" height="40px" alt="navbar brand" class="navbar-brand" />
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

        <?php include('../../../includes/navbar-admin-add.php');?>

      <!-- Sidebar -->
    <div class="sidebar sidebar-style-2">
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <div class="user">
            <div class="avatar-sm float-left mr-2">
              <img src="../../assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
            </div>
            <div class="info">
              <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                <span>
                <h4> <?=$_SESSION['auth_user']['username'];?></h4>
                  <span class="user-level">Admin IT</span>
                  <span class="caret"></span>
                </span>
              </a>
              <div class="clearfix"></div>

              <div class="collapse in" id="collapseExample">
                <ul class="nav">
                  <li>
                    <a href="../../../user-akses/profile.php">
                      <span class="link-collapse">My Profile</span>
                    </a>
                  </li>
                  <li>
                    <a href="../../../destroy-session.php">
                      <span class="link-collapse">Log Out</span>
                    </a>
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
                      <a href="../index.php">
                        <span class="sub-item">Listing Assets</span>
                      </a>
                    </li>
                    <li>
                      <a href="../listing-staff.php">
                        <span class="sub-item">Listing Staff</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a data-toggle="collapse" href="#forms">
                  <i class="fas fa-pen-square"></i>
                  <p>Add List</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="forms">
                  <ul class="nav nav-collapse">
                    <li>
                      <a href="add-user.php">
                        <span class="sub-item">Add Staff</span>
                      </a>
                    </li>
                    <li>
                      <a href="add-device.php">
                        <span class="sub-item">Add Device</span>
                      </a>
                    </li>
                    <li>
                      <a href="add-device-non.php">
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
                      <a href="../tables/datatables.php">
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
      <div class="main-panel">
        <div class="content">
          <div class="page-inner">
            <div class="page-header">
              <h4 class="page-title">Edit Staff</h4>
              <ul class="breadcrumbs">
                <li class="nav-home">
                  <a href="#">
                    <i class="flaticon-home"></i>
                  </a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="./detail-user.php">Detail Staff</a>
                </li>
                <li class="separator">
                  <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                  <a href="./edit-user.php">Edit Staff</a>
                </li>
              </ul>
            </div>
            <div class="row">
              <div class="col-md-12">
                <form id="submit-edit" action="proses-edit.php" method="POST" enctype="multipart/form-data">
                  <div class="card">
                    <div class="card-header">
                      <div class="card-title">Edit Staff</div>
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 col-lg-4">
                          <?php
                          $query = "SELECT 
                          dac.serial_number, dac.laptop_type, dac.antivirus_version,
                          dac.nik, dac.staff_name, dac.gender, dac.email,
                          brc.branch_id, sts.status_id, dvt.dvt_id, atv.antivirus_id, 
                          br.brand_id, dom.domain_id, winn.windows_id, winb.wbit_id,
                          rp.startDate, rp.endDate, rp.vendor_name
                          FROM device_assets_computer dac
                          LEFT JOIN tbl_branch brc ON dac.branch_id = brc.branch_id
                          LEFT JOIN tbl_status sts ON dac.status_id = sts.status_id 
                          LEFT JOIN tbl_dvt dvt ON dac.dvt_id = dvt.dvt_id
                          LEFT JOIN tbl_antivirus atv ON dac.antivirus_id = atv.antivirus_id
                          LEFT JOIN tbl_brand br ON dac.brand_id = br.brand_id
                          LEFT JOIN tbl_domain dom ON dac.domain_id = dom.domain_id
                          LEFT JOIN tbl_windows winn ON dac.windows_id = winn.windows_id
                          LEFT JOIN tbl_wbit winb ON dac.wbit_id = winb.wbit_id
                          LEFT JOIN tbl_repair rp ON dac.serial_number = rp.serial_number
                          WHERE device_id = $id";
                          $result = mysqli_query($db, $query);

                          if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $nik = isset($row['nik']) ? $row['nik'] : null;
                            $stn = isset($row['staff_name']) ? $row['staff_name'] : null;
                            $gen = isset($row['gender']) ? $row['gender'] : null;
                            $email = isset($row['email']) ? $row['email'] : null;
                            $branch_id = isset($row['branch_id']) ? $row['branch_id'] : null;
                            $status_id = isset($row['status_id']) ? $row['status_id'] : null;
                            $dvt_id = isset($row['dvt_id']) ? $row['dvt_id'] : null;
                            $brand_id = isset($row['brand_id']) ? $row['brand_id'] : null;
                            $lt = isset($row['laptop_type']) ? $row['laptop_type'] : null;
                            $sn = isset($row['serial_number']) ? $row['serial_number'] : null;
                            $domain_id = isset($row['domain_id']) ? $row['domain_id'] : null;
                            $atv_id = isset($row['antivirus_id']) ? $row['antivirus_id'] : null;
                            $atvv = isset($row['antivirus_version']) ? $row['antivirus_version'] : null;
                            $winn_id = isset($row['windows_id']) ? $row['windows_id'] : null;
                            $winb_id = isset($row['wbit_id']) ? $row['wbit_id'] : null;
                            $start = isset($row['startDate']) ? $row['startDate'] : null;
                            $end = isset($row['endDate']) ? $row['endDate'] : null;
                            $vendor = isset($row['vendor_name']) ? $row['vendor_name'] : null;
                          ?>

                            <div class="form-group">
                              <?php
                              echo '<input type="hidden" name="id" value="' . $id . '">';
                              echo '<label for="disableinput">Company (Disabled)</label>';
                              echo '<input type="text" class="form-control" id="disableinput" placeholder="Company" value="Samudera Logistik." disabled />';
                              ?>
                            </div>

                            <div class="form-group">
                              <label for="nik">Nomor Induk Kepegawaian</label>
                              <input type="number" class="form-control nik-check" name="nik" placeholder="NIK" id="nik" value="<?php echo $nik ?>" />
                            </div>

                            <div class="form-group">
                              <label for="staff_name">Staff Name</label>
                              <input type="text" class="form-control" name="staff_name" id="staff_name" autocomplete="off" placeholder="Staff Name" value="<?php echo $stn ?>" />
                            </div>

                            <div class="form-check">
                              <input type="hidden" name="gender" id="hidden_gender" value="<?php echo $gen ?>">

                            </div>

                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control email-check" name="email" placeholder="Email" id="email" value="<?php echo $email ?>" />
                            </div>

                            <div class="form-group">
                              <label>Branch</label>
                              <select class="form-control" name="branch" id="branch_id">
                                <option name="branch">Choose Branch</option>
                                <?php
                                while ($row_branch = mysqli_fetch_assoc($resultBranch)) {
                                  $selected = ($row_branch['branch_id'] == $branch_id) ? 'selected' : '';
                                  echo '<option value="' . $row_branch['branch_id'] . '"' . $selected . '>' . $row_branch['branch_name'] . '</option>';
                                }
                                ?>
                              </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                          <div class="form-group">
                            <label>Status Device</label>
                            <select class="form-control" name="status_device" id="options1" onchange="toggleForm(1)()">
                              <option name="status_device">Choose Status Device</option>';
                              <?php
                              while ($row = mysqli_fetch_assoc($resultStatus)) {
                                $selected = ($row['status_id'] == $status_id) ? 'selected' : '';
                                echo '<option value="' . $row['status_id'] . '"' . $selected . '>' . $row['status_device'] . '</option>';
                              }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Device Type</label>
                            <select class="form-control" name="device_type" id="options2" onchange="toggleForm(2)()">
                              <option name="device_type">Choose Device Type</option>
                              <?php
                              while ($row = mysqli_fetch_assoc($resultDevt)) {
                                $selected = ($row['dvt_id'] == $dvt_id) ? 'selected' : '';
                                echo '<option value="' . $row['dvt_id'] . '"' . $selected . '>' . $row['dvt_name'] . '</option>';
                              }
                              ?>
                            </select>
                          </div>

                          <div class="form-group">
                            <?php
                            echo '<label>Brand</label>';
                            echo '<select class="form-control" name="brand">';
                            echo '<option name="brand">Choose Brand</option>';
                            while ($row = mysqli_fetch_assoc($resultBr)) {
                              $selected = ($row['brand_id'] == $brand_id) ? 'selected' : '';
                              echo '<option value="' . $row['brand_id'] . '"' . $selected . '>' . $row['brand_name'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                          </div>

                          <div class="form-group">
                            <?php
                            echo '<label for="type-laptop">Type Laptop</label>';
                            echo '<input type="text" class="form-control" name="laptop_type" placeholder="Type Laptop" value="' . $lt . '"/>';
                            ?>
                          </div>

                          <div class="form-group">
                            <label for="serial-number">Serial Number</label>
                            <input type="text" class="form-control" name="serial_number" placeholder="Serial Number" value="<?php echo ($dvt_id != 2) ? $sn : NULL; ?>" />
                          </div>


                          <div class=" form-group">
                            <?php
                            echo '<label>Domain</label>';
                            echo '<select class="form-control" name="domain">';
                            echo '<option name="domain">Choose Domain</option>';
                            while ($row = mysqli_fetch_assoc($resultDomain)) {
                              $selected = ($row['domain_id'] == $domain_id) ? 'selected' : '';
                              echo '<option value="' . $row['domain_id'] . '"' . $selected . '>' . $row['domain_name'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                          </div>
                        </div>

                        <div class="col-md-6 col-lg-4">
                          <label class="mb-3"><b>Antivirus</b></label>
                          <div class="form-group">
                            <?php
                            echo '<label>Antivirus Name</label>';
                            echo '<select class="form-control" name="antivirus_name">';
                            echo '<option name="antivirus_name">Choose Antivirus</option>';
                            while ($row = mysqli_fetch_assoc($resultAtv)) {
                              $selected = ($row['antivirus_id'] == $atv_id) ? 'selected' : '';
                              echo '<option value="' . $row['antivirus_id'] . '"' . $selected . '>' . $row['antivirus_name'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                          </div>

                          <div class="form-group">
                            <?php
                            echo '<label class="placeholder">Antivirus Version</label>';
                            echo '<input type="text" class="form-control" name="antivirus_version" value="' . $atvv . '" />';
                            ?>
                          </div>

                          <div class="form-group" id="dynamic-form2" style="display: <?php echo ($dvt_id == 2) ? 'block' : 'none'; ?>;">
                            <!-- Form section for Option PC -->
                            <div class="form-section" id="form-option2-2" style="display: <?php echo ($dvt_id == 2) ? 'block' : 'none'; ?>;">
                              <label class="placeholder">PC Name</label>
                              <?php
                              echo '<input type="text" class="form-control" name="pc_name" value="' . $sn . '"/>';
                              ?>
                            </div>
                          </div>

                          <label class="mt-3 mb-3"><b>Windows</b></label>
                          <div class="form-group">
                            <?php
                            echo '<label>Windows Name</label>';
                            echo '<select class="form-control" name="windows_name">';
                            echo '<option name="windows_name">Choose Windows</option>';
                            while ($row = mysqli_fetch_assoc($resultWinn)) {
                              $selected = ($row['windows_id'] == $winn_id) ? 'selected' : '';
                              echo '<option value="' . $row['windows_id'] . '"' . $selected . '>' . $row['windows_name'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                          </div>
                          <div class="form-group">
                            <?php
                            echo '<label>Windows Bit</label>';
                            echo '<select class="form-control" name="windows_bit">';
                            echo '<option name="windows_bit">Choose Windows Bit</option>';
                            while ($row = mysqli_fetch_assoc($resultWbit)) {
                              $selected = ($row['wbit_id'] == $winb_id) ? 'selected' : '';
                              echo '<option value="' . $row['wbit_id'] . '"' . $selected . '>' . $row['windows_bit'] . '</option>';
                            }
                            echo '</select>';
                            ?>
                          </div>

                          <div class="form-group" id="dynamic-form1" style="display: <?php echo ($status_id == 1 || $status_id == 3) ? 'block' : 'none'; ?>;">
                            <!-- Form section for Option Active -->
                            <div class="form-section" id="form-option1-1" style="display:<?php echo ($status_id == 1) ? 'block' : 'none'; ?>;">
                              <label>Upload BAST to email (optional):</label>
                              <input type="file" class="form-control-file" name="bast" accept="image/*, .pdf" />
                            </div>

                            <!-- Form section for Option Repair -->
                            <div class="form-section" id="form-option1-3" style="display: <?php echo ($status_id == 3) ? 'block' : 'none'; ?>;">
                              <label class="placeholder">Vendor Name</label>
                              <input type="text" class="form-control" name="vendor_name" value="<?php echo $vendor; ?>" />
                              <br>
                              <label>Start Date Fix :</label>
                              <input type="date" class="form-control" name="startDate" value="<?php echo $start; ?>" />
                              <label>End Date Fix :</label>
                              <input type="date" class="form-control" name="endDate" value="<?php echo $end; ?>" />
                              <br>
                              <label>Upload kwitansi Fix to email (optional):</label>
                              <input type="file" class="form-control" name="detailsFile" accept="image/*, .pdf" />
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                    <div class="card-action">
                      <input type="hidden" name="submit-edt">
                      <button type="submit" class="btn btn-success" name="update">Update Data</button>
                      <a href="./detail-user.php?id=<?php echo $id; ?>">
                        <button type="button" class="btn btn-danger" name="back">Back</button>
                      </a>
                    </div>
                  </div>
                </form>
            <?php
                          } else {
                            echo "Data tidak ditemukan";
                          }
                        }
            ?>
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
        <!-- Chat messages will be appended here -->
      </div>
      <div class="input-container">
        <input type="text" class="message-input" placeholder="Type your message...">
        <button class="send-button">Send</button>
      </div>
    </div>                   

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

    <script>
      const emailForm = document.querySelector(".email-check")
      const nikCheck = document.querySelector(".nik-check")
      const branch = document.querySelectorAll("#branch_id option")
      const selectBranch = document.querySelector("#branch_id")
      document.querySelector('button[name="update"]').addEventListener('click', function(e) {
        // Tampilkan SweetAlert dengan opsi konfirmasi
        e.preventDefault();
        Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin pindah ke halaman baru?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonText: 'Ya',
          cancelButtonText: 'Tidak'
        }).then((result) => {
          if (result.isConfirmed) {
            $("#submit-edit").submit(); // id form
          }
        });
      });
    </script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Include other scripts -->
    <script src="../../assets/js/core/popper.min.js"></script>
    <script src="../../assets/js/core/bootstrap.min.js"></script>
    <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../assets/js/atlantis.min.js"></script>

    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      let showChatData = false;
      const nameChatBox = document.querySelector(".name-chat-box")
      const socket = io("ws://localhost:3000/");
      const userLoggedIn = '<?php echo $_SESSION['auth_user']['username']; ?>';
      socket.emit("register", userLoggedIn);
      const userStatus = document.querySelectorAll(".user-status")
      const button = document.querySelector(".send-button")
      const message = document.querySelector('.message-input')
      const chatBodyEl = document.getElementById("chatBody");
      var divEl = document.createElement('div')
      const chatData = {};

      function startChat(user) {
        if (!chatData[user]) {
          chatData[user] = [];
        }
      }

      function appendMessage(user, type, message) {
        const divEl = document.createElement('div');
        divEl.className = type;
        divEl.textContent = message;
        chatData[user].push(divEl.cloneNode(true));
        renderChat(nameChatBox.textContent);
      }

      function renderChat(user) {
        const chatBodyEl = document.getElementById("chatBody");
        chatBodyEl.innerHTML = "";
        chatData[user].forEach((message) => {
          chatBodyEl.appendChild(message.cloneNode(true));
        });
      }

      button.addEventListener('click', async function (e) {
        const messageValue = message.value.trim();
        if (messageValue !== "") {
  
          divEl.className = 'user-message';
          const time = moment().format("h:mm A")
          // divEl.textContent = message.value + "(" + time + ")";
          divEl.textContent =message.value;
          const startIndex = nameChatBox.textContent.indexOf('[');
        const name = nameChatBox.textContent.substring(0, startIndex).trim();
          const data = await axios.post("http://localhost:3000/savechat", {
            message: message.value,
            receiver: name,
            sender: '<?=$_SESSION['auth_user']['username'] ?>'
          })
          socket.emit("sendmessage", { to: name, from: userLoggedIn, message: message.value });
          message.value = "";
          
          chatBodyEl.appendChild(divEl.cloneNode(true));
        }
      });

      socket.on("receivemessage", ({ from, message }) => {
        if(showChatData) {
          const datapesan = message
        divEl.className = 'message';
        divEl.textContent= datapesan
        chatBodyEl.appendChild(divEl.cloneNode(true));
        }
      });

      // Function to hide all form sections
      function hideFormSections(formNumber) {
        var formSections = document.querySelectorAll("#dynamic-form" + formNumber + " .form-section");
        formSections.forEach(function(section) {
          section.style.display = "none";
        });
      }

      // Function to toggle the dynamic form
      function toggleForm(formNumber) {
        var optionsDropdown = document.getElementById("options" + formNumber);
        var selectedOptionValue = optionsDropdown.value;
        var dynamicForm = document.getElementById("dynamic-form" + formNumber);

        // Hide all form sections
        hideFormSections(formNumber);

        // Show the selected form section based on the selected option
        var formSectionToShow = document.getElementById("form-option" + formNumber + "-" + selectedOptionValue);
        if (formSectionToShow) {
          formSectionToShow.style.display = "block";
          dynamicForm.style.display = "block";
        } else {
          dynamicForm.style.display = "none";
        }
      }

      // jQuery ready function
      $(document).ready(function() {
        // Autocomplete for staff_name field
        $("#staff_name").autocomplete({
          source: function(request, response) {
           
            $.ajax({
              url: "get_staff_names.php",
              type: "get",
              dataType: "json",
              data: {
                term: request.term
              },
              success: function(data) {
                response(data);
              },
              error: function() {
                alert("Error fetching staff names.");
              }
            });
          },
          select: function(event, ui) {
            const data = ui.item.value;
            
            $.post("get_staff_details.php", {
              staff_name: data,
            },function(data,status) { 
              const result = JSON.parse(data);
              emailForm.value = result.email;
              nikCheck.value = result.nik;
              console.log(result)
              selectBranch.options[result.branch_id].selected =true;
            })

          }
        });

        // Initial fetching of staff details on page load
        var urlParams = new URLSearchParams(window.location.search);
        var staffId = urlParams.get("staff_id");
        if (staffId) {
          // Code for populating form fields based on staff_id
        }
      });

      function confirmDelete() {
                return confirm("Apakah Anda yakin ingin menghapus data ini?");
                }

      async function showChat(name) {
      showChatData = true;
      const testElement = document.querySelector('.chat-container');
      testElement.classList.remove('test');
      socket.emit("checkonline", {receiver: name, sender: userLoggedIn} )

      socket.on('validateonline', ({message}) => {
        nameChatBox.textContent = name + " [" + message + "] ";
      })
      
      testElement.classList.add('show');
      const sender = '<?php echo $_SESSION['auth_user']['username'] ?>';
      const {data }= await axios.get(`http://localhost:3000/getchat?sender=${sender}&receiver=${name}`)
      const {result} = data; 
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

    function closeChat() {
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