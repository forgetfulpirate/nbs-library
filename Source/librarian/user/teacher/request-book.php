<?php 
     session_start();
    if (!isset($_SESSION["teacher"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'rbook';
    include 'inc/header.php';
    include 'inc/connection.php';
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
							<span class="disabled">request book</span>
						</div>
					</div>
				</div>
				<div class="st-issuedBook">
                    <?php
						
                       $res5 = mysqli_query($link, "select * from t_registration where username='$_SESSION[teacher]' ");
                       while($row5 = mysqli_fetch_array($res5)){
                           $name      = $row5['name'];                    
                           $regno  = $row5['username'];
                           $email     = $row5['email'];
                           $phone     = $row5['phone']; 
                           $utype     = $row5['utype'];
                       }

                       $res6 = mysqli_query($link, "select * from teacher where id_number='$_SESSION[teacher]' ");
                       while($row5 = mysqli_fetch_array($res6)){
                           $name      = $row5['first_name'];                    
                           $username  = $row5['last_name'];
                           $email     = $row5['email'];
                           $utype     = $row5['user_type'];
                       }
                    ?>
					<form action="" method="post" class="issue-content">
						<table class="table table-bordered table-striped">
						<?php 
							
							if (isset($_POST["submit"])) {
								$bname = $_POST['bname'];
								$burl = $_POST['burl'];
								if ($bname == "" | $burl =="" ) {
									echo "<span style='color: red;'><b>Error !</b> Feild mustn't be empty</span>";
								}else{
									$sql = mysqli_query($link, "insert into request_books values('','$name','$username','$email','$utype','$bname','$burl','no') ");
									if($sql){
										echo "<span style='color: green;'><b>Success !</b> Books request send successfully.</span>";
									}
								}
								
							}
						?>
							<tr>
                                <td>
                                  <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="text" class="form-control bdr" name="bname" value="" placeholder="Request book name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="form-control" value="student" name="<?php echo $utype; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                  <input type="text" class="form-control bdr" name="burl" value="" placeholder="Books url">
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="submit" value="Send Request" class="btn">
					</form>
                     
				</div>
			</div>					
		</div>
	</div>
	<?php 
		include 'inc/footer.php';
	 ?>