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
 ?>
<main class="content px-3 py-2">  
			<div class="container">
                <br>
			<div class="mb-3">
          
                        <h4 class="text-center">Change Password
                        </h4>
                           
             
                 </div>
				<div class="row">
					<div class="col-md-12">
						<form action="" class="pass-content" method="post">
						
							<b>Current Password:</b>
							<input type="password" class="form-control mt-10" name="cpassword" placeholder="Current password" required>
							<br>
							<b>New Password:</b>
							<input type="password" class="form-control mt-10" name="npassword" placeholder="New password" required>
							<br>
							<b>Confirm Password:</b>
							<input type="password" class="form-control mt-10" name="conpass" placeholder="ConfIrm password" required>
							<br>
							<input type="submit" name="submit" class="btn" value="Change Password" style="background-color:#d52033; color:white;">
						</form>
						<br>
						  <?php
							if (isset($_POST["submit"])){
							
								$cpass    = $_POST['cpassword'];
								$npass    = $_POST['npassword'];
								$conpass  = $_POST['conpass'];
								$res = mysqli_query($link, "select password from student where student_number='$_SESSION[student]'");								
								while($row = mysqli_fetch_array($res)){
                                    $pass   = $row['password'];
								}
								if($cpass != $pass){
									?>
										<div class="alert alert-warning">
											<strong style="color:#333">Invalid!</strong> <span style="color: red;font-weight: bold; ">You entered wrong password</span>
										</div>
									<?php
								}else{
									if($npass == $conpass){
									mysqli_query($link, "update student set password='$npass' where student_number='$_SESSION[student]'");
									
									 ?>
										<div class="alert alert-success">
											<strong style="color:#333">Success!</strong> <span style="color: green;font-weight: bold; ">Your password is changed.</span>
										</div>
									<?php
									}else{
									?>
										<div class="alert alert-warning">
											<strong style="color:#333">Not match!</strong> <span style="color: red;font-weight: bold; ">Your password</span>
										</div>
									<?php
									}			
								}								
							}
						?>

					</div>
				</div>
			</div>					
</main>
	
	<?php 
		include 'inc/footer.php';
	 ?>