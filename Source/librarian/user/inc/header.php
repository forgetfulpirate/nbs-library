<?php

include 'inc/connection.php';

?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBS Library</title>

    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="inc/css/custom1.css">
    <link rel="stylesheet" href="inc/css/animate.css">
	<link rel="stylesheet" href="dist/css/main.css">
    <link rel="stylesheet" href="dist/css/responsive.css">
    

    
</head>
<style>
        /* CSS for hover effect */
    .header-right ul li a:hover,
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        background-color: #d52033;
        color: #fff;
    }

    /* CSS to make navigation links bold and increase size */
    .navbar-nav .nav-link {
        font-weight: bold;
        font-size: 18px; /* Adjust the size as needed */
        border-radius: 5px; /* Add rounded corners to the button */
        padding: 10px 15px; /* Add padding to the button */
        transition: background-color 0.3s; /* Add transition effect */
    }

    /* CSS for dropdown hover effect */
    .navbar-nav .dropdown:hover .dropdown-menu {
        display: block;
        background: var(--bs-dark-bg-subtle);
    }
    /* CSS for hover effect on desktop */
@media (min-width: 768px) {
    .header-right ul li a:hover,
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        background-color: #d52033;
        color: #fff;
    }

    .navbar-nav .dropdown:hover .dropdown-menu {
        display: block;
        background: var(--bs-dark-bg-subtle);
    }
}

/* CSS for click effect on mobile */
@media (max-width: 767px) {
    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:focus {
        background-color: #d52033;
        color: #fff;
    }

    .navbar-nav .dropdown-menu {
        background: var(--bs-dark-bg-subtle);
    }
}

</style>

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
    transition: bottom 0.3s, right 0.3s;
}

.email-form-popup {
    display: none;
    position: fixed;
    bottom: 90px;
    right: 20px;
    background-color: inherit;
    border: 1px solid #ddd;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-width: 300px;
    width: 100%;
    transition: bottom 0.3s, right 0.3s;
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

/* Responsive adjustments */
@media (max-width: 600px) {
    .floating-email {
        bottom: 10px;
        right: 10px;
        width: 50px;
        height: 50px;
        line-height: 55px;
    }

    .email-form-popup {
        bottom: 70px;
        right: 50px;
        max-width: 80%;
        width: calc(100% - 10px);
    }
}

	

    </style>
<body>
<div class="main">
        <nav class="navbar navbar-expand-lg  shadow" >
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="dist/img/NBS-LOGO.png" alt="logo" style="width:80px; height:70px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="student/login.php">Student Login</a></li>
                                <li><a class="dropdown-item" href="teacher/login.php">Teacher Login</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contactus.php">Contact Us</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="book.php">Book</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="display-book-opac.php">Book Module</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <a href="#" class="theme-toggle" id="sidebar-toggle" type="button">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
         
     <!-- Email form popup -->
     <div class="email-form-popup" id="emailFormPopup">
        <form id="feedbackForm" action="script.php" method="post">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="subject">Subject:</label><br>
            <input type="text" id="subject" name="subject"><br>
            <label for="details">Details:</label><br>
            <textarea id="details" name="details" rows="4" cols="20"></textarea><br><br>
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


        
     
    <script src="inc/js/bootstrap.bundle.min.js"></script>
    <script src="inc/js/custom1.js"></script>
    <script src="inc/js/custom.js"></script>
	<script src="inc/js/jquery-2.2.4.min.js"></script>
	<script src="inc/js/bootstrap.min.js"></script>
	<script src="inc/js/bootstrap-select.min.js"></script>
	<script src="inc/js/waypoints.min.js"></script>

	<script src="inc/js/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>


    
</body>

</html>



