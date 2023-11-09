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
    <title>Job Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer src="navbar.js"></script>

    <link href="../css/style.css" rel="stylesheet">
</head>

<style>
    img {
        width: 80px;
    }
</style>

<body>
    <div>
        <?php include ('navbar.php'); ?>
    </div>
    <div class="row jobs-banner">
        <div class="container-fluid">
            <p class="display-6">Freelance jobs available</p>
            <p class="fs-5">Transform the badges you have earned into a job experience.</p>
        </div>
    </div>
    <div class="row">
        <!-- jobs -->
        <!-- <div class="col-md-8" style="padding: 50px;"> -->
        <div style="padding: 50px;">
        <p class="font2">Unlocked Jobs</p>
            <div class="row">
                <div v-for="j in unlocked" class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card card-custom bg-light border-black border-2" style="margin-bottom:50px">
                        <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                        <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job1.jpeg" alt="Avatar" /> -->
                        </div>
                        <div class="card-body" style="overflow-y: auto">
                        <h4 class="card-title">{{ j.title }}</h4>
                        <p class="card-text">{{ j.responsibilities[0] }}</p>
                        <img v-for="i in j.badges" :src="'../images/badges/' + i + '.png'">
                        </div>
                        <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a :href="getUrl(j.id)" class="btn btn-dark">Learn More</a>
                        <!-- <button id="saveButton" onclick="saveFilters()">Save</button> -->
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="row" style="display: flex; flex-wrap: wrap;">
    <!-- jobs -->
    <!-- <div class="col-md-8" style="padding: 50px;"> -->
    <div style="padding: 50px;">
        <p class="font2">All Jobs</p>
        <div class="row" style="display: flex; flex-wrap: wrap;">
            <div v-for="j in locked" class="col-lg-3 col-md-4 col-sm-6" style="display: flex; padding: 15px;">
            <div class="card card-custom bg-light" style="margin-bottom: 50px; border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.6);">
                    <div class="card-custom-img" style="background-image: url(../images/job.jpg)"></div>
                    <div class="card-custom-avatar">
                        <!-- <img class="img-fluid" src="../images/job1.jpeg" alt="Avatar" /> -->
                    </div>
                    <div class="card-body" style="overflow-y: auto;">
                        <h4 class="card-title">{{ j.title }}</h4>
                        <p class="card-text">{{ j.responsibilities[0] }}</p>
                        <img v-for="i in j.badges" :src="'../images/badges/' + i + '.png'">
                    </div>
                    <div class="card-footer" style="background: inherit; border-color: inherit;">
                        <a :href="getUrl(j.id)" class="btn btn-dark">Learn More</a>
                        <!-- <button id="saveButton" onclick="saveFilters()">Save</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        const jobs = Vue.createApp({
            data() {
                return {
                    user: '',
                    jobs: [],
                    badges: [],
                    user_badges: [],
                    job_badges: [],
                    j_badges: [5],

                    unlocked: [],
                    locked: [],
                }
            },
            created() {
                this.getUser();
                // this.getJBadges();
                
            },
            methods: {
                // filterJobs() {
                //     return this.j_badges.every(r => this.user_badges.includes(r));
                // },
                getUser(){
                    let url = "../../server/api/users.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"] ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.user = r.data;
                        this.user_badges = JSON.parse(r.data.badges);
						// for (b in this.user_badges) {
                        //     this.getBadge(this.user_badges[b]);
                        // }
                        this.getAllJobs();
                    })
                },
                getAllJobs() {
                    let url = "https://crystallaylalui.github.io/JSON-Data/db.json";

                    axios.get(url)
                    .then(r => {
                        this.jobs = r.data.jobs;

                        for (i in r.data.jobs) {
                            if(r.data.jobs[i].job_badges.every(r => this.user_badges.includes(r)) == true){
                                this.unlocked.push(r.data.jobs[i]);
                            } else {
                                this.locked.push(r.data.jobs[i]);
                            }
                        }
                    })
                },
                getUrl(id){
                    if(id == 1) {
                        return "job-description1.php";
                    } else if (id == 2) {
                        return "job-description2.php";
                    } else if (id == 3) {
                        return "job-description3.php";
                    } else if (id == 4) {
                        return "job-description4.php";
                    }
                }
            }
        })

        const vm = jobs.mount('body');
    </script>

</body>
</html>