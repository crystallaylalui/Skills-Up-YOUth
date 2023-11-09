<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div id="courses">
    <div>
        <?php include ('navbar.php'); ?>
    </div>


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
                    badges: [],
                    selection: [],
                    selected_badges: [],
                }
            },
            props: [''],
            created() {
                this.getBadges();
            },
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
                        badges: JSON.stringify(this.selection),
                    }

                    axios.post(url, params)
                    .then(r => {
                        console.log(r.data);
                        alert("Added Course successfully");
                    })
                },
                getBadges() {
                    let url = "../../server/api/badges.php";

                    axios.get(url)
                    .then(r => {
                        this.badges = r.data;
                    });
                    // console.log(this.badges);
                    return this.badges;
                },
                addBadges(selected) {
                    this.selection = selected;

                    for (i in this.selection) {
                        this.getBadge(this.selection[i]);
                    }
                },
                getBadge(badge_id){
                    let badges_url = "../../server/api/badges.php";

                    axios.get(badges_url, {params: {badge_id: badge_id}})
                    .then(r => {
                        this.selected_badges.push(r.data);
                    })
                }
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

                <!-- badges -->
                <hr solid class="my-5">
                <h2 class="text-center">Badges</h2>
                <div id="badges" class="container-fluid p-5 my-5 bg-dark rounded-5">
                    <div v-for="badge in badges" class="d-inline row">
                        <img class="col-1" v-bind:src="'../images/badges/' + badge.badge_img">
                    </div>

                    <select v-model="selected" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" size="16" multiple>
                        <option v-for="badge in badges" v-bind:value="badge.badge_id">{{ badge.badge_name }}</option>
                    </select>
                    <button class="btn bg-light col-12" @click="addBadges(selected)">Add Badges</button>
                    
                    <br>
                    <h2 style="color: white">Selection:</h2>
                    <div v-for="badge in selected_badges" class="d-inline row">
                        <img class="col-1" v-bind:src="'../images/badges/' + badge.badge_img">
                    </div>
                </div>

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