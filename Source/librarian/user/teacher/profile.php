<?php 
     session_start();
    if (!isset($_SESSION["teacher"])) {
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


<style>
    @media (min-width: 1280px) {
  .col-md-7 {
    flex: 0 0 auto;
    width: 58.33333333%;
  }
}
</style>
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
                                    $res1 = mysqli_query($link, "select * from teacher where id_number='".$_SESSION['teacher']."'");
                        
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
									<input type="submit" class="btn" value="Upload Image" name="submit" style="background-color:#d52033; color:white;">
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
                                                            mysqli_query($link, "UPDATE teacher SET photo='".$imagepath."' WHERE id_number='".$_SESSION['teacher']."'");
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
                                 
                                       $res6 = mysqli_query($link, "select * from teacher where id_number='$_SESSION[teacher]' ");
                                    
                                       while($row6 = mysqli_fetch_array($res6)){
                                        $id_number      = $row6['id_number'];
                                        $first_name  = $row6['first_name'];
                                        $last_name      = $row6['last_name'];
                                        $middle_name      = $row6['middle_name'];
                                        $email      = $row6['email'];
                                        $dept      = $row6['dept'];
                                        $status     = $row6['status'];
                                        $user_type     = $row6['user_type'];
                                    }
                                    ?>
                                <form method="post">
                                <div class="form-group details-control">
                                        <label for="user_type">User Type:</label>
                                         <input type="text" class="form-control custom"  name="user_type" value="<?php echo $user_type; ?>"  disabled />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="id_number" class="text-right">ID Number:</label>
                                        <input type="text" class="form-control custom"  name="id_number" value="<?php echo $id_number; ?>"  disabled/>
                                    </div>
                                    <div class="form-group details-control">
                                         <label for="first_name">First Name:</label>
                                        <input type="text" class="form-control custom"  name="first_name" value="<?php echo $first_name; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="last_name" class="text-right">Last Name:</label>
                                        <input type="text" class="form-control custom"  name="last_name" value="<?php echo $last_name; ?>" />
                                    </div>

                                    <div class="form-group details-control">
                                        <label for="middle_name" class="text-right">Middle Name:</label>
                                        <input type="text" class="form-control custom"  name="middle_name" value="<?php echo $middle_name; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="email" class="text-right">Email:</label>
                                        <input type="text" class="form-control custom"  name="email" value="<?php echo $email; ?>" />
                                    </div>
                                    <div class="form-group details-control">
                                        <label for="dept" class="text-right">Dept:</label>
                                        <select class="form-control" name="dept" required>
                                            <option></option>
                                            <option <?php if ($dept == 'BSCS') echo 'selected'; ?>>BSCS</option>
                                            <option <?php if ($dept == 'BSA') echo 'selected'; ?>>BSA</option>
                                            <option <?php if ($dept == 'BSAIS') echo 'selected'; ?>>BSAIS</option>
                                            <option <?php if ($dept == 'BSEntrep') echo 'selected'; ?>>BSEntrep</option>
                                            <option <?php if ($dept == 'BSTM') echo 'selected'; ?>>BSTM</option>
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
                            <BR>
                            <?php
                              if (isset($_POST["update"])) {
                                if (mysqli_query($link, "update teacher set first_name='$_POST[first_name]', middle_name='$_POST[middle_name]' , last_name='$_POST[last_name]' , email='$_POST[email]' , dept='$_POST[dept]' where id_number='$_SESSION[teacher]'")) {
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