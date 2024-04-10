<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }

    include 'inc/header.php';
    include 'inc/connection.php';
    $rdate = date("m-d-Y", strtotime("+30 days"));
 ?>
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>dashboard</span>Control panel</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="right text-right">
							<a href="dashboard.php"><i class="fas fa-home"></i>home</a>
							<span class="disabled">student issue book</span>
						</div>
					</div>
				</div>
				<div class="issueBook">
					<div class="row">
						<div class="col-md-6">
							<div class="issue-wrapper">
								<form action="" class="form-control" method="post" name="id_number">
                                <table class="table">
                                    <tr>
                                        <td class="">
                                            <select name="id_number" class="form-control">
                                                <?php 
                                                // Assuming $link is your database connection
                                                $res = mysqli_query($link, "SELECT id_number FROM teacher");
                                                if (mysqli_num_rows($res) > 0) {
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        echo "<option value='" . $row['id_number'] . "'>" . $row['id_number'] . "</option>";
                                                    }
                                                } else {
                                                    echo "<option value=''>No student number registered</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-info" value="select" name="submit1">
                                        </td>
                                    </tr>
                                </table>

                                    <?php 
                                    if (isset($_POST["submit1"])) {
                                       $res5 = mysqli_query($link, "select * from teacher where id_number='$_POST[id_number]' ");
                                       while($row5 = mysqli_fetch_array($res5)){   
                                           $id_number  = $row5['id_number'];                
										   $first_name  = $row5['first_name'];
                                           $last_name       = $row5['last_name'];
                                           $middle_name      = $row5['middle_name'];
                                           $email   = $row5['email'];
                                           $dept     = $row5['dept'];
                                           $user_type     = $row5['user_type'];
                                           $_SESSION["user_type"]     = $user_type;
                                           $_SESSION["id_number"]     = $id_number;
                                       }
                                    ?>
									<table class="table table-bordered">
                                         <tr>
                                            <td>
                                               <input type="text" class="form-control" name="user_type" value="<?php echo $user_type; ?>" disabled> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="id_number" value="<?php echo $id_number; ?>"  disabled> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" readonly> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>" readonly> 
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>" readonly> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="middle_name" value="<?php echo $middle_name; ?>" readonly> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="text" class="form-control" name="dept" value="<?php echo $dept; ?>" readonly> 
                                            </td>
                                        </tr>
                                      
                                        <tr>
                                            <td>
                                                <select name="title_of_book" class="form-control">
                                                    <?php 
                                                            $res= mysqli_query($link, "select title_of_book from book");
                                                            while($row=mysqli_fetch_array($res)){
                                                                echo "<option>";
                                                                echo $row["title_of_book"]; 
                                                                echo "</option>";
                                                            }
                                                        ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                               <input type="date" class="form-control" name="booksissuedate"  value="<?php echo date("Y-m-d"); ?>" readonly> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <input type="date" class="form-control" name="booksreturndate" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                                            </td>
                                        </tr>
                                      
                                        <tr>
                                            <td>
                                               <input type="submit" name="submit2" class="btn btn-info" value="Issue Book"> 
                                            </td>
                                        </tr>
                                    </table>
                                  <?php
                                }
                              
                            ?>
                                </form>
                                <?php
                                    if (isset($_POST["submit2"])) {
                                      $qty=0;
                                      $res= mysqli_query($link, "select * from book where title_of_book='$_POST[title_of_book]' ");
                                       while($row = mysqli_fetch_array($res)){
                                          $qty= $row["books_availability"];
                                       }
                                       if ($qty==0) {
                                          ?>
                                            <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                            <strong style="">This book is not available.</strong>
                                            </div>
                                          <?php  
                                       }
                                       else{
                                        mysqli_query($link, "INSERT INTO issue_book 
                                        VALUES ('', '$_SESSION[user_type]', '$_SESSION[id_number]', '$_POST[first_name]', '$_POST[last_name]', '$_POST[middle_name]', '$_POST[dept]', '', '$_POST[email]', '$_POST[title_of_book]', '$_POST[booksissuedate]', '$_POST[booksreturndate]','')");
                   
                                          mysqli_query($link, "update book set books_availability=books_availability-1 where title_of_book='$_POST[title_of_book]'");
                                          ?>
                                           <br>
                                            <div class="alert alert-success col-lg-6 col-lg-push-3">
                                            <strong style="">Book issued successfully</strong>
                                            </div>
                                          <?php  
                                        }
                                    }
                                 ?>
							</div>
                            
						</div>

                        
                        
					</div>
				</div>
			</div>	
            				
		</div>
        
	</div>

    <?php 
		include 'inc/footer.php';
	 ?>

	