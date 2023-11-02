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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>

<body>
    <div>
        <?php include('navbar.php'); ?>
    </div>

    <div id="course" class="container">
        <div v-if="!enrolled" class="card text-center my-5">
            <div class="card-header">
                <button @click="enrollUser" class="btn btn-dark">Enroll now!</button>
                <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#course_details" aria-current="true" data-bs-toggle="tab">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#course_contents" data-bs-toggle="tab" >Content</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#course_badges" data-bs-toggle="tab" >Badges</a>
                    </li>
                </ul>
            </div>
            <div class="card-body tab-content">
                <div class="tab-pane active" id="course_details">
                    <!-- check for playlist to avoid warning -->
                    <img :src="playlist.items?playlist.items[0].snippet.thumbnails.standard.url:''" class="m-2 img-fluid">
                    <h5 class="card-title">{{ course.course_title }}</h5>
                    <p class="card-text">Duration: 5 hr 14 mins</p>
                    <p class="card-text">{{ course.course_description }}</p>
                </div>
                <div class="tab-pane" id="course_contents">
                    <div>
                        <ul class="list-group text-start">
                            <li v-for="(v, index) in playlist.items" class="list-group-item py-3">{{ index+1 }}. {{ v.snippet.title }}</li>
                        </ul>
                        
                    </div>
                </div>
                <div class="tab-pane" id="course_badges">
                    <p class=" card-text">Badges</p>
                    <img width="100" v-for="b in course_badges.sort(function(a, b){return a.badge_id - b.badge_id})" :src="'../images/badges/' + b.badge_img">
                    <!-- <div v-for="b in course.course_badges">{{ this.getBadge(b) }}</div> -->
                </div>
            </div>
        </div>
        <div v-else="enrolled" class="row">
            <div class="col-md-9 my-5">
                <h1>{{ parseInt(video_id) + 1 }}. {{ playlist?playlist.items[video_id].snippet.title:'' }}</h1>
                <br>
                <div class="ratio ratio-16x9">
                    <iframe :src="video_url" title="YouTube video" allowfullscreen></iframe>
                </div>
                <div v-if="quizCompleted" class="my-5 d-grid">
                    <button class="btn btn-dark" @click="showCourseCompleteOption()">Complete Course!</button>
                </div>
                <div class="my-5 card p-3 rounded-2">
                    <h1> {{ course.course_title }}</h1>
                    <h4>Course Description</h4>
                    <p>{{ course.course_description }}</p>
                </div>

                <h2>Quizzes</h2>
                <div class="list-group">
                    <div class="list-group-item quiz-item">
                        <h5>Final Quiz</h5>
                        <p v-if="contentNotCompleted" style="font-size: small; color: red;">Complete course content to unlock</p>
                        <p style="font-size: small;">10 questions</p>
                        <button class="btn btn-dark" @click="openQuiz()" :disabled="contentNotCompleted">Take quiz</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 pt-5">
                <h4>
                    Course Content
                </h4>
                <div class="list-group">
                    <!-- Course content -->
                    <div v-for="(v, index) in playlist.items">
                        <a :href="'course.php?course_id=' + course.course_id + '&video_id=' + index"
                            class="list-group-item list-group-item-action content-item">
                            <course-content :index="index" :video_id="v.snippet.resourceId.videoId"
                                :title="v.snippet.title" :enrolled_content="enrolled_content" @update="updateEnrolledContent"><course-content>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let apiKey = "AIzaSyAtAJBow77Rx2Bhm3tRGKCYvQSbDCjnpe0";
        let urlParams = new URLSearchParams(window.location.search);

        function YTDurationToHMS(duration) {
            var match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/);

            match = match.slice(1).map(function (x) {
                if (x != null) {
                    return x.replace(/\D/, '');
                }
            });

            var hours = (parseInt(match[0]) || 0);
            var minutes = (parseInt(match[1]) || 0);
            var seconds = (parseInt(match[2]) || 0);

            let h_text = hours > 0 ? `${hours} hr ` : ''
            let m_text = minutes > 0 ? `${minutes} mins ` : ''
            let s_text = seconds > 0 ? `${seconds} s` : ''

            // return hours * 3600 + minutes * 60 + seconds;
            return `${h_text}${m_text}${s_text}`;
        }

        function YTDurationToSeconds(duration) {
            var match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/);

            match = match.slice(1).map(function (x) {
                if (x != null) {
                    return x.replace(/\D/, '');
                }
            });

            var hours = (parseInt(match[0]) || 0);
            var minutes = (parseInt(match[1]) || 0);
            var seconds = (parseInt(match[2]) || 0);

            return hours * 3600 + minutes * 60 + seconds;
        }

        const course = Vue.createApp({
            data() {
                return {
                    course: '', // get course from db
                    course_badges: [],
                    playlist: '', // save playlist json
                    playlist_url: '', // get yt playlist from api
                    video_id: urlParams.get('video_id'), // get video_id from url query
                    video_url: '', // get yt video from api using video_id
                    total_duration: '',
                    enrolled: false,
                    enrolled_content: '',
                    contentNotCompleted: false,
                    quiz_completed: false,
                    user_badges: []
                }
            },
            computed: {
                quizCompleted() {
                    this.showCourseCompleteOption();
                    return this.quiz_completed;
                }
            },
            methods: {
                getUser() {
                    let url = "../../server/api/users.php";
                    let params = {
                        user_id : <?php echo $_SESSION["user_id"] ?>, // GET SESSION USER ID
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        // this.user = r.data;
                        // this.user_id = r.data.user_id;

                        // get user badges
                        this.user_badges = JSON.parse(r.data.badges);
                        console.log(r.data.badges)
                    });
                },
                openQuiz() {

                    // check if quiz ended
                    let quiz = window.open('quiz.php?course_id=' + urlParams.get('course_id'), '_blank', 'popup=yes');
                    let interval = setInterval( 
                        () => {
                            if (document.hasFocus()) {
                                console.log("focus");
                                if (quiz.closed) {
                                    clearInterval(interval);
                                    this.checkUserEnrolled();
                                }
                            } else {
                                console.log("not focus")
                            }
                        } , 1000);
                },
                checkCourseProgress() {
                    let check = this.enrolled_content.content.indexOf(0) == -1; // if all completed

                    this.contentNotCompleted = !check;
                },
                checkQuizProgress() {
                    let check = this.enrolled_content.quiz[0] == 1 // if all completed

                    this.quiz_completed = check;

                    console.log(check);
                },
                courseComplete() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        update: true,
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                        course_id: urlParams.get('course_id'),
                        content: JSON.stringify(this.enrolled_content),
                        completed: true, // set to true
                    };

                    axios.post(url, params)
                    .then(r => {
                        for (i in this.course.course_badges) {
                            // check if badge already acquired before adding
                            if(this.user_badges.indexOf(this.course.course_badges[i]) === -1) {
                                this.user_badges.push(parseInt(this.course.course_badges[i]));
                            } else {
                                console.log("Badge already acquired");
                            }
                        }
                        this.addBadges();
                    })
                },
                addBadges() {
                    let badgeurl = "../../server/api/badges.php";
                    let badgeparams = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                        badges: this.user_badges,
                    }

                    axios.post(badgeurl, badgeparams)
                    .then(r => {
                        console.log("user badges updated");
                    });



                    alert("You have completed the course!");
                    console.log("updated course completion");
                },
                showCourseCompleteOption() {
                    if(this.quiz_completed) {
                        let result = confirm("Complete Course?");
                        result ? alert("Completed!") : '';

                        if (result) {
                            this.courseComplete();
                            window.location.href = "homepage.php";
                        }
                    }

                },
                updateEnrolledContent(video_id) {
                    if (video_id != null) {
                        this.enrolled_content.content[video_id] == 0 ? this.enrolled_content.content[video_id] = 1 : this.enrolled_content.content[video_id] = 0;

                        let url = "../../server/api/enrollments.php";
                        let params = {
                            update: true,
                            user_id: <?php echo $_SESSION["user_id"]; ?>,
                            course_id: urlParams.get('course_id'),
                            content: JSON.stringify(this.enrolled_content),
                            completed: 0,
                        };

                        axios.post(url, params)
                        .then(r => {
                            console.log("updated checkbox");
                        })
                    } else {
                        this.enrolled_content.content[urlParams.get('video_id')] = 1;

                        let url = "../../server/api/enrollments.php";
                        let params = {
                            update: true,
                            user_id: <?php echo $_SESSION["user_id"]; ?>,
                            course_id: urlParams.get('course_id'),
                            content: JSON.stringify(this.enrolled_content),
                            completed: 0,
                        };

                        axios.post(url, params)
                        .then(r => {
                            console.log("updated checkbox");
                        })
                    }
                },
                checkUserEnrolled() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                        course_id: urlParams.get('course_id'),
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        if (r.data != null) {
                            this.enrolled = true;
                            this.enrolled_content = JSON.parse(r.data.content);
                            this.updateEnrolledContent(null);
                            console.log(r.data)
                            this.checkCourseProgress();
                            this.checkQuizProgress();

                        }
                    })
                },
                enrollUser(){
                    let contentLength = this.playlist.items.length;

                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                        course_id: urlParams.get('course_id'),
                        content: JSON.stringify({"content": Array.from({length: contentLength}).fill(0), "quiz": [0]}),
                        start_date: new Date(),
                        completed: 0,
                    }

                    axios.post(url, params)
                    .then(r => {
                        console.log(r.data);
                        // alert("new enrollment");
                        // this.enrolled = true;
                        this.checkUserEnrolled();
                    })
                },
                getCourse() {
                    // 1. get course from db (check if user is enrolled)
                    // 2. call youtube api to retrieve videos

                    let url = "../../server/api/courses.php";
                    let params = {
                        // get course_id from url
                        course_id: urlParams.get('course_id'),
                    }

                    axios.get(url, { params: params })
                    .then(r => {
                        this.course = r.data;
                        this.course.course_badges = JSON.parse(this.course.course_badges);

                        for (b in this.course.course_badges) {
                            this.getBadge(this.course.course_badges[b]);
                        }
                        this.playlist_url = r.data.playlist_url;
                        this.getPlaylist();

                    })
                },
                getBadge(badge_id){
                    let badges_url = "../../server/api/badges.php";

                    axios.get(badges_url, {params: {badge_id: badge_id}})
                    .then(r => {
                        this.course_badges.push(r.data);
                    })
                },
                getPlaylist() {
                    let url = `https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=${this.playlist_url}&key=${apiKey}`;

                    axios.get(url)
                        .then(r => {
                            this.playlist = r.data;
                            this.getVideo(this.playlist.items[this.video_id].snippet.resourceId.videoId);
                        })
                },
                getVideo(videoId) {
                    let url = `https://www.googleapis.com/youtube/v3/videos?id=${videoId}&part=contentDetails&key=${apiKey}`;

                    axios.get(url)
                    .then(r => {
                        this.video_url = `https://www.youtube.com/embed/${videoId}`;
                    })
                },
            },
            created() {
                this.getUser();
                this.getCourse();
                this.checkUserEnrolled();
            }
        })

        course.component('course-content', {
            data() {
                return {
                    duration: '',
                    video_url: '',
                }
            },
            props: ["video_id", "title", "index", "enrolled_content"],
            emits: ["update"],
            methods: {
                getVideo(video_id) {
                    let url = `https://www.googleapis.com/youtube/v3/videos?id=${video_id}&part=contentDetails&key=${apiKey}`;

                    axios.get(url)
                        .then(r => {
                            this.duration = YTDurationToHMS(r.data.items[0].contentDetails.duration)
                        })
                },
            },
            created() {
                this.getVideo(this.video_id);
            },
            template: `
                <input type="checkbox" :checked="enrolled_content.content[index]" @change="$emit('update', index)">
                <p>{{ index+1 }}. {{ title }}</p>
                <p style="font-size: small;">Duration: {{ this.duration }}</p>
            `
        })

        const vm = course.mount("#course");
    </script>

    <script>
        const listGroupItems = document.querySelectorAll('.content-item');

        listGroupItems.forEach(item => {
            item.addEventListener('click', function () {
                // Remove the 'active' class from all items
                listGroupItems.forEach(item => {
                    item.classList.remove('active');
                });

                // Add the 'active' class to the clicked item
                this.classList.add('active');
            });
        });
        const listQuizItems = document.querySelectorAll('.quiz-item');

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

</body>