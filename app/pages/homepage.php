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
                    <p class="display-5 animate__animated animate__fadeInDown " style="margin-bottom:30px;margin-left:40px;margin-top:20px;">Welcome back, {{ user.username }}!</p>
                        <div class="row py-3">
                            <div class="profile col-lg-4 text-center">
                                <img src="../images/profile8.jpg" alt="Profile Picture" class="rounded-circle" style="width: 200px; height: 200px;">
                            </div>
                            <div class="col-6 row">
                                <div class="col-6 category">
                                    <!-- <img src="../images/ranking.png" alt="Rank Icon" style="width: 100px;"> -->
                                    <div class="category-text">
                                        <span class="number">#{{ getRank() }}</span>
                                        <br>
                                        Ranking
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 category">
                                <!-- <img src="../images/course.png" alt="Courses Icon" style="width: 100px;"> -->
                                <div class="category-text">
                                    <span class="number">{{ enrolled.filter(e => e.completed == 1 ).length }}</span>
                                    <br>
                                    Courses completed
                                </div>
                                <div class="col-6 category">
                                    <!-- <img src="../images/course.png" alt="Courses Icon" style="width: 100px;"> -->
                                    <div class="category-text">
                                        <span class="number">{{ enrolled.length }}</span>
                                        <br>
                                        Courses completed
                                    </div>
                                </div>
                                <div class="col-6 category">
                                    <!-- <img src="../images/badges.png" alt="Badges Icon" style="width: 100px;"> -->
                                    <div class="category-text">
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
                        <p class="display-6" style="padding-left:30px">Reminders</p>
                        <ul class="reminder-list display-7">
                            <li class="reminder-item">
                                Complete the Python course! 
                            </li>
                            <li class="reminder-item">
                                New lessons available in Web Development.
                            </li>
                        </ul>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>

        <div class="container-fluid" style="padding: 50px;">
            <div id="lessons" class="row">
                <div class="lessons col-md-8" >
                    <div class="row">
                        <p class="display-6">Lessons</p>
                    </div>
                    <div id="" class="row lesson">
                        <div>
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
                }
            },
            created() {
                this.getUser();
                this.getUsers();
            },
            methods: {
                getUser(){
                    let url = "../../server/api/users.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.user = r.data;
                        this.user_badges = JSON.parse(r.data.badges);
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
                getRank(index) {
                    return index +1;
                },

            },
            template: `

            <div id="leaderboard" class="col-md-4 main">
                <div class="row">
                    <div class="col-md-8">
                        <p class="display-6">Leaderboard</p>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" class="btn btn-outline-dark">View All</button>
                    </div>
                </div>           

                <div v-for="(u, index) in users">
                    <div class="card" style="width: auto;">
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
                <p v-if="enrolled_courses == ''">Nothing here! Click <a href='courses.php'>here</a> to enroll into courses.</p>
                <course v-for="c in enrolled_courses" :completed="c.completed" :enrolled="true" :course_id="c.course_id" :title="c.course ? c.course.course_title : ''" :description="c.course ? c.course.course_description : ''" :playlist_url="c.course.playlist_url ? c.course.playlist_url : ''"></course>
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
                        this.img = r.data.items[0].snippet.thumbnails.standard.url;
                    })
                },
            },
            created() {
                this.getCourse();
            },
            template: 
            `
                <div v-if="completed == false" class="col-4 my-2 d-flex align-items-stretch">
                    <div class="card card-custom bg-white border-white border-0 shadow-lg">
                        <img :src="img">
                        <div class="card-body" style="overflow-y: auto">
                            <h4 class="card-title">{{ title }}</h4>
                            <p class="card-subtitle mb-2 text-muted">6 hrs 42 mins</p>
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                            <a v-if="completed == false" v-bind:href="'course.php?course_id=' + this.course_id +'&video_id=0'" class="btn btn-dark">{{ enrolled ? "Continue" : "View Course" }}</a>
                            <p v-else >Completed!</p>
                        </div>
                    </div>
                </div>
            `
        })

        const vm = homepage.mount("#homepage");
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
    </html>