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
<main class="content px-3 py-2">  
			<div class="container">
                <br>
			<div class="mb-3">
          
                        <h4 class="text-center">Profile
                        </h4>
                           
             
                 </div>
				<div class="profile-content">
					<div class="row">
						<div class="col-md-3">
							<div class="photo">
								<?php
                                    $res = mysqli_query($link, "select * from std_registration where username='".$_SESSION['student']."'");
                                    $res1 = mysqli_query($link, "select * from student where student_number='".$_SESSION['student']."'");
                           
                                    while ($row = mysqli_fetch_array($res1)){
                                        ?><img src="<?php echo $row["photo"]; ?> " height="300px" width="250px" alt="something wrong"></a> <?php
                                    }                                                          

                                ?>
							</div>
							<div class="uploadPhoto">
								<div class="gap-30"></div>
								<form action="" method="post" enctype="multipart/form-data">
									<input type="file" name="image" class="modal-mt" id="image" required>
									<div class="gap-30"></div>
									<input type="submit" class="modal-mt btn" value="Upload Image" name="submit" style="background-color:#d52033; color:white;">
								</form>
                                <br>
							</div>
                            <?php 
                                if (isset($_POST["submit"])) {
                                    // Error handling for file upload
                                    $errors = [];
                                    $allowedExtensions = ['jpg', 'jpeg', 'png'];
                                    $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                                    $fileSize = $_FILES['image']['size'];
                                    $maxFileSize = 2 * 1024 * 1024; // 2MB

                                    if (!in_array($fileExtension, $allowedExtensions)) {
                                        $errors[] = "Invalid file type. Only JPG, JPEG, and, PNG files are allowed.";
                                    }

                                    if ($fileSize > $maxFileSize) {
                                        $errors[] = "File size exceeds the maximum limit of 2MB.";
                                    }

                                    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
                                        $errors[] = "File upload error. Please try again.";
                                    }

                                    if (empty($errors)) {
                                        $image_name = $_FILES['image']['name'];
                                        $temp = explode(".", $image_name);
                                        $newfilename = round(microtime(true)) . '.' . end($temp);
                                        $imagepath = "upload/" . $newfilename;
                                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath)) {
                                            mysqli_query($link, "UPDATE student SET photo='".$imagepath."' WHERE student_number='".$_SESSION['student']."'");
                                            ?>
                                            <script type="text/javascript">
                                                window.location="profile.php";
                                            </script>
                                            <?php
                                        } else {
                                            showAlert("Failed to move uploaded file.", "danger");
                                        }
                                    } else {
                                        foreach ($errors as $error) {
                                            showAlert($error, "danger");
                                        }
                                    }
                                }
    
                            ?>
						</div>
						<div class="col-md-7">
							<div class="details">
                                <?php
                                  
                                       $res6 = mysqli_query($link, "select * from student where student_number='$_SESSION[student]' ");
                                     
                                       while($row6 = mysqli_fetch_array($res6)){
                                        $student_number      = $row6['student_number'];
                                        $first_name  = $row6['first_name'];
                                        $last_name      = $row6['last_name'];
                                        $middle_name      = $row6['middle_name'];
                                        $email      = $row6['email'];
                                        $year      = $row6['year'];
                                        $course = $row6['course'];
                                        $user_type     = $row6['user_type'];
                                        }
                                    ?>
                                <form method="post">
                                      <div class="form-group details-control">
                                        <label for="utype">User Type:</label>
                                         <input type="text" class="form-control custom"  name="utype" value="<?php echo $user_type; ?>"  disabled="" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="regno" class="text-right">Student Number:</label>
                                        <input type="text" class="form-control custom"  name="regno" value="<?php echo $student_number; ?>" disabled />
                                    </div>
                                    <div class="form-group details-control">
                                         <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control custom"  name="first_name" value="<?php echo $first_name; ?>"  />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="name" class="text-right">Last Name:</label>
                                        <input type="text" class="form-control custom"  name="name" value="<?php echo $last_name; ?>" />
                                    </div>

                                    <div class="form-group details-control">
                                        <label for="sem" class="text-right">Middle Name:</label>
                                        <input type="text" class="form-control custom"  name="sem" value="<?php echo $middle_name; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="session" class="text-right">Email:</label>
                                        <input type="text" class="form-control custom"  name="session" value="<?php echo $email; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="year" class="text-right">Year Level:</label>
                                        <input type="text" class="form-control custom"  name="year" value="<?php echo $year; ?>" />
                                        
                                    </div>

                                    <div class="form-group details-control">
                                    <label for="course">Course <span>*</span></label>
                                <select class="form-control" name="course" required>
                                    <option></option>
                                    <option <?php if ($course == 'Bachelor of Science in Computer Science') echo 'selected'; ?>>Bachelor of Science in Computer Science</option>
                                    <option <?php if ($course == 'Bachelor of Science in Accountancy') echo 'selected'; ?>>Bachelor of Science in Accountancy</option>
                                    <option <?php if ($course == 'Bachelor of Science in Tourism Management') echo 'selected'; ?>>Bachelor of Science in Tourism Management</option>
                                    <option <?php if ($course == 'Bachelor of Science in Entrepreneurship') echo 'selected'; ?>>Bachelor of Science in Entrepreneurship</option>
                                    <option <?php if ($course == 'Bachelor of Science in Applied Information Systems') echo 'selected'; ?>>Bachelor of Science in Applied Information Systems</option>
                                </select>
                                        
                                    </div>

                          
                    
                                  
                                    <br>
                                    <div class="text-right mt-20">
                                        <input type="submit" value="Save" class="btn" name="update" style="background-color:#d52033; color:white;">
                                    </div>
                                <?php
                                ?>
                                </form>
			                </div>  
                                    <br>
                          

                          <?php
                              if (isset($_POST["update"])) {
                                if (mysqli_query($link, "UPDATE student SET 
                                first_name='" . $_POST['first_name'] . "',
                                last_name='" . $_POST['name'] . "',
                                middle_name='" . $_POST['sem'] . "',
                                email='" . $_POST['session'] . "',
                                year='" . $_POST['year'] . "',
                                course='" . $_POST['course'] . "'
                                WHERE student_number='" . $_SESSION['student'] . "'")) {
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
                        </main>
        
	<?php 
		include 'inc/footer.php';
	 ?>