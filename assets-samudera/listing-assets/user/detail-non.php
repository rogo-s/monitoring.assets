<?php
// Pastikan file config.php sudah di-include untuk koneksi ke database
include '../config.php';

session_start();
// Cek apakah parameter ID ada dalam querystring
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
        <title>Samudera - Add User</title>
        <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
        <link rel="icon" href="../../assets/img/logo_samudera.ico" type="image/x-icon" />
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

        <!-- CSS Files -->
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/atlantis.min.css" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="../../assets/css/demo.css" />
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
                                            <a href="../overlay-sidebar.php">
                                                <span class="sub-item">Overlay Sidebar</span>
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
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="page-header">
                            <h4 class="page-title"></h4>
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
                                    <a href="./detail-user.php">Add Staff</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Form Edit</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <?php
                                                $query = "SELECT 
                                                    dn.nonDev_id, dn.serial_number, dn.ip, dn.loc, 
                                                    sts.status_id, dvt.dvt_id, br.brand_id,
                                                    rp.startDate, rp.endDate, rp.vendor_name
                                                    FROM tbl_non_device dn
                                                    LEFT JOIN tbl_status sts ON dn.status_id = sts.status_id 
                                                    LEFT JOIN tbl_dvt dvt ON dn.dvt_id = dvt.dvt_id
                                                    LEFT JOIN tbl_brand br ON dn.brand_id = br.brand_id
                                                    LEFT JOIN tbl_repair rp ON dn.serial_number = rp.serial_number
                                                    WHERE nonDev_id = $id";
                                                $result = mysqli_query($db, $query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $status_id = isset($row['status_id']) ? $row['status_id'] : null;
                                                    $dvt_id = isset($row['dvt_id']) ? $row['dvt_id'] : null;
                                                    $brand_id = isset($row['brand_id']) ? $row['brand_id'] : null;
                                                    $sn = isset($row['serial_number']) ? $row['serial_number'] : null;
                                                    $ip = isset($row['ip']) ? $row['ip'] : null;
                                                    $loc = isset($row['loc']) ? $row['loc'] : null;
                                                    $start = isset($row['startDate']) ? $row['startDate'] : null;
                                                    $end = isset($row['endDate']) ? $row['endDate'] : null;
                                                    $sign = isset($row['sign2']) ? $row['sign2'] : null;
                                                    $vendor = isset($row['vendor_name']) ? $row['vendor_name'] : null;

                                                    echo '<input type="hidden" name="id" value="' . $id . '">';
                                                ?>

                                                    <div class="form-group">
                                                        <label>Status Device</label>
                                                        <select class="form-control" name="status_device" id="options" onchange="toggleForm()" disabled>
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
                                                        <?php
                                                        echo '<label>Device Type</label>';
                                                        echo '<select class="form-control" name="device_type" disabled>';
                                                        echo '<option name="device_type">Choose Device Type</option>';
                                                        while ($row = mysqli_fetch_assoc($resultDevt)) {
                                                            $selected = ($row['dvt_id'] == $dvt_id) ? 'selected' : '';
                                                            echo '<option value="' . $row['dvt_id'] . '"' . $selected . '>' . $row['dvt_name'] . '</option>';
                                                        }
                                                        echo '</select>';
                                                        ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <?php
                                                        echo '<label>Brand</label>';
                                                        echo '<select class="form-control" name="brand" disabled>';
                                                        echo '<option name="brand">Choose Brand</option>';
                                                        while ($row = mysqli_fetch_assoc($resultBr)) {
                                                            $selected = ($row['brand_id'] == $brand_id) ? 'selected' : '';
                                                            echo '<option value="' . $row['brand_id'] . '"' . $selected . '>' . $row['brand_name'] . '</option>';
                                                        }
                                                        echo '</select>';
                                                        ?>
                                                    </div>
                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="serialNumber">Serial Number</label>
                                                    <input type="text" class="form-control" name="serial_number" placeholder="Serial Number" value="<?php echo $sn; ?>" disabled />
                                                </div>

                                                <div class="form-group">
                                                    <label for="internetProtocol">Internet Protocol</label>
                                                    <input type="text" class="form-control" name="internet_protocol" placeholder="Internet Protocol" value="<?php echo $ip; ?>" disabled />
                                                </div>

                                            </div>

                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label for="location">Location</label>
                                                    <input type="text" class="form-control" name="location" placeholder="Location" value="<?php echo $loc; ?>" disabled />
                                                </div>

                                                <div class="form-group" id="dynamic-form" style="display: <?php echo ($status_id == 3) ? 'block' : 'none'; ?>;">
                                                    <!-- Form section for Option Repair -->
                                                    <div id="form-option3" style="display: <?php echo ($status_id == 3) ? 'block' : 'none'; ?>;">
                                                        <label>Vendor Name:</label>
                                                        <input type="text" class="form-control" name="vendor_name" value="<?php echo $vendor; ?>" disabled />
                                                        <br>
                                                        <label>Start Date Fix :</label>
                                                        <input type="date" class="form-control" name="startDate" value="<?php echo $start; ?>" disabled />
                                                        <label>End Date Fix :</label>
                                                        <input type="date" class="form-control" name="endDate" value="<?php echo $end; ?>" disabled />
                                                        <br>
                                                        <label>Upload Detail Fix to Email (optional):</label>
                                                        <input type="file" class="form-control" name="detailsFile" accept="image/*, .pdf" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <?php echo '<button class="btn btn-success" onclick="window.location.href=\'../user/edit-non.php?id=' . $id . '\'">';
                                                    echo 'Edit Device';
                                                    echo '</button>'; ?>
                                        <a href="../index.php"><button class="btn btn-danger">Back</button>
                                    </div>
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

            <div class="chat-container test">
            <div class="chat-header">
                <p>Chat Box</p>
                <button class="btn-close" onclick="closeChat()"><i class="fa fa-close"></i></button>
                </div>
                    <div class="chat-body" id="chatBody">
                    <div class="message">Hello!</div>
                    <div class="user-message">Hi there!</div>
                    <!-- More messages can be added here -->
                    </div>
                    <div class="input-container">
                        <input type="text" class="message-input" placeholder="Type your message...">
                        <button class="send-button" onclick="sendMessage()">Send</button>
                    </div>
                </div>

            <!--   Core JS Files   -->
            <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
            <script src="../../assets/js/core/popper.min.js"></script>
            <script src="../../assets/js/core/bootstrap.min.js"></script>
            <!-- jQuery UI -->
            <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
            <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

            <!-- jQuery Scrollbar -->
            <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
            <!-- Atlantis JS -->
            <script src="../../assets/js/atlantis.min.js"></script>
            <!-- Atlantis DEMO methods, don't include it in your project! -->
            <script src="../../assets/js/setting-demo2.js"></script>
            <script>
                function toggleForm() {
                    var optionsDropdown = document.getElementById("options");
                    var selectedOptionValue = optionsDropdown.value;
                    var dynamicForm = document.getElementById("dynamic-form");

                    // Hide all form sections
                    hideFormSections();

                    // Show the selected form section based on the selected option
                    var formSectionToShow = document.getElementById("form-option" + selectedOptionValue);
                    if (formSectionToShow) {
                        formSectionToShow.style.display = "block";
                        dynamicForm.style.display = "block";
                    } else {
                        dynamicForm.style.display = "none";
                    }
                }

                function hideFormSections() {
                    var formSections = document.querySelectorAll("[id^='form-option']");
                    formSections.forEach(function(section) {
                        section.style.display = "none";
                    });
                }
                function confirmDelete() {
                return confirm("Apakah Anda yakin ingin menghapus data ini?");
                }

                function showChat() {
                const testElement = document.querySelector('.chat-container');
                testElement.classList.remove('test');
                testElement.classList.add('show');
            }

            function closeChat(){
                const btnClose = document.querySelector(".chat-container");
                btnClose.classList.remove('show');
                btnClose.classList.add('test');
            }

                function sendMessage() {
                    // Add logic to send message
                    var messageInput = document.getElementById('message-input');
                    var messageText = messageInput.value;

                    // Add logic to display the sent message in the chat container
                    var chatMessagesContainer = document.getElementById('chat-messages');
                    var newMessage = document.createElement('div');
                    newMessage.textContent = 'You: ' + messageText;
                    chatMessagesContainer.appendChild(newMessage);

                    // Clear the message input after sending
                    messageInput.value = '';
                }
            </script>
    </body>

    </html>