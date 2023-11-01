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
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>

    <div class="container-fluid" id="courses">
        <div class="row">
            <div class="">
                <div class="p-4">
                    <div class="container-fluid py-5">
                        <h2 class="display-6 fw-bold"> Hi, {{ user.username }}! What do you want to learn today? </h2>
                        <p class="fs-4 text-muted"> Invest in yourself and take the first step in <br>achieving your dreams </p>
                    </div>
                </div>
                <hr>
                <div class="px-5">
                  <div>
                    <div class="m-5">
                        <h3>My courses</h3>
                        <!-- <div class="row">
                            <course v-for="c in enrolled_courses" v-if="enrolled_courses" :course_id="c.course.course_id" :title="c.course.course_title" :description="c.course.course_description" :playlist_url="c.course.playlist_url"></course>
                        </div>  -->
                        <div class="row">
                            <course v-for="c in enrolled_courses.sort(function(a, b){return a.completed - b.completed})" :completed="c.completed" :enrolled="true" :course_id="c.course_id" :title="c.course ? c.course.course_title : ''" :description="c.course ? c.course.course_description : ''" :playlist_url="c.course.playlist_url"></course>
                        </div> 
                        <hr>
                        <h3>All courses</h3>
                        <div class="row">
                            <!-- filters enrolled courses -->
                            <course v-for="c in courses" :course_id="c.course_id" :title="c.course_title" :description="c.course_description" :playlist_url="c.playlist_url" :completed="enrolled_courses.filter(e => e.course_id === c.course_id ).length > 0"></course>
                        </div>       
                    </div>
                  </div>
                    
                </div>
            </div>
            <!-- <div class="col-4">
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

            </div> -->
        </div>

    </div>

    <script>
        // 1. display courses

        const courses = Vue.createApp({
            data() {
                return {
                    courses: [],
                    enrolled_courses: [],
                    badges: '',
                    user: '',
                }
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
                        // this.user_badges = JSON.parse(r.data.badges);
                    })
                },
                showCourses() {
                    
                    let url = "../../server/api/courses.php";

                    axios.get(url)
                    .then(r => {
                        this.courses = r.data;
                        //   console.log(r.data);
                    })
                },
                getEnrolledCourses() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
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
                this.getUser();
                this.showCourses();
                this.getEnrolledCourses();
            }
        })

        // show course component
        courses.component('course', {
            data() {
                return {
                    img: '',
                }
            },
            props: ['course_id', 'playlist_url', 'title', 'description', 'enrolled', 'completed'],
            methods: {
                getCourse() {
                    let course_url = `https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=${this.playlist_url}&key=AIzaSyArqgpdPWq6_ZTQgdzn9r1dIxpYoysqOlY`;

                    axios.get(course_url)
                    .then(r => {
                        this.img = r.data.items[0].snippet.thumbnails.standard.url;
                    })
                    .catch(e => {
                        console.log(e.response.data);
                    })
                },
            },
            created() {
                this.getCourse();
                console.log(this.completed);
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

        let vm = courses.mount('#courses');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>

</body>
</html>