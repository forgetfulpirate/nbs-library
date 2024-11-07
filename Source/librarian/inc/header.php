<?php 
  
  
    include 'inc/connection.php';
    $not=0;
    $res = mysqli_query($link,"select * from request_books where read1='no'");
    $not= mysqli_num_rows($res);
 ?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
 
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NBS College Library</title>
    <link href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
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
                    <a href="dashboard.php">NBSC LIBRARY</a>
                </div>
				
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
            
                        <span>
                        <?php
                            $res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
                            while ($row = mysqli_fetch_array($res)){
                                ?><img src="<?php echo $row["photo"]; ?> " height="50px" width="50px" alt="something wrong" class="rounded-circle"></a> <?php
                            }
                        ?>
                            
                        </span>
                        
                        

                        <h6 style="float: right; margin-top: 10px;">
							<?php 
								$res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
								while ($row = mysqli_fetch_array($res)){
								$name  =  $row["name"];
								echo $name;
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
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item <?php if($page=='sinfo'){ echo 'active';} ?>">
                        <a href="all-student-info.php" class="sidebar-link">
                        <i class="fa-solid fa-users pe-2"></i>
                            All student information
                        </a>
                    </li>
             
					<li class="sidebar-item <?php if($page=='tinfo'){ echo 'active';} ?>">
                        <a href="all-teacher-info.php" class="sidebar-link">
                            <i class="fa-solid fa-users pe-2"></i>
                            All Faculty information
                        </a>
                    </li>

                          
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manage" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Add Book
                        </a>
                        <ul id="manage" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">       
                            <li class="sidebar-item <?php if($page=='add-b'){ echo 'active';} ?>">
                                <a href="add-book-module.php" class="sidebar-link">Add Book Module</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link collapsed" data-bs-target="#issue" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Issue Book
                        </a>
                        <ul id="issue" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                            <li class="sidebar-item <?php if($page=='issue-student'){ echo 'active';} ?>">
                                <a href="std-issue-book.php" class="sidebar-link">Student Issue Book</a>
                            </li>
                            <li class="sidebar-item <?php if($page=='issue-tch'){ echo 'active';} ?>">
                                <a href="tch-issue-book.php" class="sidebar-link">Teacher Issue Book</a>
                            </li>

                        </ul>
                    </li>

                    <li class="sidebar-item <?php if($page=='a-book'){ echo 'active';} ?>">
                        <a href="display-book-opac.php" class="sidebar-link">
                        <i class="fa-solid fa-book pe-2"></i>
                            View Book Opac
                        </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='user-archive'){ echo 'active';} ?>">
                        <a href="archive-user.php" class="sidebar-link">
                        <i class="fa-solid fa-user-xmark"></i>
                            Archived Users
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#report" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-chart-pie"></i></i>
                             Generate Report
                        </a>
                        <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">

                            <li class="sidebar-item ">
                                <a href="generate-report-borrowed.php" class="sidebar-link">Borrowed Books Report</a>
                            </li>
                            <li class="sidebar-item <?php if($page=='overdue-report'){ echo 'active';} ?>">
                                <a href="overdue-report.php" class="sidebar-link">Overdue Report</a>
                            </li>
                            <li class="sidebar-item <?php if($page=='overdue-report'){ echo 'active';} ?>">
                                <a href="return-book-report.php" class="sidebar-link">Returned Books Report</a>
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
                        <ul class="navbar-nav" style="margin-right:10px;">                  
                        <li class="nav-item dropdown">
								<?php
                                     $res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
                                     while ($row = mysqli_fetch_array($res)){
                                         ?><a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0" style="color: inherit;"><img src="<?php echo $row["photo"]; ?>" alt=""class="avatar img-fluid rounded"> <span><?php echo $_SESSION["username"]; ?></span></a> <?php
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

    <script src="inc/js/bootstrap.bundle.min.js"></script>
    <script src="inc/js/custom1.js"></script>
    <script src="inc/js/custom.js"></script>
	<script src="inc/js/jquery-2.2.4.min.js"></script>
	<script src="inc/js/bootstrap.min.js"></script>
	<script src="inc/js/bootstrap-select.min.js"></script>
	<script src="inc/js/waypoints.min.js"></script>
	<script src="inc/js/jquery.counterup.min.js"></script>
	<script src="inc/js/datatables.min.js"></script>
	<script src="inc/js/datatables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>

    
</body>


</html>

