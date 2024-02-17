<?php 
session_start();
include "config.php";
if(!$_SESSION["auth_user"]) {
    header("Location: ../../login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Samudera - Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/logo_samudera.ico" type="image/x-icon" />
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
        .user__chat-container {
        max-height: 400px;
        overflow-y: auto;
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
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <a href="index.php" class="logo">
                    <img src="../assets/img/white.png" width="200px" height="40px" alt="navbar brand" class="navbar-brand" />
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
            <?php include('../../includes/navbar-admin.php');?>
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
                        <h4> <?=$_SESSION['auth_user']['username'];?></h4>
                        <span class="user-level">Admin IT</span>
                        <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                        <li>
                            <a href="../../user-akses/profile.php">
                            <span class="link-collapse">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="../../destroy-session.php">
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
                            <a href="./index.php">
                            <span class="sub-item">Listing Assets</span>
                            </a>
                        </li>
                        <li>
                            <a href="./listing-staff.php">
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
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Add List</p>
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
                    <li class="nav-item">
                    <a data-toggle="collapse" href="#calender">
                        <i class="fas fa-table"></i>
                        <p>Calender</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="calender">
                        <ul class="nav nav-collapse">
                        <li>
                            <a href="../../schedule/kalender.php">
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
                    <!-- Tempatkan di bagian <head> untuk menyertakan jQuery -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        LEFT JOIN tbl_branch brc ON stf.branch_id = brc.branch_id
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
            <!-- Include jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

            <!-- Include core scripts -->
            <script src="../assets/js/core/popper.min.js"></script>
            <script src="../assets/js/core/bootstrap.min.js"></script>

            <!-- Include jQuery UI and related plugins -->
            <script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
            <script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

            <!-- Include jQuery Scrollbar -->
            <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

            <!-- Include Atlantis JS -->
            <script src="../assets/js/atlantis.min.js"></script>

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