<?php 
session_start();
include "../assets-samudera/listing-assets/config.php";
if(!$_SESSION["auth_user"]) {
    header("Location: ../login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Samudera - User Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets-samudera/assets/img/logo_samudera.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .user__chat-container {
        max-height: 400px;
        overflow-y: auto;
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
  </style>


    <!-- Fonts and icons -->
    <script src="../assets-samudera/assets/js/plugin/webfont/webfont.min.js"></script>
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
                urls: ["../assets-samudera/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets-samudera/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets-samudera/assets/css/atlantis.min.css" />
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <a href="../dashboard.php" class="logo">
                    <img src="../assets-samudera/assets/img/white.png" width="200px" height="40px" alt="navbar brand" class="navbar-brand" />
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
            <?php include('../includes/navbar-user.php');?>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                <div class="user">
                    <div class="avatar-sm float-left mr-2">
                    <img src="../assets-samudera/assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
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
                            <a href="../user-akses/profile.php">
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
                            <a href="../dashboard.php">
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
                            <a href="graph-user.php">
                            <span class="sub-item">Graph User</span>
                            </a>
                        </li>
                        <li>
                            <a href="graph-device.php">
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
                            <a href="datables.php">
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
                            <a href="../schedule/kalender-user.php">
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
                                <h2 class="text-white pb-2 fw-bold">Dashboard Listing Staff</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                        <div class="card-title">Assets Device</div>
                        </div>
                        <div class="card-body">
                        <div class="chart-container">
                            <canvas id="pieChart" style="width: 50%; height: 50%"></canvas>
                        </div>
                        </div>
                    </div>
                    </div>
                
                    <?php
                    // Ganti query untuk chart staff
                    $branch = $_SESSION['auth_user']['branch'];
                    $stafQuery = "SELECT staf.staf_name, COUNT(*) as count FROM device_assets_computer dac 
                    LEFT JOIN tbl_staf staf ON dac.nik = staf.nik
                    LEFT JOIN tbl_branch branch ON branch.branch_id = dac.branch_id WHERE branch.branch_name = '$branch' GROUP BY staf.staf_name";
                    $queryStaf = $db->query($stafQuery);

                    // Inisialisasi array yang akan menyimpan hasil perhitungan
                    $stafCount = array();

                    // Mengisi array dengan hasil perhitungan dari database
                    while ($row = $queryStaf->fetch_assoc()) {
                    $stafName = $row['staf_name'];
                    $count = (int)$row['count'];
                    $stafCount[$stafName] = $count;
                    }

                    // Mengonversi array menjadi format JSON
                    $dataStaf = json_encode($stafCount);    
                    ?>

                    <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-body">
                        <div class="card-title">Branch</div>
                        </div>
                        <div class="card-body">
                        <div class="chart-container">
                        <canvas id="barChartBranch" style="width: 50%; height: 50%"></canvas>
                        </div>
                        </div>
                    </div>
                    </div>

                    <?php
                    // Ganti query untuk chart branch
                  
                    $branchQuery = "SELECT branch.branch_name, COUNT(*) as count FROM device_assets_computer dac 
                    LEFT JOIN tbl_branch branch ON dac.branch_id = branch.branch_id GROUP BY branch.branch_name";
                    $queryBranch = $db->query($branchQuery);

                    // Inisialisasi array yang akan menyimpan hasil perhitungan
                    $branchCount = array();

                    // Mengisi array dengan hasil perhitungan dari database
                    while ($row = $queryBranch->fetch_assoc()) {
                    $branchName = $row['branch_name'];
                    $count = (int)$row['count'];
                    $branchCount[$branchName] = $count;
                    }

                    // Mengonversi array menjadi format JSON
                    $dataBranch = json_encode($branchCount);
                    ?>
                </div>

                    <!-- Tambahkan kode PHP untuk menghitung jumlah total data -->
                    <?php
                    $sqlTotalData = "SELECT COUNT(*) AS total FROM tbl_staf";
                    $queryTotalData = $db->query($sqlTotalData);
                    $rowTotalData = mysqli_fetch_assoc($queryTotalData);
                    $totalData = $rowTotalData['total'];
                    ?>

                    <!-- Tambahkan kode PHP dan JavaScript untuk paginasi -->
                    <style>
                        /* Tambahkan CSS untuk navigasi paginasi */
                        .pagination {
                            display: flex;
                            justify-content: center;
                            margin-top: 10px;
                        }

                        .pagination a {
                            padding: 5px 10px;
                            margin: 0 2px;
                            border: 1px solid #ccc;
                            text-decoration: none;
                            color: #333;
                            border-radius: 3px;
                        }

                        .pagination a.active {
                            background-color: #007bff;
                            color: #fff;
                        }
                    </style>

                    <!-- Tempatkan script ini di bawah kode JavaScript sebelumnya -->
                    <script>
                        function showSlide(slide) {
                            var rows = document.querySelectorAll(".table tbody tr");
                            var start = (slide - 1) * <?php echo $perPage; ?>;
                            var end = Math.min(start + <?php echo $perPage; ?>, rows.length);
                            for (var i = 0; i < rows.length; i++) {
                                if (i >= start && i < end) {
                                    rows[i].style.display = "table-row";
                                } else {
                                    rows[i].style.display = "none";
                                }
                            }
                            loadPage(slide);
                        }
                    </script>

                    <!-- Tampilan tabel dan paginasi -->
                    <div class="row row-card-no-pd">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Staff</div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <form id="search-form-staff-just">
                                                <div class="input-group mb-1">
                                                    <input type="text" class="form-control" placeholder="Cari berdasarkan NIK, Nama, Email, dll..." name="keyword" id="search-keyword-staff-just">
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
                                        <table id="add-row-staff-just" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>NIK</th>
                                                    <th>Full Name</th>
                                                    <th>Gender</th>
                                                    <th>Email</th>
                                                    <th>Branch Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- PHP untuk mengambil data dari database -->
                                                <?php
                                                $perPage = 5;
                                                $branch = $_SESSION['auth_user']['branch'];
                                                $totalPages = ceil($totalData / $perPage);

                                                if (isset($_GET['page'])) {
                                                    $currentPage = $_GET['page'];
                                                } else {
                                                    $currentPage = 1;
                                                }

                                                $start = ($currentPage - 1) * $perPage;
                                                $sqlStaff = "SELECT 
                        stf.staff_id, stf.nik, stf.staf_name, stf.gender, stf.email,
                        brc.branch_id, brc.branch_name
                        FROM tbl_staf stf
                        LEFT JOIN tbl_branch brc ON stf.branch_id = brc.branch_id where brc.branch_name = '$branch'
                        LIMIT $start, $perPage";
                                                $queryStaff = $db->query($sqlStaff);

                                                while ($row = mysqli_fetch_array($queryStaff)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['staff_id'] . "</td>";
                                                    echo "<td>" . $row['nik'] . "</td>";
                                                    echo "<td>" . $row['staf_name'] . "</td>";
                                                    echo "<td>" . $row['gender'] . "</td>";
                                                    echo "<td>" . $row['email'] . "</td>";
                                                    echo "<td>" . $row['branch_name'] . "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Navigasi paginasi -->
                                <div class="pagination">
                                    <?php
                                    for ($i = 1; $i <= $totalPages; $i++) {
                                        echo "<a href=\"?page=$i\" class=\"" . ($currentPage == $i ? "active" : "") . "\" onclick=\"showSlide($i)\">$i</a>";
                                    }
                                    ?>
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
                    <!-- <div class="message">Hello!</div>
                    <div class="user-message">Hi there!</div> -->
                    <!-- More messages can be added here -->
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
            <script src="../assets-samudera/assets/js/core/popper.min.js"></script>
            <script src="../assets-samudera/assets/js/core/bootstrap.min.js"></script>

            <!-- Include jQuery UI and related plugins -->
            <script src="../assets-samudera/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
            <script src="../assets-samudera/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

            <!-- Include jQuery Scrollbar -->
            <script src="../assets-samudera/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

            <!-- Include Chart Pie from CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Include Atlantis JS -->
            <script src="../assets-samudera/assets/js/atlantis.min.js"></script>
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
                
                var chartStaf = <?php echo $dataStaf; ?>;
                var chartBranch = <?php echo $dataBranch; ?>;

                // Membuat skema warna yang bervariasi
                var colorSchemeStaf = generateColorScheme(Object.keys(chartStaf).length);
                var colorSchemeBranch = generateColorScheme(Object.keys(chartBranch).length);

                // Membuat chart pie menggunakan Chart.js untuk staff
                var pieChart = document.getElementById('pieChart').getContext('2d');
                var myPieChart = new Chart(pieChart, {
                    type: 'pie',
                    data: {
                        labels: Object.keys(chartStaf),
                        datasets: [{
                            data: Object.values(chartStaf),
                            backgroundColor: colorSchemeStaf,
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

                // Membuat chart bar menggunakan Chart.js untuk branch
                var barChartBranch = document.getElementById('barChartBranch').getContext('2d');
                var myBarChartBranch = new Chart(barChartBranch, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(chartBranch),
                        datasets: [{
                            label: 'Branches',
                            data: Object.values(chartBranch),
                            backgroundColor: colorSchemeBranch,
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
                        scales: {
                            x: {
                                stacked: true,
                            },
                            y: {
                                stacked: true,
                            },
                        },
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.yLabel;
                                }
                            }
                        },
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

                // Fungsi untuk menghasilkan skema warna yang bervariasi
                function generateColorScheme(count) {
                    var colors = [];
                    for (var i = 0; i < count; i++) {
                        colors.push(getRandomColor());
                    }
                    return colors;
                }

                // Fungsi untuk mendapatkan warna acak
                function getRandomColor() {
                    var letters = '0123456789ABCDEF';
                    var color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }

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