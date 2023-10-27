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

    <div id="course" class="container">
        <div class="row">
            <div class="col-md-9 my-5">
                <h1>{{ parseInt(video_id) + 1 }}. {{ playlist.items[video_id].snippet.title }}</h1>
                <br>
                <div class="ratio ratio-16x9">
                    <iframe v-bind:src="video_url" title="YouTube video" allowfullscreen></iframe>
                </div>
                <div class="my-5 card p-3 rounded-2">
                    <h1> {{ course.course_title }}</h1>
                    <h4>Course Description</h4>
                    <p>{{ course.course_description }}</p>
                </div>
            </div>

            <div class="col-md-3 pt-5">
                <h4>
                    Course Content
                </h4>
                <div class="list-group">
                        <!-- Course content -->
                        <div v-for="(v, index) in playlist.items">
                            <a :href="'course.php?course_id=' + course.course_id + '&video_id=' + index" class="list-group-item list-group-item-action content-item">
                                <course-content :index="index" :video_id="v.snippet.resourceId.videoId" :title="v.snippet.title"><course-content>
                            </a>
                        </div>
                    
                </div>

                  <h4 class="pt-5"> quizzes to be completed </h4>
                  <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action quiz-item" aria-current="true"> 
                        <h5>mid-course quiz</h5>
                        <p style="font-size: small;"> 3 questions </p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action quiz-item">
                        <h5>final quiz</h5>
                        <p style="font-size: small;">10 questions</p>
                    </a>
                </div>
            </div>
        </div>

    </div>
    
    <script>
        let urlParams = new URLSearchParams(window.location.search);

        function YTDurationToSeconds(duration) {
            var match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/);

            match = match.slice(1).map(function(x) {
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

        const course = Vue.createApp({
            data() {
                return {
                    course: '', // get course from db
                    playlist: '', // save playlist json
                    playlist_url: '', // get yt playlist from api
                    video_id: urlParams.get('video_id'), // get video_id from url query
                    video_url: '', // get yt video from api using video_id
                }
            },
            methods: {
                getCourse() {
                    
                    // 1. get course from db (check if user is enrolled)
                    // 2. call youtube api to retrieve videos

                    let url = "../../server/api/courses.php";
                    let params = {
                        // get course_id from url
                        course_id: urlParams.get('course_id'),
                        video_id: this.video_id, 
                        video_url: '',
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.course = r.data;
                        this.playlist_url = r.data.playlist_url;
                        this.getPlaylist();
                    })
                },
                getPlaylist() {
                    let url = `https://youtube.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&playlistId=${this.playlist_url}&key=AIzaSyArqgpdPWq6_ZTQgdzn9r1dIxpYoysqOlY`;

                    axios.get(url)
                    .then(r => {
                        this.playlist = r.data;
                        this.getVideo(this.playlist.items[this.video_id].snippet.resourceId.videoId);
                    })
                },
                getVideo(videoId) {
                    let url = `https://www.googleapis.com/youtube/v3/videos?id=${videoId}&part=contentDetails&key=AIzaSyArqgpdPWq6_ZTQgdzn9r1dIxpYoysqOlY`;
                    
                    axios.get(url)
                    .then(r => {
                        this.video_url = `https://www.youtube.com/embed/${videoId}`;
                    })
                }
            },
            created() {
                // this.showCourses();
                this.getCourse();
            }
        })

        course.component('course-content',{
            data(){
                return {
                    duration: '',
                    video_url: '',
                    // active: urlParams.get('video_id') == this.index? 'active' : '';
                }
            },
            props: ["video_id", "title", "index"],
            methods: {
                getVideo(video_id) {
                    let url = `https://www.googleapis.com/youtube/v3/videos?id=${video_id}&part=contentDetails&key=AIzaSyArqgpdPWq6_ZTQgdzn9r1dIxpYoysqOlY`;
                    
                    axios.get(url)
                    .then(r => {
                        this.duration = YTDurationToSeconds(r.data.items[0].contentDetails.duration)
                    })
                }
            },
            created() {
                this.getVideo(this.video_id);
            },
            template: `
                <input type="checkbox">
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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>

</body>