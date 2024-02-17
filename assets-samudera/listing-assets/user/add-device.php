<?php 
session_start();
include("../config.php");
if(!$_SESSION["auth_user"]) {
  header("Location: ../../../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Samudera - Add Device</title>
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
    .user__chat-container {
        max-height: 400px;
        overflow-y: auto;
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
                        <h4 class="page-title">Staff</h4>
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
                                <a href="./detail-user.php">Add Device</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <form id="submit-chuck" action="proses-add.php" method="POST" enctype="multipart/form-data">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Form Add</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Staff Name</label>
                                                    <input type="text" class="form-control" name="staff_name" id="staff_name" placeholder="Staff Name" />
                                                    <input type="hidden" id="staff_id" name="staff_id">
                                                </div>
                                                <div class="form-group">
                                                    <label>Status Device</label>
                                                    <select class="form-control" name="status_device" id="options1" onchange="toggleForm(1)()" required>';
                                                        <option name="status_device">Choose Status Device</option>';
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($resultStatus)) {
                                                            echo '<option value="' . $row['status_id'] . '">' . $row['status_device'] . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Device Type</label>
                                                    <select class="form-control" name="device_type" id="options2" onchange="toggleForm(2)()" required>
                                                        <option name="device_type">Choose Device Type</option>
                                                        <?php
                                                        while ($row = mysqli_fetch_assoc($resultDevt)) {
                                                            echo '<option value="' . $row['dvt_id'] . '">' . $row['dvt_name'] . '</option>';
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
                                                        echo '<option value="' . $row['brand_id'] . '">' . $row['brand_name'] . '</option>';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label for="type-laptop">Type Laptop</label>';
                                                    echo '<input type="text" class="form-control" name="laptop_type" placeholder="Type Laptop">';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label for="serial-number">Serial Number</label>';
                                                    echo '<input type="text" class="form-control" name="serial_number" placeholder="Serial Number"/>';
                                                    ?>
                                                </div>
                                                <div class=" form-group">
                                                    <?php
                                                    echo '<label>Domain</label>';
                                                    echo '<select class="form-control" name="domain" required>';
                                                    echo '<option name="domain">Choose Domain</option>';
                                                    while ($row = mysqli_fetch_assoc($resultDomain)) {
                                                        echo '<option value="' . $row['domain_id'] . '">' . $row['domain_name'] . '</option>';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                                <label class="mb-3"><b>Antivirus</b></label>
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label>Antivirus Name</label>';
                                                    echo '<select class="form-control" name="antivirus_name" required>';
                                                    echo '<option name="antivirus_name">Choose Antivirus</option>';
                                                    while ($row = mysqli_fetch_assoc($resultAtv)) {
                                                        echo '<option value="' . $row['antivirus_id'] . '">' . $row['antivirus_name'] . '</option>';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label class="placeholder">Antivirus Version</label>';
                                                    echo '<input type="text" class="form-control" name="antivirus_version" required/>';
                                                    ?>
                                                </div>
                                                <div class="form-group" id="dynamic-form2" style="display: none;">
                                                    <!-- Form section for Option PC -->
                                                    <div class="form-section" id="form-option2-2" style="display: none;">
                                                        <label class="placeholder">PC Name</label>
                                                        <input type="text" class="form-control" name="pc_name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-4">
                                                <label class="mt-3 mb-3"><b>Windows</b></label>
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label>Windows Name</label>';
                                                    echo '<select class="form-control" name="windows_name" required>';
                                                    echo '<option name="windows_name">Choose Windows</option>';
                                                    while ($row = mysqli_fetch_assoc($resultWinn)) {
                                                        echo '<option value="' . $row['windows_id'] . '">' . $row['windows_name'] . '</option>';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php
                                                    echo '<label>Windows Bit</label>';
                                                    echo '<select class="form-control" name="windows_bit" required>';
                                                    echo '<option name="windows_bit">Choose Windows Bit</option>';
                                                    while ($row = mysqli_fetch_assoc($resultWbit)) {
                                                        echo '<option value="' . $row['wbit_id'] . '">' . $row['windows_bit'] . '</option>';
                                                    }
                                                    echo '</select>';
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <input type="hidden" name="submit-adc">
                                        <button type="submit" class="btn btn-success" name="add_device" value="add_device">Add Device</button>
                                        <a href="../index.php" class="btn btn-danger">Back</a>
                                    </div>
                                </div>
                            </form>
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


            <!-- End Custom template -->
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
            document.querySelector('button[name="add_device"]').addEventListener('click', function(e) {
                // Tampilkan SweetAlert
                e.preventDefault();
                Swal.fire({
                    title: 'Good job!',
                    text: 'You clicked the button!',
                    icon: 'success'
                }).then(() => {
                    $("#submit-chuck").submit();
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

            function hideFormSections(formNumber) {
                var formSections = document.querySelectorAll("#dynamic-form" + formNumber + " .form-section");
                formSections.forEach(function(section) {
                    section.style.display = "none";
                });
            }

            $(document).ready(function() {
                var staffDropdown = $("#staff_dropdown");

                $("#staff_name").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "staff_names.php",
                            type: "get",
                            dataType: "json",
                            data: {
                                term: request.term
                            },
                            success: function(data) {
                                if (data.length > 0) {
                                    var dropdownHtml = "<ul>";
                                    data.forEach(function(item) {
                                        dropdownHtml += "<li data-id='" + item.id + "'>" + item.label + "</li>";
                                    });
                                    dropdownHtml += "</ul>";
                                    staffDropdown.html(dropdownHtml);
                                    staffDropdown.show();
                                } else {
                                    staffDropdown.hide();
                                }
                                response(data);
                            },
                            error: function() {
                                alert("Error fetching staff names.");
                            }
                        });
                    },
                    select: function(event, ui) {
                        $("#staff_id").val(ui.item.id); // Set staff_id value
                        $(this).val(ui.item.label);
                        staffDropdown.hide();
                    }
                });

                staffDropdown.on("click", "li", function() {
                    var staffId = $(this).data("id");
                    var staffName = $(this).text();
                    $("#staff_id").val(staffId);
                    $("#staff_name").val(staffName);
                    staffDropdown.hide();
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