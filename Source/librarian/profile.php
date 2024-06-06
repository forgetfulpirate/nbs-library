<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'profile';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->
    <main class="content px-3 py-2">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>Profile</p>
						</div>
					</div>
					
				</div>
				<div class="profile-content">
					<div class="row">
						<div class="col-md-3">
							<div class="photo">
								<?php
                                    $res = mysqli_query($link, "select * from lib_registration where username='".$_SESSION['username']."'");
                                    while ($row = mysqli_fetch_array($res)){
                                        ?><img src="<?php echo $row["photo"]; ?> " height="250px" width="250px" alt="something wrong"></a> <?php
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
							</div>
                            <?php 
                                if (isset($_POST["submit"])) {
                                    $image_name=$_FILES['image']['name'];
                                    $temp = explode(".", $image_name);
                                    $newfilename = round(microtime(true)) . '.' . end($temp);
                                    $imagepath="upload/".$newfilename;
                                    move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
                                    mysqli_query($link, "update lib_registration set photo='".$imagepath."' where username='".$_SESSION['username']."'");
                                    
                                    ?>
                                        <script type="text/javascript">
                                            window.location="profile.php";
                                        </script>
                                    <?php
                                }
                            ?>
						</div>
						<div class="col-md-7 ml-30">
							<div class="details">
								<?php
                                   $res5 = mysqli_query($link, "select * from lib_registration where username='$_SESSION[username]' ");
                                   while($row5 = mysqli_fetch_array($res5)){
                                       $name      = $row5['name'];
                                       $username  = $row5['username'];
                                       $email     = $row5['email'];
                                       $phone     = $row5['phone'];
                                       $address     = $row5['address'];
                                   }
                                   ?>
                                <form method="post">
                                 
                                    <div class="form-group">
                                         <label for="username">Username:</label>
                                        <input type="text" class="form-control custom" placeholder="Username" name="username" value="<?php echo $username; ?>" disabled />
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="text-right">Name:</label>
                                        <input type="text" class="form-control custom"  name="name" value="<?php echo $name; ?>" />
                                    </div>
                                    <div class="form-group">
                                         <label for="email">Email:</label>
                                        <input type="text" class="form-control custom"  name="email" value="<?php echo $email; ?>"  />
                                    </div>
                                    <div class="form-group">
                                         <label for="phone">Phone No:</label>
                                        <input type="text" class="form-control custom"  name="phone" value="<?php echo $phone; ?>" />
                                    </div> 
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                         <input type="text" class="form-control custom"  name="address" value="<?php echo $address; ?>" />
                                    </div>
                                    <br>
                                    <div class="text-right mt-20">
                                        <input type="submit" value="Save" class="btn" name="update" style="background-color:#d52033; color:white;">
                                    </div>
                                <?php

                                ?>
                                </form>
			                </div> 
                            <?php
                               if (isset($_POST["update"])){
                                   mysqli_query($link, "update lib_registration set 
                                   name='$_POST[name]',
                                   email='$_POST[email]',
                                   phone='$_POST[phone]',
                                   address='$_POST[address]' 
                                   where username='$_SESSION[username]'");

                                    ?>
                                        <script type="text/javascript">
                                           alert('Successfully Updated');
                                            window.location="profile.php"
                                        </script>
                                    <?php
                              }
                            ?>
		                </div>    
					</div>
				</div>
			</div>					
		</div>            
    </main>
	<?php 
		include 'inc/footer.php';
	 ?>