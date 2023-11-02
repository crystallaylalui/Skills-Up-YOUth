<?php
echo '
<style>
    #navbar {
        display: flex;
        justify-content: space-between;
        position: relative;
        padding-bottom: 5px; 
    }

    .nav-link {
        text-decoration: none;
        color: black; 
        margin: 0 10px;
        position: relative;
    }

    .nav-link:hover{
        color:#c03afe;
    }
</style>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light" style="background: white; color: black;">
    <div class="container-fluid">
        <!-- Left Logo -->
        <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
            <img src="../images/skills-up-logo.png" alt="Logo" style="width: 150px;">
        </a>

        <!-- Navbar Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php" style="font-size: 20px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php" style="font-size: 20px;">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="job.php" style="font-size: 20px;">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="leaderboard.php" style="font-size: 20px;">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php" style="font-size: 20px;">Profile</a>
                </li>
            </ul>
        </div>


        <button class="btn btn-light" v-on:click="logoutUser">Logout</button>
    </div>
    <div id="indicator"></div>
    </nav>

    <!-- navbar -->
    <script>
        // nav bar
        const navbar = Vue.createApp({
            methods: {
                logoutUser() {
                    axios.post("../../server/api/logout.php")
                    .then(r => {
                        alert("Logout successfully");
                        window.location.href = "../index.php";
                    })
                }
            }
        })
        const logout = navbar.mount("#navbar");
    </script>
'
?>

