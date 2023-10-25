<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>

    <div class="container-fluid" style="padding: 0px;">
        <div id="achievements" class="row">
            <div class="body col-8" style="padding-right: 0px;">
                <div class="row">
                    <h1>Achievements</h1>
                </div>
                <div class="row">
                    <div class="profile col-4">
                        <img src="../images/profile8.jpg" alt="Profile Picture" class="rounded-circle" style="width: 100px; height: 100px; margin-right: 10px;">
                        <h2>beginner</h2>
                    </div>
                    <div class="col-6 row">
                        <div class="col-6 category">
                            <img src="../images/ranking.png" alt="Rank Icon" style="width: 100px;">
                            <div class="category-text">
                                <span class="number">#159</span>
                                <br>
                                Ranking
                            </div>
                        </div>
                        <div class="col-6 category">
                            <img src="../images/days.png" alt="Days Icon" style="width: 100px;">
                            <div class="category-text">
                                <span class="number">122</span>
                                <br>
                                Days
                            </div>
                        </div>
                        <div class="col-6 category">
                            <img src="../images/course.png" alt="Courses Icon" style="width: 100px;">
                            <div class="category-text">
                                <span class="number">7</span>
                                <br>
                                Courses
                            </div>
                        </div>
                        <div class="col-6 category">
                            <img src="../images/badges.png" alt="Badges Icon" style="width: 100px;">
                            <div class="category-text">
                                <span class="number">7</span>
                                <br>
                                Badges
                            </div>
                        </div>
                    </div>
                    <div class="stats">
                        
                    </div>
                </div>
            </div>

            <div id="reminder" class="col-4 main">
                <h1>Reminders</h1>
                
                <!-- Reminder Alert Box -->
                <div class="reminder-alert">
                    <p style="font-size: 30px;">Your daily tasks are waiting! <span class="reminder-count">3</span></p>
                    <ul class="reminder-list">
                        <li class="reminder-item">
                            Don't forget to complete the Python course! <span class="reminder-count">1</span>
                        </li>
                        <li class="reminder-item">
                            New lessons available in Web Development. <span class="reminder-count">2</span>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>

    <div class="container-fluid" style="padding: 0px;">
        <div id="lessons" class="row">
            <div class="main col-8" >
                <div class="row">
                    <h1 class="col-8">Lessons</h1>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-dark next">More</button>
                    </div>
                </div>
                <div class="row lesson">
                    <div class="col-6">
                        <!-- <h3>course 1</h3> -->
                        <div class="card" style="width: auto;">
                            <div class="card-body">
                              <h5 class="card-title">JavaScript for Front-End Development</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Duration: 23 hours</h6>
                              <p class="card-text">Elevate your front-end development skills with JavaScript. Explore its powerful features to create dynamic and responsive user interfaces for modern web applications.</p>
                              <a href="#" class="card-link">Learn More</a>
                              <a href="#" class="card-link">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- <h3>course 2</h3> -->
                        <div class="card" style="width: auto;">
                            <div class="card-body">
                              <h5 class="card-title">Intro to Python</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Duration: 19 hours</h6>
                              <p class="card-text">Explore the basics of Python programming in this introductory course, gaining essential skills for basic coding and problem-solving.</p>
                              <a href="#" class="card-link">Learn More</a>
                              <a href="#" class="card-link">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row lesson">
                    <div class="col-6">
                        <!-- <h3>course 3</h3> -->
                        <div class="card" style="width: auto;">
                            <div class="card-body">
                              <h5 class="card-title">Web Development Essentials</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Duration: 85 hours</h6>
                              <p class="card-text">Master the core technologies of web development — HTML, CSS, and JavaScript. Build a strong foundation for creating dynamic and interactive websites.</p>
                              <a href="#" class="card-link">Learn More</a>
                              <a href="#" class="card-link">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <!-- <h3>course 4</h3> -->
                        <div class="card" style="width: auto;">
                            <div class="card-body">
                              <h5 class="card-title">Database Design with MySQL</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Duration: 15 hours</h6>
                              <p class="card-text">Delve into the world of databases with this MySQL course. Learn to design, implement, and manage robust databases for efficient data storage and retrieval.</p>
                              <a href="#" class="card-link">Learn More</a>
                              <a href="#" class="card-link">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="leaderboard" class="col-4 main">
                <div class="row">
                    <h1 class="col-md-8">Leaderboard</h1>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline-dark next">View All</button>
                    </div>
                </div>                
                <div class="card bg-warning" style="width: auto;">
                    <div class="card-body d-flex align-items-center">
                        <!-- Profile Picture (Left) -->
                        <img src="../images/profile1.jpg" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                    
                        <!-- User Information (Middle) -->
                        <div>
                            <h5 class="card-title">#1</h5>
                            <h6 class="card-subtitle text-muted">Kenny Lim</h6>
                        </div>
                    
                        <!-- Points Accumulated (Right) -->
                        <div class="ms-auto">
                            <h4 class="card-subtitle text-muted">3498</h4>
                        </div>
                    </div>
                </div>   
                <div class="card custom-silver" style="width: auto;">
                    <div class="card-body d-flex align-items-center">
                        <!-- Profile Picture (Left) -->
                        <img src="../images/profile2.jpg" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                    
                        <!-- User Information (Middle) -->
                        <div>
                            <h5 class="card-title">#2</h5>
                            <h6 class="card-subtitle text-muted">Jeanna Tam</h6>
                        </div>
                    
                        <!-- Points Accumulated (Right) -->
                        <div class="ms-auto">
                            <h4 class="card-subtitle text-muted">3145</h4>
                        </div>
                    </div>
                </div>   
                <div class="card custom-bronze" style="width: auto;">
                    <div class="card-body d-flex align-items-center">
                        <!-- Profile Picture (Left) -->
                        <img src="../images/profile3.jpg" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                    
                        <!-- User Information (Middle) -->
                        <div>
                            <h5 class="card-title">#3</h5>
                            <h6 class="card-subtitle text-muted">Tan Wan Feng</h6>
                        </div>
                    
                        <!-- Points Accumulated (Right) -->
                        <div class="ms-auto">
                            <h4 class="card-subtitle text-muted">3011</h4>
                        </div>
                    </div>
                </div>   
                <div class="card" style="width: auto;">
                    <div class="card-body d-flex align-items-center">
                        <!-- Profile Picture (Left) -->
                        <img src="../images/profile4.jpg" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                    
                        <!-- User Information (Middle) -->
                        <div>
                            <h5 class="card-title">#4</h5>
                            <h6 class="card-subtitle text-muted">Melody Soh</h6>
                        </div>
                    
                        <!-- Points Accumulated (Right) -->
                        <div class="ms-auto">
                            <h4 class="card-subtitle text-muted">2889</h4>
                        </div>
                    </div>
                </div>   
                <div class="card" style="width: auto;">
                    <div class="card-body d-flex align-items-center">
                        <!-- Profile Picture (Left) -->
                        <img src="../images/profile5.jpg" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                    
                        <!-- User Information (Middle) -->
                        <div>
                            <h5 class="card-title">#5</h5>
                            <h6 class="card-subtitle text-muted">Jacky Chua</h6>
                        </div>
                    
                        <!-- Points Accumulated (Right) -->
                        <div class="ms-auto">
                            <h4 class="card-subtitle text-muted">2671</h4>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>

    <script>
        Vue.createApp({
            methods: {
                logOut() {
                    axios.post("../../server/api/logout.php")
                    .then(r => {
                        alert("Logout successfully");
                        window.location.href = "../index.php";
                    })
                }
            }
        }).mount('body');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>