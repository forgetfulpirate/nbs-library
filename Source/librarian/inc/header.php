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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
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
                            All teacher information
                        </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='return-books'){ echo 'active';} ?>">
                        <a href="return-book.php" class="sidebar-link">
                        <i class="fa-solid fa-file-lines pe-2"></i>
                            Returned Books
                        </a>
                    </li>
                   
                   
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#manage" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Manage Book
                        </a>
                        <ul id="manage" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item <?php if($page=='abook'){ echo 'active';} ?>" >
                                <a href="add-book.php" class="sidebar-link">Add Book</a>
                            </li> -->
                            <!-- <li class="sidebar-item <?php if($page=='tbook'){ echo 'active';} ?>">
                                <a href="add-books.php" class="sidebar-link">Add Books</a>
                            </li> -->
                            <li class="sidebar-item <?php if($page=='e-book'){ echo 'active';} ?>">
                                <a href="add-ebook.php" class="sidebar-link">Add E-Book</a>
                            </li>

                            <li class="sidebar-item">
                                <a href="add-book-module.php" class="sidebar-link">Add Book Module</a>
                            </li>
                            <!-- <li class="sidebar-item">
                                <a href="display-books.php" class="sidebar-link">Display Book</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="display-ebook.php" class="sidebar-link">Display E-Book</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="display-thesis.php" class="sidebar-link">Display Theses</a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="dashboard.php" class="sidebar-link collapsed" data-bs-target="#issue" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-file-lines pe-2"></i>
                            Issue Book
                        </a>
                        <ul id="issue" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item <?php if($page=='sissue'){ echo 'active';} ?>">
                                <a href="student-issue-book.php" class="sidebar-link">Student issue book</a>
                            </li> -->
                            <li class="sidebar-item">
                                <a href="std-issue-book.php" class="sidebar-link">Student Issue Book</a>
                            </li>
                            <li class="sidebar-item <?php if($page=='tissue'){ echo 'active';} ?>">
                                <a href="tch-issue-book.php" class="sidebar-link">Teacher Issue Book</a>
                            </li>
                            <!-- <li class="sidebar-item <?php if($page=='tissue'){ echo 'active';} ?>">
                                <a href="teacher-issue-book.php" class="sidebar-link">Teacher issue book</a>
                            </li> -->
                        </ul>
                    </li>

                    

                    <li class="sidebar-item <?php if($page=='tbook'){ echo 'active';} ?>">
                        <a href="display-book.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>

                            Display Books
                        </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='d-ebook'){ echo 'active';} ?>">
                                <a href="display-ebook.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Display E-Book
                                </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='d-t-book'){ echo 'active';} ?>">
                                <a href="display-thesis.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Display Theses
                                </a>
                    </li>

                    <li class="sidebar-item <?php if($page=='manage-book'){ echo 'active';} ?>">
                        <a href="manage-book.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>
                            Display Book Catalogue
                        </a>
                    </li>

                    <!-- <li class="sidebar-item <?php if($page=='bmodule'){ echo 'active';} ?>">
                                <a href="display-book-module.php" class="sidebar-link">
                                <i class="fa-solid fa-book pe-2"></i>
                                    Display Book Module
                                </a>
                    </li> -->




                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#user" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-users pe-2"></i>
                            Manage User
                        </a>
                        <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item <?php if($page=='a-std'){ echo 'active';} ?>">
                                <a href="add-student.php" class="sidebar-link">Add student</a>
                            </li> -->
                            <li class="sidebar-item ">
                                <a href="add-std.php" class="sidebar-link">Add Student</a>
                            </li>
                            <li class="sidebar-item <?php if($page==''){ echo 'active';} ?>">
                                <a href="add-tch.php" class="sidebar-link">Add Teacher</a>
                            </li>
                            <!-- <li class="sidebar-item <?php if($page=='a-tch'){ echo 'active';} ?>">
                                <a href="add-teacher.php" class="sidebar-link">Add teacher</a>
                            </li> -->
                        </ul>
                    </li>
              
            
<!-- 
                    <li class="sidebar-item <?php if($page=='ibook'){ echo 'active';} ?>">
                        <a href="issued-books.php" class="sidebar-link">
                         <i class="fa-solid fa-book pe-2"></i>
                            Issued book
                        </a>
                    </li> -->

          

                 

                    <li class="sidebar-item <?php if($page=='a-book'){ echo 'active';} ?>">
                        <a href="display-book-opac.php" class="sidebar-link">
                        <i class="fa-solid fa-book pe-2"></i>
                            View Book Opac
                        </a>
                    </li>

                    

                    <li class="sidebar-item <?php if($page=='rbook'){ echo 'active';} ?>">
                        <a href="requested-books.php" class="sidebar-link">
                        <i class="fa-solid fa-book pe-2"></i>
                            View requested book
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#posts" data-bs-toggle="collapse"
                            aria-expanded="false">    <i class="fa-solid fa-message pe-2"></i>
                            Send message to user
                        </a>
                        <ul id="posts" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item  <?php if($page=='s-std'){ echo 'active';} ?>">
                                <a href="send-to-student.php" class="sidebar-link">Send to student</a>
                            </li>
                            <li class="sidebar-item  <?php if($page=='s-tch'){ echo 'active';} ?>">
                                <a href="send-to-teacher.php" class="sidebar-link">Send to teacher</a>
                            </li>
                        </ul>
                        
                    </li>

                 

                    
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#report" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-users pe-2"></i>
                            Generate Report
                        </a>
                        <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <!-- <li class="sidebar-item <?php if($page==''){ echo 'active';} ?>">
                                <a href="add-student.php" class="sidebar-link">Add student</a>
                            </li> -->
                            <li class="sidebar-item ">
                                <a href="generate-report-borrowed.php" class="sidebar-link">Borrowed Books Report</a>
                            </li>
                            <!-- <li class="sidebar-item <?php if($page==''){ echo 'active';} ?>">
                                <a href="add-tch.php" class="sidebar-link">Add Teacher</a>
                            </li> -->
                            <!-- <li class="sidebar-item <?php if($page=='a-tch'){ echo 'active';} ?>">
                                <a href="add-teacher.php" class="sidebar-link">Add teacher</a>
                            </li> -->
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
                        <li class="icon">
                                <a href="requested-books.php" ><i class="fas fa-bell"></i></a>
                                <span class="count" onclick="window.location='requested-books.php'"><b id="notif" ><?php echo $not; ?></b></span>
                        </li>
                        </ul>
                        
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
	<script src="inc/js/datatables.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>

    
</body>


</html>

