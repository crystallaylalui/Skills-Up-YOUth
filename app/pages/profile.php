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

		<title>AdminHub</title>
</head>
<body>
	<div>
        <?php include ('navbar.php'); ?>
    </div>




	<!-- CONTENT -->
	<!-- <section id="content"> -->
		

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Welcome back!</h1>
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
						<h3>5</h3>
						<p>Courses Completed</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-badge-check' ></i>
					<span class="text">
						<h3>5</h3>
						<p>Badges earned</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-bar-chart-alt-2' ></i>
					<span class="text">
						<h3>60</h3>
						<p>Points </p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Course List</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Course Name</th>
								<th>Start Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<img src="../images/python.jpg">
									<p>Python Fundamentals</p>
								</td>
								<td>29-01-2023</td>
								<!-- <td><span class="status completed">Completed</span></td> -->
							</tr>
							<tr>
								<td>
									<img src="../images/python.jpg">
									<p>Python: Intermediate</p>
								</td>
								<td>30-10-2023</td>
								<!-- <td><span class="status completed">Completed</span></td> -->
							</tr>
							<tr>
								<td>
									<img src="../images/javascript.jpg">
									<p>Javascript Fundamentals</p>
								</td>
								<td>01-03-2023</td>
								<!-- <td><span class="status completed">Completed</span></td> -->
							</tr>
							<tr>
								<td>
									<img src="../images/php.png">
									<p>Introduction to PHP</p>
								</td>
								<td>20-06-2023</td>
								<!-- <td><span class="status completed">Completed</span></td> -->
							</tr>
							<tr>
								<td>
									<img src="../images/sql.png">
									<p>Introduction to SQL</p>
								</td>
								<td>12-07-2023</td>
								<!-- <td><span class="status completed">Completed</span></td> -->
							</tr>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Badges</h3>
					</div>
					<ul class="todo-list">
						<li>
							<p><img src="../images/badges/py1.png" alt="" class = 'badges'></p>
							<p><img src="../images/badges/py2.png" alt="" class = 'badges'></p>
						</li>
						<li>
							<p><img src="../images/badges/py2.png" alt="" class = 'badges'></p>
						</li>
                        <li>
							<p><img src="../images/badges/js1.png" alt="" class = 'badges'></p>
						</li>
						<li>
							<p><img src="../images/badges/php1.png" alt="" class = 'badges'></p>
						</li>
						<li>
							<p><img src="../images/badges/sql1.png" alt="" class = 'badges'></p>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>