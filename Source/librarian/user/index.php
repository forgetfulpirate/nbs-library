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
	<style>


	

    </style>
</head>
<body>
        <br>
        <br>
        <br>
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
					<!-- <div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div> -->
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
					<!-- <div class="this-item">
                        <p><a href="student/registration.php">student registration</a></p>
                        <p><a href="teacher/registration.php">teacher registration</a></p>
					</div> -->
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
					<!-- <div class="this-item">
						<p><a href="student/registration.php">student registration</a></p>
						<p><a href="teacher/registration.php">teacher registration</a></p>
					</div> -->
				</div>
			</div>

		</div>		
	</div>

	<footer style="text-align: center;">
    <div style="display: flex; align-items: center; justify-content: center;">
        <img src="dist/img/NBS-LOGO.png" alt="Telephone and Fax" style="width: 100px; height: 100px; border-radius: 50%; margin-right: 10px; margin:0;">
        <div style="text-align: left;">
            <p style="margin: 0; font-size:small;">NBS College Library, Sct. Borromeo corner Quezon Avenue, Diliman, Lungsod Quezon</p>
            <p style="margin: 0; font-size:small;">Tel. (xxx) xxx-xxx; Cp No. (63+) xxx-xxx-xxx</p>
            <p style="margin: 0; font-size:small;">library@nbscollege.edu.ph</p>
        </div>
    </div>
  
    <br>
    
</footer>


		

	

	<script src="dist/js/jquery-2.2.4.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/fontawesome.min.js"></script>
	<script src="dist/js/owl.carousel.min.js"></script>
	<script src="dist/js/owl.animate.js"></script>
	<script src="dist/js/custom.js"></script>

</body>
</html>