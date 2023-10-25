<?php
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-black">
    <div class="container-fluid">
        <!-- Left Logo -->
        <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
            <img src="../images/logo.jpg" alt="Logo" style="width: 150px;">
        </a>

        <!-- Navbar Toggler Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php" style="font-size: 28px;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="courses.php" style="font-size: 28px;">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="job.php" style="font-size: 28px;">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="leaderboard.php" style="font-size: 28px;">Leaderboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php" style="font-size: 28px;">Profile</a>
                </li>
            </ul>
        </div>

        <!-- Right Logo (Duplicated) -->
        <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
            <img src="../images/filler.jpg" alt="Logo" style="width: 150px;">
        </a>
    </div>
    <div id="indicator"></div>
    </nav>
'
?>

