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
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/card.css" rel="stylesheet">
</head>

<body style="background-color:#eee">
    <div>
        <?php include ('navbar.php'); ?>
    </div>

    <div class="container-fluid" id="courses">
        <div class="row courses-banner">
            <div class="container-fluid ">
                <h2 class="display-6"> Hi, {{ user.username }}! What do you want to learn today? </h2>
                <p class="fs-5"> Invest in yourself and take the first step in achieving your dreams. </p>
            </div>

        </div>

        <div class="px-5">
            <div>
                <div class="m-5">
                    <p class="font2" style="margin-bottom:50px">My courses</p>
                    <div class="row">
                        <course v-for="c in enrolled_courses" v-if="enrolled_courses" :course_id="c.course.course_id" :title="c.course.course_title" :description="c.course.course_description" :playlist_url="c.course.playlist_url"></course>
                    </div> 
                    <!-- <div class="row" style="margin-bottom:200px">
                        <course v-for="c in enrolled_courses" :completed="c.completed" :enrolled="true" :course_id="c.course_id" :title="c.course ? c.course.course_title : ''" :description="c.course ? c.course.course_description : ''" :playlist_url="c.course.playlist_url ? c.course.playlist_url : ''"></course>
                    </div>  -->
                    <br>
                    <p class="font2" style="margin-bottom:50px"> All courses</p>
                    <div class="row">
                        <!-- filters enrolled courses -->
                        <course v-for="c in courses" :course_id="c.course_id" :title="c.course_title" :description="c.course_description" :playlist_url="c ? c.playlist_url : ''" :completed="enrolled_courses.filter(e => e.course_id === c.course_id ).length > 0"></course>
                    </div>       
                </div>
            </div>   
        </div>
    </div>

    <script>
        let apiKey = "AIzaSyAtAJBow77Rx2Bhm3tRGKCYvQSbDCjnpe0";
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
                    let course_url = `https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=${this.playlist_url}&key=${apiKey}`;

                    axios.get(course_url)
                    .then(r => {
                        // this.img = r.data.items[0].snippet.thumbnails.standard.url;
                        this.img= "../images/" + this.title.split(" ")[0].toLowerCase() + "-thumbnail.png"
                    })
                    .catch(e => {
                        console.log(e.response.data);
                    })
                },
            },
            created() {
                this.getCourse();
                // console.log(this.completed);
            },
            template: 
            `   
            <div v-if="!completed" class="col-lg-4 col-md-6 my-2 d-flex align-items-stretch">
                <a :href="'course.php?course_id=' + course_id + '&video_id=0'" class="canvas">
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
            // <div v-if="completed == false" class="col-lg-4 col-md-6 my-2 d-flex align-items-stretch">
            //         <div class="card card-custom bg-white border-white border-0 shadow-lg">
            //             <img :src="img">
            //             <div class="card-body" style="overflow-y: auto">
            //                 <h4 class="card-title">{{ title }}</h4>
            //                 <p class="card-subtitle mb-2 text-muted">6 hrs 42 mins</p>
            //             </div>
            //             <div class="card-footer" style="background: inherit; border-color: inherit;">
            //                 <a v-if="completed == false" v-bind:href="'course.php?course_id=' + this.course_id +'&video_id=0'" class="btn btn-dark">{{ enrolled ? "Continue" : "View Course" }}</a>
            //                 <p v-else >Completed!</p>
            //             </div>
            //         </div>
            //     </div>
        })

        let vm = courses.mount('#courses');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>

</body>
</html>