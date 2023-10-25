<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div>
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
                            <a class="nav-link" href="#" style="font-size: 28px;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Leaderboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" style="font-size: 28px;">Profile</a>
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
        
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-8">
                <div class="p-4">
                    <div class="container-fluid py-5">
                     <h2 class="display-6 fw-bold"> Hi, Michael! What do you want to learn today? </h2>
                     <p class="fs-4 text-muted"> Invest in yourself and take the first step in <br>achieving your dreams </p>
                   </div>
                </div>
                <hr>
                <div class="px-5">
                    <h2>All courses</h2>
                    <div class="row">
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> Intro to Python </h4>
                                  <p class="card-text"> Explore the basics of Python programming in this introductory course, gaining essential skills for basic coding and problem-solving. </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Continue</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> Web Application Essentials </h4>
                                  <p class="card-text"> Master the core technologies of web development — HTML, CSS, and JavaScript. Build a strong foundation for creating dynamic and interactive websites. </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Continue</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> JavaScript for Front-End Development</h4>
                                  <p class="card-text"> Elevate your front-end development skills with JavaScript. Explore its powerful features to create dynamic and responsive user interfaces for modern web applications. </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Enroll</a>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> Course 1</h4>
                                  <p class="card-text"> Course description </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Enroll</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> Course 2</h4>
                                  <p class="card-text"> Course description </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Enroll</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card card-custom bg-white border-white border-0">
                                <div class="card-custom-img" style="background-image: url(../images/course1.jpg)"></div>
                                <div class="card-custom-avatar">
                                  <img class="img-fluid" src="http://res.cloudinary.com/d3/image/upload/c_pad,g_center,h_200,q_auto:eco,w_200/bootstrap-logo_u3c8dx.jpg" alt="Avatar" />
                                </div>
                                <div class="card-body" style="overflow-y: auto">
                                  <h4 class="card-title"> Course 3</h4>
                                  <p class="card-text"> Course description </p>
                                </div>
                                <div class="card-footer" style="background: inherit; border-color: inherit;">
                                  <a href="#" class="btn btn-dark">Enroll</a>
                                </div>
                                
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="col-4">
                <div class="p-5 mb-4 rounded-3">
                    <div class="container-fluid py-5">
                    <p class="fs-4 fw-bold text-start"> Your schedule </p>
                    <hr>
                     <p class="fs-4 fw-bold text-start"> September 2023 </p>
                     <div class="calendar">
                        <div class="day">Mon<br>1</div>
                        <div class="day">Tue<br>2</div>
                        <div class="day">Wed<br>3</div>
                        <div class="day highlight">Thu<br>4</div>
                        <div class="day">Fri<br>5</div>
                        <div class="day">Sat<br>6</div>
                        <div class="day">Sun<br>7</div>
                    </div>
                   </div>

                   <div class="module">
                    <p class="fs-5 fw-bold text-start"> <img src="../images/python.png" width="30px">   Intro to Python </p>    
                    <p>Due today: Module 2 </p>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: 60%;"></div>
                    </div>
                    <p class="module-progress-percent">
                        Module progress: 60%
                    </p>
                   </div>
                   <br>

                   <div class="module">
                    <p class="fs-5 fw-bold text-start"> <img src="../images/webcourse.png" width="30px">  Web Application Essentials </p>    
                    <p>Due Sunday: Module 1 </p>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: 10%;"></div>
                    </div>
                    <p class="module-progress-percent">
                        Module progress: 10%
                    </p>
                   </div>

                </div>

            </div>
        </div>

    </div>



</body>