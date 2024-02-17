<?php
session_start();
include "../assets-samudera/listing-assets/config.php";
if(!$_SESSION["auth_user"]) {
    header("Location: ../login.php");
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
    <title>Samudera - User Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets-samudera/assets/img/logo_samudera.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style-bg.css">

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

            <!-- chat bot -->
            <?php include('../includes/navbar-user.php');?>
            
            <!-- sidebar -->
            <?php include('../includes/sidebar.php');?>

            <!-- isi kontent calender di bawah sini -->
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
                divEl.textContent = message.value ;
                const startIndex = nameChatBox.textContent.indexOf('[');
                const name = nameChatBox.textContent.substring(0, startIndex).trim();
                const data = await axios.post("http://localhost:3000/savechat", {
                message: message.value,
                receiver: name,
                sender: '<?=$_SESSION['auth_user']['username'] ?>'
                })
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