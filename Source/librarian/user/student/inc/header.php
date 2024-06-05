<?php

    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    
include 'inc/connection.php';
$not= 0;
$res = mysqli_query($link,"select * from message where rusername='$_SESSION[student]' && read1='n'");
$not= mysqli_num_rows($res);

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBS Library</title>

    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/custom1.css">
    <link rel="stylesheet" href="inc/css/animate.css">

</head>
<body>
    <div class="wrapper">
    <aside id="sidebar" class="js-sidebar">

            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo text-center">
                    <a href="dashboard.php">NBS College Library</a>
                </div>
				
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
            
                    <span>
                        <?php
        
						  $res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");

						  while ($row1 = mysqli_fetch_array($res1)){
							  ?><img src="<?php echo $row1["photo"]; ?> " height="50px" width="50px" alt="something wrong" class="rounded-circle" style="float:left;"> </a> <?php
						  }
                        ?>
						<h6 style="float: right; margin-top: 10px; color:inherit;">
						
						Welcome


			   		<?php
		   
					$res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");
				   
					while ($row = mysqli_fetch_array($res1)){
						?><?php echo $row["user_type"]; ?><span>,</span><?php
					}
			   		?>
                            
            			</h6>
                        <br><br>
                        </span>
                        

                        <h6 style="float:inline-end; margin-top: 1px; font-weight:normal;">
				

			   		<?php
		   
					$res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");
				   
					while ($row = mysqli_fetch_array($res1)){
						?><?php echo $row["first_name"]; ?><span> <?php echo $row["last_name"]; ?></span><?php
					}
			   		?>
                            
            			</h6>
                        
				
                    </li>
                    <br>
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    
                    <li class="sidebar-item <?php if($page=='home'){ echo 'active';} ?>">
                        <a href="dashboard.php" class="sidebar-link">
                        <i class="fa-solid fa-gauge pe-2"></i>
                            Search Book
                        </a>
                    </li>

					<li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manage" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            My Profile
                        </a>

                        <ul id="manage" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item <?php if($page=='abook'){ echo 'active';} ?>" >
                                <a href="profile.php" class="sidebar-link">Profile</a>
                            </li>
                            <li class="sidebar-item <?php if($page=='tbook'){ echo 'active';} ?>">
                                <a href="changepass.php" class="sidebar-link">Change Passowrd</a>
                            </li>
                        
                        
                        </ul>
                    </li>

					<li class="sidebar-item <?php if($page=='issue-book'){ echo 'active';} ?>">
                        <a href="my-issued-books.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>
                            My Borrowed book
                        </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='finezone'){ echo 'active';} ?>">
                        <a href="finezone.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>

                            My Overdue
                        </a>
                    </li>
                
    

                    <!-- <li class="sidebar-item <?php if($page=='d-ebook'){ echo 'active';} ?>">
                                <a href="ebooks.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    E-Book
                                </a>
                    </li>

                    <li class="sidebar-item">
                                <a href="book.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Books
                                </a>
                    </li> -->
<!-- 
                    <li class="sidebar-item">
                                <a href="display-book-opac.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Book Module
                                </a>
                    </li> -->
<!-- 
                    <li class="sidebar-item <?php if($page=='d-t-book'){ echo 'active';} ?>">
                                <a href="display-thesis.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Display Theses
                                </a>
                    </li> -->
            
                    <!-- <li class="sidebar-item <?php if($page=='ibook'){ echo 'active';} ?>">
                        <a href="request-book.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>

                            Request Book
                        </a>
                    </li> -->
        

                
                </ul>
                
            </div>
            
        </aside>
        
        
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
			
                <div class="navbar-collapse navbar">
                        <ul class="navbar-nav" style="margin-right:10px;">
                 
                        
                        <li class="nav-item dropdown">
								<?php
                                      $res = mysqli_query($link, "select * from std_registration where username='".$_SESSION['student']."'");
									  $res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");
									  while ($row = mysqli_fetch_array($res)){
										  ?><a href="" class="dropdown-toggle" data-bs-toggle="dropdown" ><img src="<?php echo $row["photo"]; ?>" alt="" height="50px" width="50px" ><span><?php echo $_SESSION["student"]; ?></span></a> <?php
									  }
									  while ($row = mysqli_fetch_array($res1)){
										 ?><a href="" class="dropdown-toggle" data-bs-toggle="dropdown" ><img src="<?php echo $row["photo"]; ?>" height="50px" width="50px" img-ro alt=""><span><?php echo $row["first_name"]; ?></span></a> <?php
									 }
                                ?>
								
                         
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="profile.php" class="dropdown-item">Profile</a>
                
                                <a href="logout.php" class="dropdown-item">Logout</a>
                                <a href="changepass.php" class="dropdown-item">Change Password</a>
                            </div>
                        </li>
                        
                    </ul>
                </div>
                
            </nav>
            
      
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
                              
            
        
     
    <script src="inc/js/bootstrap.bundle.min.js"></script>
    <script src="inc/js/custom1.js"></script>
    <script src="inc/js/custom.js"></script>
	<script src="inc/js/jquery-2.2.4.min.js"></script>
	<script src="inc/js/bootstrap.min.js"></script>
	<script src="inc/js/bootstrap-select.min.js"></script>
	<script src="inc/js/waypoints.min.js"></script>
	<script src="inc/js/jquery.counterup.min.js"></script>
	<script src="inc/js/datatables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
	

    
</body>

</html>



