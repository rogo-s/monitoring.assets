<?php 
include("../config.php");
session_start();
if(!$_SESSION["auth_user"]){
  header("Location: ../../../../../login.php");
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
$query = $db->query($sql);

//Memisahkan data berdasarkan status
$actStaff = [];
$repStaff = [];
$nonactStaff = [];

if ($query->num_rows > 0) {
  while ($row = $query->fetch_assoc()) {
    if ($row['status_device'] == 'Active') {
      $actStaff[] = $row;
    } else if ($row['status_device'] == 'Repair') {
      $repStaff[] = $row;
    } else if ($row['status_device'] == 'Non Active') {
      $nonactStaff[] = $row;
    } else {
      echo "Data tidak ditemukan";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Samudera - Data Tables</title>
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
    .user__chat-container {
        max-height: 400px;
        overflow-y: auto;
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

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<body>
  <div class="wrapper">
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
                    <a href="./admin/admin-profile.php">
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
                    <a href="../user/add-user.php">
                      <span class="sub-item">Add User</span>
                    </a>
                  </li>
                  <li>
                    <a href="../user/add-device.php">
                      <span class="sub-item">Add Device</span>
                    </a>
                  </li>
                  <li>
                    <a href="../user/add-device-non.php">
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
                    <a href="datatables.php">
                      <span class="sub-item">Datatables</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
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
                    <a href="../../../schedule/kalender.php">
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
        <div class="page-inner">
          <div class="page-header">
            <h4 class="page-title">Data Tables</h4>
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
                <a href="#">Tables</a>
              </li>
              <li class="separator">
                <i class="flaticon-right-arrow"></i>
              </li>
              <li class="nav-item">
                <a href="#">Datatables</a>
              </li>
            </ul>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Active User</h4>
                  <form id="search-form-staff">
                    <div class="input-group mb-1 mt-3">
                      <input type="text" class="form-control" placeholder="Cari berdasarkan NIK, Nama, Email, dll..." name="keyword" id="search-keyword-staff">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>NIK</th>
                          <th>Staff Name</th>
                          <th>Gender</th>
                          <th>Email</th>
                          <th>Branch Code</th>
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
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          foreach ($actStaff as $row) :
                            echo "<tr>";

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

                            echo "</tr>";
                          endforeach;
                          ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Repair Assets</h4>
                  <form id="search-form-repair">
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" placeholder="Cari berdasarkan NIK, Nama, Email, dll..." name="keyword" id="search-keyword-repair">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>NIK</th>
                          <th>Staff Name</th>
                          <th>Gender</th>
                          <th>Email</th>
                          <th>Branch Code</th>
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
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          foreach ($repStaff as $row) :
                            echo "<tr>";

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

                            echo "</tr>";
                          endforeach;
                          ?>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Non-Active User</h4>
                  <form id="search-form-non-staff">
                    <div class="input-group mb-1">
                      <input type="text" class="form-control" placeholder="Cari berdasarkan NIK, Nama, Email, dll..." name="keyword" id="search-keyword-non-staff">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="basic-datatables add-non" class="display table table-striped table-hover">
                      <thead>
                        <tr>
                          <th></th>
                          <th>NIK</th>
                          <th>Staff Name</th>
                          <th>Gender</th>
                          <th>Email</th>
                          <th>Branch Code</th>
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
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          foreach ($nonactStaff as $row) :
                            echo "<tr>";

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

                            echo "</tr>";
                          endforeach;
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

  <!--   Core JS Files   -->
  <script src="../../assets/js/core/jquery.3.2.1.min.js"></script>
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <!-- jQuery UI -->
  <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
  <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Datatables -->
  <script src="../../assets/js/plugin/datatables/datatables.min.js"></script>
  <!-- Atlantis JS -->
  <script src="../../assets/js/atlantis.min.js"></script>
  <!-- Atlantis DEMO methods, don't include it in your project! -->
  <script src="../../assets/js/setting-demo2.js"></script>

  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

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

    $(document).ready(function() {
      $("#basic-datatables").DataTable();
    });

    $(document).ready(function() {
      // Fungsi pencarian untuk tabel staf
      $("#search-form-staff").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-staff").val().toLowerCase();
        $("#basic-datatables tbody tr").each(function() {
          const rowData = $(this).text().toLowerCase();
          if (rowData.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
      $("#search-form-repair").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-repair").val().toLowerCase();
        $("#basic-datatables tbody tr").each(function() {
          const rowData = $(this).text().toLowerCase();
          if (rowData.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
      $("#search-form-non-staff").on("submit", function(event) {
        event.preventDefault();
        const keyword = $("#search-keyword-non-staff").val().toLowerCase();
        $("#basic-datatables tbody tr").each(function() {
          const rowData = $(this).text().toLowerCase();
          if (rowData.includes(keyword)) {
            $(this).show();
          } else {
            $(this).hide();
          }
        });
      });
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