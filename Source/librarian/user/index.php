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
        /* Style for floating email icon */
        .floating-email {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: #d52033;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 65px; /* Center icon vertically */
            cursor: pointer;
            z-index: 1000;
        }

        .email-form-popup {
            display: none;
            position: fixed;
            bottom: 90px;
            right: 30px;
            background-color: white;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        /* Add animation to form popup */
        @keyframes slideIn {
            from {
                bottom: -200px;
            }
            to {
                bottom: 90px;
            }
        }
		.email-form-popup.show {
            animation: slideIn 0.3s forwards;
        }

        /* Style for feedback message */
        #feedbackMessage {
            color: green; /* Change the color to green or success */
        }

	

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
   <!-- Email form popup -->
   <div class="email-form-popup" id="emailFormPopup">
        <form id="feedbackForm" action="script.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="subject">Subject:</label><br>
            <input type="text" id="subject" name="subject"><br>
            <label for="details">Details:</label><br>
            <textarea id="details" name="details" rows="4" cols="50"></textarea><br><br>
            <input type="submit" value="Submit">
        </form>

		
		<div id="feedbackMessage"></div>
    </div>
    
    <!-- Floating email icon -->
    <div class="floating-email" onclick="toggleFormPopup()">
        <i class="fas fa-envelope" style="font-size: 24px;"></i>
    </div>


    <!-- Script to toggle form popup and handle form submission -->
    <script src="dist/js/jquery-2.2.4.min.js"></script>
    <script>
        // Function to show/hide form popup
        function toggleFormPopup() {
            var formPopup = document.getElementById('emailFormPopup');
            formPopup.style.display = formPopup.style.display === 'none' ? 'block' : 'none';
        }

        $(document).ready(function(){
            $('#feedbackForm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'script.php',
                    data: $('#feedbackForm').serialize(),
                    success: function(response){
                        $('#feedbackMessage').html(response);
                        $('#feedbackForm')[0].reset();
                    }
                });
            });
        });
    </script>
	

	<script src="dist/js/jquery-2.2.4.min.js"></script>
	<script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/fontawesome.min.js"></script>
	<script src="dist/js/owl.carousel.min.js"></script>
	<script src="dist/js/owl.animate.js"></script>
	<script src="dist/js/custom.js"></script>

</body>
</html>