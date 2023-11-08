<?php
    session_start();
    // No session variable "user" => no login
    if ( !isset($_SESSION["user_id"]) ) {
         // redirect to login page
         header("Location: ../index.php"); 
         exit;
    }
?>
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
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link href="../css/card.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>

    <div id="homepage">
        <div class="container-fluid" style="padding: 0px;">
            <div id="achievements" class="row homepage-header">
                <div class="body col-md-7 col-sm-6">
                    <p class="font2 animate__animated animate__fadeInDown " style="margin-bottom:30px;margin-left:40px;margin-top:20px;">Welcome back, {{ user.username }}!</p>
                        <div class="row py-3">
                            <div class="profile col-lg-4" style="justify-content:center; text-align:center; padding-left:50px;">
                                <img :src="'../images/profile' + getRank() + '.jpg'" alt="Profile Picture" class="rounded-circle" style="width: 200px; height: 200px;">
                            </div>
                            <div class="col-lg-6" style="text-align:center; justify-content:center; padding-left:80px;">
                                <div class="category">
                                    <!-- <img src="../images/ranking.png" alt="Rank Icon" style="width: 100px;"> -->
                                    <div class="col-md-6 category-text" style="justify-content:center">
                                        <span class="number">#{{ getRank() }}</span>
                                        <br>
                                        Ranking

                                    </div>
                                    <div class="col-md-6 category-text" style="justify-content:center">
                                        <span class="number">{{ completed }}</span>
                                        <br>
                                        Courses completed
                                    </div>
                                </div>

                                <div class="category">
                                    <!-- <img src="../images/course.png" alt="Courses Icon" style="width: 100px;"> -->
                                    <div class="col-md-6 category-text">
                                        <span class="number">{{ user.points }}</span>
                                        <br>
                                        Points
                                    </div>

                                    <!-- <img src="../images/badges.png" alt="Badges Icon" style="width: 100px;"> -->
                                    <div class="col-md-6 category-text" style="justify-content:center">
                                        <span class="number">{{ user_badges.length }}</span>
                                        <br>
                                        Badges obtained
                                    </div>
                                </div>

                                
                            </div>

                        </div>
                </div>

                <div id="reminder" class="col-md-5 col-sm-6 main">
                    <!-- Reminder Alert Box -->
                    <div class="container-fluid">
                        <div class="reminders">
                        <p class="font2" style="padding-left:30px">Quests</p>
                            <ul class="reminder-list display-7">
                                <li v-for="(t, index) in tasks" class="reminder-item row">
                                        <div class="d-inline mx-1 col-lg-8">{{ t.task_name }} 
                                            <span style="color:grey">
                                                Earn {{ t.task_points }} points
                                            </span>
                                        </div>
                                        <!-- show button if user completed -->
                                        <div class="col-lg-4">
                                            
                                            <button v-if="user_tasks[index][0] == 1" :disabled="user_tasks[index][1] == 1" class="btn btn-light" @click="claimTask(t.task_points, index)">
                                                <img src="../images/money-bag.png" width="30"alt="">
                                                Claim
                                            </button>
                                        </div>

                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>

        <div class="container-fluid" style="background-color:#eee; padding: 50px;">
            <div id="lessons" class="row">
                <div class="lessons col-md-8" >
                    <div class="row">
                        <div class="col-md-8">
                            <span class="font2">Lessons</span>
                        </div>
                        <div class="col-lg-4 text-end" style="padding-top:15px">
                            <a href="courses.php" style="color:black; text-decoration:none">
                                <img src="../images/plus-sign.png" width="30"> Add more courses
                            </a>
                        </div>
                    </div>
                    <div id="" class="row lesson">
                        <div class="col-md-8" style="margin-left:50px">
                            <lessons></lessons>
                        </div>
                        
                    </div>
                </div>
                
                <leaderboard :users="users"></leaderboard>  
                
                
            </div>
        </div>
    </div>
    

    <script>
        let apiKey = "AIzaSyAtAJBow77Rx2Bhm3tRGKCYvQSbDCjnpe0";
        let homepage = Vue.createApp({
            data() {
                return {
                    user: '',
                    user_rank: '',
                    user_badges: {}, // get user badges
                    users: [],
                    enrolled: '',
                    completed: 0,
                    tasks: [],
                    user_tasks: [],
                }
            },
            created() {
                this.getUser();
                this.getUsers();
            },
            methods: {
                claimTask(points, index){
                    console.log(points)
                    let url = "../../server/api/tasks.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                        points: points,
                    }

                    axios.post(url, params)
                    .then(r => {
                        console.log(r.data);
                        this.user = r.data;
                        this.user_tasks[index][1] = 1;

                        this.updateUserTasks();
                    })
                },
                updateUserTasks() {
                    // console.log(points)
                    let url = "../../server/api/users.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                        tasks: this.user_tasks,
                    }

                    axios.post(url, params)
                    .then(r => {
                        console.log(r.data);
                        // this.user = r.data;
                    })
                },
                getTasks(){
                    let url = "../../server/api/tasks.php";
                    let params = {
                        
                    }

                    axios.get(url)
                    .then(r => {
                        this.tasks = r.data;
                    })
                },
                getUser(){
                    let url = "../../server/api/users.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.user = r.data;
                        this.user_badges = JSON.parse(r.data.badges);
                        this.user_tasks = JSON.parse(r.data.tasks);
                        this.getTasks();
                    })
                },
                getUsers(){
                    let url = "../../server/api/users.php";

                    axios.get(url)
                    .then(r => {
                        this.users = r.data;
                        // sort highest - lowest
                        this.users = r.data.sort(function(a, b){return b.points-a.points});

                        this.getEnrolledCourses();
                    })
                },
                getRank() {
                        // this.user_rank = this.users.indexOf(this.user)
                        return this.users.map(e => e.user_id).indexOf(this.user.user_id) + 1 ;
                },
                getEnrolledCourses() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.enrolled = r.data;
                        this.completed = r.data.filter(e => e.completed == 1 ).length;
                    })
                },
            }
        })

        homepage.component('leaderboard', {
            data() {
                return {

                }
            },
            props: ["users"],
            created() {
                
            },
            methods: {
                userCheck(user_id) {
                    if (user_id == <?php echo $_SESSION['user_id'] ?>) {
                        return true
                    } else {
                        return false
                    }
                },
                getRank(index) {
                    return index +1;
                },
            },
            template: `

            <div id="leaderboard" class="col-md-4 main ">
                <div class="row mb-2">
                    <div class="col-md-8 col-sm-6 leaderboard-header">
                        <span class="font2 px-1">Leaderboard</span>
                        
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6 text-end">
                        <a href="leaderboard.php">
                            <img src="../images/podium.png" alt="" width="50"/>
                        </a>
                    </div>
                </div>           

                <div v-for="(u, index) in users.slice(0, 5)">
                    <div class="card" style="width: auto;" :style="{ 'background' : userCheck(u.user_id) ? '#E69CF2': ''}">
                        <div class="card-body d-flex align-items-center">
                            <!-- Profile Picture (Left) -->
                            <img :src="'../images/profile' + getRank(index) + '.jpg'" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                        
                            <!-- User Information (Middle) -->
                            <div>
                                <h5 class="card-title"> <span class="text-muted"> #{{ index+1 }}</span> {{ u.username }}</h5>
                                
                            </div>
                        
                            <!-- Points Accumulated (Right) -->
                            <div class="ms-auto">
                                <h3 class="card-subtitle points">{{ u.points }}</h3>
                            </div>
                        </div>
                    </div>   
                </div>           
            </div>

            `
        })

        homepage.component('lessons', {
            data() {
                return {
                    courses: [],
                    enrolled_courses: [],
                    badges: '',
                }
            },
            methods: {
                showCourses() {
                    
                    let url = "../../server/api/courses.php";

                    axios.get(url)
                    .then(r => {
                        this.courses = r.data;
                        //   console.log(r.data);
                        for(c in r.data) {
                            // console.log(r.data[c])
                            // console.log(this.checkUserEnrolled(r.data[c]));
                        }
                    })
                },
                getEnrolledCourses() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        // if (r.data != null) {
                        //     this.enrolled = true;
                        //     this.enrolled_content = JSON.parse(r.data.content);
                        //     this.updateEnrolledContent();
                        //     console.log(r.data)
                        // }
                        this.enrolled_courses = r.data;
                        for (c in r.data) {
                            this.getCourse(r.data[c].course_id, c);
                        }
                    })
                },
                getCourse(course_id, index) {
                    let url = "../../server/api/courses.php";
                    let params = {
                        course_id: course_id,
                    }

                    axios.get(url, { params: params })
                    .then(r => {
                        this.enrolled_courses[index].course = r.data;
                        // this.enrolled_courses[index].playlist_url = r.data.playlist_url;
                    })
                    .catch(e => {
                        console.log(e);
                    })
                }
            },
            created() {
                this.showCourses();
                this.getEnrolledCourses();
            },
            template: `

            <div class="row">
                <p v-if="enrolled_courses == ''" style="font-weight:400">Nothing here! Click <a style="color:#9932CC" href='courses.php'>here</a> to enroll into courses.</p>
                <course v-for="c in enrolled_courses" :completed="c.completed" :enrolled="true" :course_id="c.course_id" :title="c.course ? c.course.course_title : ''" :description="c.course ? c.course.course_description : ''" :playlist_url="c.course.playlist_url"></course>
            </div> 
            `
        })

        homepage.component('course', {
            data() {
                return {
                    img: '',
                }
            },
            props: ['course_id', 'playlist_url', 'title', 'description', 'enrolled', 'completed'],
            methods: {
                getCourse() {
                    let course_url = `https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=${this.playlist_url}&key=${apiKey}`;

                    axios.get(course_url)
                    .then(r => {
                        this.img= "../images/" + this.title.split(" ")[0].toLowerCase() + "-thumbnail.png"
                    })
                },
            },
            created() {
                this.getCourse();
            },
            template: 
            `   
                <div v-if="completed == false" class="col-lg-6 my-2 d-flex align-items-stretch">
                    <a v-bind:href="'course.php?course_id=' + this.course_id +'&video_id=0'" class="canvas">
                        <div class="canvas_border">
                            <svg>
                                <defs><linearGradient id="grad-orange" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" style="stop-color:rgb(136, 68, 253);stop-opacity:1"></stop><stop offset="100%" style="stop-color:rgb(23, 105, 153);stop-opacity:1"></stop></linearGradient><linearGradient id="grad-red" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#D34F48"></stop><stop offset="100%" stop-color="#772522"></stop></linearGradient></defs>
                                <rect id="rect-grad" class="rect-gradient" fill="none" stroke="url(#grad-orange)" stroke-linecap="square" stroke-width="4" stroke-miterlimit="30" width="100%" height="100%"></rect>
                            </svg>
                        </div>
                        <div class="canvas_img-wrapper">
                            <img class="canvas_img" :src="img">
                        </div>
                        <div class="canvas_copy canvas_copy--left">
                            <strong class="canvas_copy_title">{{ title }}</strong>

                        </div>
                    </a>
                </div>
            `
        })

        const vm = homepage.mount("#homepage");
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>