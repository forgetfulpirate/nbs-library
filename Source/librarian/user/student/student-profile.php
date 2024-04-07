<?php 
     session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    include 'inc/header.php';
    include 'inc/connection.php';

    function showAlert($message, $type = 'success')
{
    echo "<div class='alert alert-$type fade show' role='alert'>
            $message
           
        </div>";
}
 ?>
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>dashboard</span>User panel</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="right text-right">
							<a href="dashboard.php"><i class="fas fa-home"></i>home</a>
							<span class="disabled">profile</span>
						</div>
					</div>
				</div>
				<div class="profile-content">
					<div class="row">
						<div class="col-md-3">
							<div class="photo">
								<?php
                                    $res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");
                        
                                    while ($row = mysqli_fetch_array($res1)){
                                        ?><img src="<?php echo $row["photo"]; ?> " height="300px" width="250px" alt="something wrong"></a> <?php
                                    }                                                          

                                ?>
							</div>
							<div class="uploadPhoto">
								<div class="gap-30"></div>
								<form action="" method="post" enctype="multipart/form-data">
									<input type="file" name="image" class="modal-mt" id="image">
									<div class="gap-30"></div>
									<input type="submit" class="modal-mt btn btn-info" value="Upload Image" name="submit">
								</form>
							</div>
                            <?php 
                                if (isset($_POST["submit"])) {
                                    $image_name=$_FILES['image']['name'];
                                    $temp = explode(".", $image_name);
                                    $newfilename = round(microtime(true)) . '.' . end($temp);
                                    $imagepath="upload/".$newfilename;
                                    move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
                                    mysqli_query($link, "update student set photo='".$imagepath."' where student_number='".$_SESSION['student']."'");
                                    ?>
                                        <script type="text/javascript">
                                            window.location="student-profile.php";
                                        </script>
                                    <?php
                                }
                            ?>
						</div>
						<div class="col-md-9">
							<div class="details">
                                <?php
                                 
                                       $res6 = mysqli_query($link, "select * from student where student_number='$_SESSION[student]' ");
                                    
                                       while($row6 = mysqli_fetch_array($res6)){
                                        $student_number      = $row6['student_number'];
                                        $first_name  = $row6['first_name'];
                                        $last_name      = $row6['last_name'];
                                        $middle_name      = $row6['middle_name'];
                                        $email      = $row6['email'];
                                        $course      = $row6['course'];
                                        $year     = $row6['year'];
                                        $semester     = $row6['semester']; 
                                        $address     = $row6['status'];
                                        $user_type     = $row6['user_type'];
                                    }
                                    ?>
                                <form method="post">
                                    <div class="form-group details-control">
                                        <label for="student_number" class="text-right">Student Number:</label>
                                        <input type="text" class="form-control custom"  name="student_number" value="<?php echo $student_number; ?>" readonly />
                                    </div>
                                    <div class="form-group details-control">
                                         <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control custom"  name="first_name" value="<?php echo $first_name; ?>" readonly />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="last_name" class="text-right">Last Name:</label>
                                        <input type="text" class="form-control custom"  name="last_name" value="<?php echo $last_name; ?>" readonly/>
                                    </div>

                                    <div class="form-group details-control">
                                        <label for="middle_name" class="text-right">Middle Name:</label>
                                        <input type="text" class="form-control custom"  name="middle_name" value="<?php echo $middle_name; ?>" readonly/>
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="email" class="text-right">Email:</label>
                                        <input type="text" class="form-control custom"  name="email" value="<?php echo $email; ?>" readonly/>
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="course" class="text-right">Course:</label>
                                        <input type="text" class="form-control custom"  name="course" value="<?php echo $course; ?>" readonly/>
                                    </div>

                                    <div class="form-group details-control">
                                         <label for="year">Year:</label>
                                        <input type="text" class="form-control custom"  name="year" value="<?php echo $year; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                         <label for="semester">Semester:</label>
                                        <input type="text" class="form-control custom"  name="semester" value="<?php echo $semester; ?>" />
                                    </div>			                    
                            
                                    <div class="form-group details-control">
                                        <label for="user_type">User Type:</label>
                                         <input type="text" class="form-control custom"  name="user_type" value="<?php echo $user_type; ?>"  readonly />
                                    </div>
                                    <br>
                                    <div class="text-right mt-20">
                                        <input type="submit" value="Save" class="btn btn-info" name="update">
                                    </div>
                                <?php
                                ?>
                                </form>
			                </div> 
                            <BR>
                            <?php
                              if (isset($_POST["update"])) {
                                if (mysqli_query($link, "update student set year='$_POST[year]', semester='$_POST[semester]' where student_number='$_SESSION[student]'")) {
                                    showAlert("Profile updated successfully!", "success");
                        
                                    
                                } else {
                                    showAlert("Error updating profile!", "danger");
                                }
                            }
                            
                            ?>
                
		                </div>    
					</div>
				</div>
			</div>					
		</div>
	</div>
	<?php 
		include 'inc/footer.php';
	 ?>