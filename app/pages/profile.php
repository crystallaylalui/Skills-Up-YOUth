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

		<!-- Boxicons -->
		<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
		<!-- My CSS -->
		<link rel="stylesheet" href="../css/styles.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
		<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
		<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
		<script defer src="navbar.js"></script>

		<title>Profile</title>
</head>
<body style="background:url(../images/space-bg1.jpg) no-repeat center center fixed; background-size: cover;">
	<div>
        <?php include ('navbar.php'); ?>
    </div>




	<!-- CONTENT -->
	<!-- <section id="content"> -->
		

		<!-- MAIN -->
		<main id="profile">
			<div class="head-title">
				<div class="left">
					<p class="display-6" style="color:white"> Your Profile</p>
					<!-- <ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul> -->
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3>{{ completed }}</h3>
						<p>Courses Completed</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-badge-check' ></i>
					<span class="text">
						<h3>{{ user_badges.length }}</h3>
						<p>Badges earned</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-bar-chart-alt-2' ></i>
					<span class="text">
						<h3>{{user.points}}</h3>
						<p>Points </p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Course List</h3>
					</div>
					<table>
						<thead>
							<tr>
								<th>Course Name</th>
								<th>Start Date</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="e in enrolled">
								<td>
									<img v-if="checkTitle(e, 'Python')" src="../images/python.jpg">
									<img v-if="checkTitle(e, 'PHP')" src="../images/php.png">
									<img v-if="checkTitle(e, 'Javascript')" src="../images/javascript.jpg">
									<img v-if="checkTitle(e, 'SQL')" src="../images/sql.png">
									<p>{{e.course ? e.course.course_title : ''}}</p>
								</td>
								<td>{{ e.start_date }}</td>
								<td v-if="e.completed == '1'"><span class="status completed">Completed</span></td>
								<td v-if="e.completed == '0'"><span class="status ongoing">Ongoing</span></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Badges</h3>
					</div>
					<ul class="row">
						<li v-for="b in badges" class="col-6">
							<img :src="'../images/badges/' + b.badge_img" alt="" class = 'badges'>
						</li>

					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script>
		const profile = Vue.createApp({
			data() {
				return {
					user: '',
					user_badges: [],
					enrolled: '',
					completed: 0,
					badges: [],
				}
			},
			created() {
				this.getUser();
			},
			methods: {
				checkTitle(e, name) {
					if (e.course) {
						return e.course.course_title.split(' ')[0] == name
					}
					
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
						for (b in this.user_badges) {
                            this.getBadge(this.user_badges[b]);
                        }
						this.getEnrolledCourses();
                    })
                },
				getEnrolledCourses() {
                    let url = "../../server/api/enrollments.php";
                    let params = {
                        user_id: <?php echo $_SESSION["user_id"]; ?>,
                    }

                    axios.get(url, {params: params})
                    .then(r => {
                        this.enrolled = r.data;
                        for (c in r.data) {
                            this.getCourse(r.data[c].course_id, c);
                        }
						this.completed = r.data.filter(e => e.completed == 1 ).length;
                    })
                },
				getCourse(course_id, index) {
                    let url = "../../server/api/courses.php";
                    let params = {
                        course_id: course_id,
                    }

                    axios.get(url, { params: params })
                    .then(r => {
                        this.enrolled[index].course = r.data;
                    })
                    .catch(e => {
                        console.log(e);
                    })
                },
				getBadge(badge_id){
                    let badges_url = "../../server/api/badges.php";

                    axios.get(badges_url, {params: {badge_id: badge_id}})
                    .then(r => {
                        this.badges.push(r.data);
						this.badges.sort(function(a, b){return a.badge_id - b.badge_id})
                    })
                },
			}
		})

		const vm = profile.mount("#profile");
	</script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<!-- <script src="script.js"></script> -->
</body>
</html>