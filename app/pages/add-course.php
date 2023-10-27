<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div id="courses">
        <nav class="navbar navbar-expand-lg navbar-dark bg-black">
            <div class="container-fluid">
                <!-- Left Logo -->
                <a class="navbar-brand" href="#" style="font-size: 30px; flex: 0;">
                    <img src="../images/logo.jpg" alt="Logo" style="width: 150px;">
                </a>

                <!-- Navbar Toggler Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                    <img src="../images/filler.jpg" alt="Logo" width="50" height="50">
                </a>
            </div>
            <div id="indicator"></div>
        </nav>

        <h1>Courses</h1>
        <div class="container shadow-lg rounded-5 p-2" >
            <div class="m-5">
                <h3>Add Course Form</h3>
                <add-course></add-course>
            </div>
        </div>



    </div>



    </div>

    <script>
        const courses = Vue.createApp({
            data() {
                return {
                }
            }
        })

        // add course component
        courses.component('add-course', {
            data() {
                return {
                    playlist_url: '',
                    title: '',
                    description: '',
                }
            },
            props: [''],
            methods: {
                addCourse() {
                    let url = "../../server/api/courses.php";

                    console.log(
                        `
                            ${this.playlist_url.substring(38)} 
                            ${this.title}
                            ${this.description} 
                        `
                    );

                    let params = {
                        playlist_url: this.playlist_url.substring(38),
                        title: this.title,
                        description: this.description,
                        badges: '[1, 2, 3, 4]',
                    }

                    axios.post(url, params)
                    .then(r => {
                        console.log(r.data);
                        alert("Added Course successfully");
                    })
                },
            },
            template: `
                <label for="title">Title</label>

                <input type="text" class="form-control" id="title" aria-describedby="titleHelp"
                    placeholder="Enter a course title" v-model="title">

                <br>

                <div class="form-group">
                    <label for="playlist">Playlist <span class="text-black-50">eg. https://www.youtube.com/playlist?list=PLWKjhJtqVAbleDe3_ZA8h3AO2rXar-q2V</span></label>
                    <input type="text" class="form-control" id="playlist" aria-describedby="playlistHelp"
                        placeholder="Enter the playlist URL" v-model="playlist_url">
                </div>

                <br>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" placeholder="Enter course description" id="description" rows="3" v-model="description"></textarea>
                </div>

                <br>

                <button type="submit" class="btn btn-primary" @click="addCourse">Submit</button>
            `,
        })

        let vm = courses.mount('#courses');
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
</body>

</html>