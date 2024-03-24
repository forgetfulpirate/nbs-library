<?php 

    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'home';
    include 'inc/connection.php';
 ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
<link rel="stylesheet" href="inc/css/pro1.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="inc/css/custom1.css">
   
</head>

<body>
    <div class="wrapper">
    <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
			
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">CodzSword</a>
                </div>
				
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="all-student-info.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            All student information
                        </a>
                    </li>

					<li class="sidebar-item">
                        <a href="all-teacher-info.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            All teacher information
                        </a>
                    </li>
                   
                   
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manage" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Manage Book
                        </a>
                        <ul id="manage" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item  <?php if($page=='abook'){ echo 'active';} ?>">
                                <a href="add-book.php" class="sidebar-link">Add book</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="display-books.php" class="sidebar-link">Display Book</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link collapsed" data-bs-target="#issue" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Issue Book
                        </a>
                        <ul id="issue" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="issue-book.php" class="sidebar-link">Student issue book</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="teacher-issue-book.php" class="sidebar-link">Teacher issue book</a>
                            </li>
                        </ul>
                    </li>



                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#user" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Manage User
                        </a>
                        <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Add student</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Add teacher</a>
                            </li>
                        </ul>
                    </li>
              
            

                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Issue book
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            View requested book
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-sliders pe-2"></i>
                            Send message to user
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Send to student</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">Send to teacher</a>
                            </li>
                        </ul>
                    </li>

                    
                   
                   
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
			
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
								<?php
                                     $res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
                                     while ($row = mysqli_fetch_array($res)){
                                         ?><a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0"><img src="<?php echo $row["photo"]; ?>" alt=""class="avatar img-fluid rounded"> <span><?php echo $_SESSION["username"]; ?></span></a> <?php
                                     }
                                ?>
								
                         
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="#" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
			<div class="gap-40"></div>
                
               
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <!-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>CodzSwod</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Booking</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="inc/js/custom1.js"></script>
    <script src="inc/js/custom.js"></script>
	<script src="inc/js/jquery-2.2.4.min.js"></script>
	<script src="inc/js/bootstrap.min.js"></script>
	<script src="inc/js/bootstrap-select.min.js"></script>
	<script src="inc/js/waypoints.min.js"></script>
	<script src="inc/js/jquery.counterup.min.js"></script>
	<script src="inc/js/datatables.min.js"></script>
	<script src="inc/js/datatables.js"></script>
	<script src="inc/js/custom.js"></script>
</body>

</html>

