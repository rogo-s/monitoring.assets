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