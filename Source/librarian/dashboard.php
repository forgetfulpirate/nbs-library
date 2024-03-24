<?php 
     session_start();
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
                            <li class="sidebar-item">
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
					
					   <footer class="footer">
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
            </footer>

                    
                   
                   
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
                                         ?><a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0"><img src="<?php echo $row["photo"]; ?>" alt=""class="avatar img-fluid rounded"> <span style="color:#248fc5"><?php echo $_SESSION["username"]; ?></span></a> <?php
                                     }
                                ?>
								
                         
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="profile.php" class="dropdown-item">Profile</a>
                
                                <a href="logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
			<div class="gap-40"></div>
                <div class="container-fluid">
				<div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row g-2 my-10 ">
                        <div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-10 d-flex">
                                            <div class="p-3 m-1">
											<h3><span>Welcome Back Admin,</span> </h3>
						<h4>
							
							<?php 
								$res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
								while ($row = mysqli_fetch_array($res)){
								$name  =  $row["name"];
								echo $name;
								}
							?>
							
            			</h4>
						
                                            </div>
											
                                        </div>
										<div class="align-self-end text-end">
                                           
                           			 	</div>
									
                                    </div>
									
                                </div>
								
                            </div>
						
							
					</div>
					

					<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fa fa-users"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
                                    <?php
                                         $res = mysqli_query($link, "select * from std_registration");
                                         $res2 = mysqli_query($link, "select * from t_registration");
                                         $count2 = mysqli_num_rows($res2);
                                         $count = mysqli_num_rows($res);
                                         $result = $count + $count2;
                                         echo $result;
                                    ?>
                                    </span></h3>
								<h4><a href="#">Members</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
										<!--  -->
						<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fa fa-rocket"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
								<?php
                                         $res = mysqli_query($link, "select * from issue_book");
                                         $res2 = mysqli_query($link, "select * from t_issuebook");
                                         $count2 = mysqli_num_rows($res2);
                                         $count = mysqli_num_rows($res);
                                         $result = $count + $count2;
                                        echo $result;
                                    ?>
                                    </span></h3>
								<h4><a href="issued-books.php">Issued Boooks</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

										<!--  -->
										<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fa fa-book"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
								<?php
                                         $res = mysqli_query($link, "select * from add_book");
                                         $count = mysqli_num_rows($res);
                                        echo $count;
                                    ?>
                                    </span></h3>
								<h4><a href="display-books.php">Books</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

										<!--  -->
										<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-dollar-sign"></i>
							</div>
							<div class="text-left">
								<h3><span class="counter">
								<?php
                                         $res = mysqli_query($link, "select fine from finezone");
                                         $count = mysqli_num_rows($res);
                                        echo $count * 50;
                                    ?>
                                    </span></h3>
								<h4><a href="fine.php">Fine</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<!--  -->
							<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-book"></i>
							</div>
							<div class="text-left">
								
								<h4><a href="display-books.php">Manage Book</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							

							<!--  -->
							<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-user"></i>
							</div>
							<div class="text-left">
							<h3>
								<span class="counter1">
								
                                    </span>
								</h3>
								
								<h4><a href="add-student.php">Manage User</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

								<!--  -->
								<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fab fa-staylinked"></i>
							</div>
							<div class="text-left">
								
								<h4><a href="status.php">User Status</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

							<!--  -->
							<div class="col-md-4 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
										<div class="box">
							<div class="icon1">
								<i class="fas fa-book"></i>
							</div>
							<div class="text-left">
								
							<h4 class="mt-10"><a href="requested-books.php">Requested Books</a></h4>
							</div>
						</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
              
              
							
							
				
				
				
			
			
					
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

