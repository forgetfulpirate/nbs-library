<?php 
    session_start();

    $page = 'a-books';
    include 'inc/header.php';
    include 'inc/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Library Management System</title>
	<link rel="icon" type="image/png" href="dist/img/favicon.ico">

	<link rel="stylesheet" href="dist/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="dist/css/owl.carousel.min.css">
	<link rel="stylesheet" href="dist/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="dist/css/animate.css">
	<link rel="stylesheet" href="dist/css/main.css">
</head>
<body>

	<!--Start slider-->
	<div class="slider">
		<div class="slide-carousel owl-carousel">
			<div class="item" style="background-image:url(dist/img/bg-login.png);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
						<h2>welcome to NBSC library</h2>
					</div>
					<div class="this-item">
						<h3>we stand behind your success</h3>
					</div>
					<div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/lib1.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
					<h2>welcome to NBSC library</h2>
					</div>
					<div class="this-item">
						<h3>we stand behind your success</h3>
					</div>
					<div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/lib2.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
					<h2>welcome to NBSC library</h2>
					</div>
					<div class="this-item">
						<h3>we stand behind your success</h3>
					</div>
					<div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<!-- <div class="item" style="background-image:url(dist/img/lib3.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
						<h2>welcome to our library</h2>
					</div>
					<div class="this-item">
						<h3>We stand behind your success</h3>
					</div>
					<div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div> -->
			<!-- <div class="item" style="background-image:url(dist/img/5.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
						<h2>welcome to our library</h2>
					</div>
					<div class="this-item">
						<h3>We stand behind your success</h3>
					</div>
					<div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div>
			<div class="item" style="background-image:url(dist/img/6.jpg);">
				<div class="overlay"></div>
				<div class="text">
					<div class="this-item">
						<h2>welcome to our library</h2>
					</div>
					<div class="this-item">
						<h3>We stand behind your success</h3>
					</div>
					<div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div>
				</div>
			</div> -->
		</div>		
	</div>

	<div class="footer text-center">
		<p>&copy; All rights reserved NBS College</p>
	</div>			

	<script src="dist/js/jquery-2.2.4.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/fontawesome.min.js"></script>
	<script src="dist/js/owl.carousel.min.js"></script>
	<script src="dist/js/owl.animate.js"></script>
	<script src="dist/js/custom.js"></script>
</body>
</html>