<?php
$row = mysqli_fetch_assoc($resultStaff);
?>
<!-- Navbar Header -->
        <!-- chat bot user  -->
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
            <div class="d-flex ">
            <ul class="navbar-nav topbar-nav align-items-center p-2">
                <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
                </li>
            <!-- coloum chat -->
            <div class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                        <img src="../../assets-samudera/assets/img/chat-icon.png" alt="..." class="avatar-img rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user custom-dropdown animated fadeIn user__chat-container">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <h1>&nbsp;&nbsp;Message</h1>
                        </li>
                        <li class="search-container">
                            <input type="text" id="search-input" class="search-input-text" placeholder="Search users...">
                        </li>
                    </div>
                </ul>
            </div>
            <!-- end coloum chat -->

            <!-- Add the chat container -->
            </ul>
            <!-- user profile -->
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item toggle-nav-search hidden-caret">
                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                    <i class="fa fa-search"></i>
                </a>
                </li>
                <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                    <img src="../../assets-samudera/assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                        <div class="user-box">
                        <div class="avatar-lg">
                            <img src="../../assets-samudera/assets/img/profile.png" alt="image profile" class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                        <h4> <?=$_SESSION['auth_user']['username'];?></h4>
                            <p class="text-muted"><?=$_SESSION['auth_user']['email'];?></p>
                            <a  class="btn btn-xs btn-secondary btn-sm"><?=$row['nik']?></a>
                        </div>
                        </div>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../user-akses/profile.php">My Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../destroy-session.php">Logout</a>
                    </li>
                    </div>
                </ul>
                </li>
            </ul>
            </div>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        const ulContainer = document.querySelector('.user__chat-container')
        const inputSearchUser = document.querySelector(".search-input-text")
        const div = document.createElement('div')
        inputSearchUser.addEventListener("input" , async function() { 
        const response = await fetch(`http://localhost:3000/users?name=${inputSearchUser.value}&role=user`)
        const {data} =  await response.json();
        const dataSession = '<?php echo $_SESSION['auth_user']['username'] ?>'
        const previousLiElements = ulContainer.querySelectorAll(".live-chat-container");
        previousLiElements.forEach(element => element.remove());

        data.map(async (user) => {
            const li = document.createElement("li")
            li.classList.add("live-chat-container");

            li.addEventListener("click", function () {
                console.log(user.name)
                showChat(user.name); 
            });

            const userDiv = document.createElement('div');
            userDiv.classList.add('user-profile');

            const avatarDiv = document.createElement('div');
            avatarDiv.classList.add('avatar-sm');

            const avatarImg = document.createElement('img');
            avatarImg.src = `../assets/img/profile2.jpg`; 
            avatarImg.classList.add('avatar-img', 'rounded-circle');

            avatarDiv.appendChild(avatarImg);

            const userInfoDiv = document.createElement('div');
            userInfoDiv.classList.add('user-info');

            const userNameDiv = document.createElement('div');
            userNameDiv.classList.add('user-name');
            userNameDiv.textContent = user.name;

            console.log()
             const resp = await axios.post("http://localhost:3000/lastchat", { 
                receiver: user.name,
                sender: dataSession,

            })
            console.log(resp.data)
    
            const userStatusDiv = document.createElement('div');
            userStatusDiv.classList.add('user-status');
            if(resp.data.data.length  >= 1) { 
                  userStatusDiv.textContent = resp.data.data[0]['chat'];
            }

            userInfoDiv.appendChild(userNameDiv);
            userInfoDiv.appendChild(userStatusDiv);

            userDiv.appendChild(avatarDiv);
            userDiv.appendChild(userInfoDiv);
           
            const lastMessageDiv = document.createElement('div');
            lastMessageDiv.classList.add('last-message');

            li.appendChild(userDiv);
            li.appendChild(lastMessageDiv);
            ulContainer.appendChild(li);
        })
        })
    </script>