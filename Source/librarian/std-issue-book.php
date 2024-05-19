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
								<form action="" class="form-control" method="post" name="student_number">
                                <table class="table">
                                    <tr>
                                        <td class="">
                                        <select name="student_number" class="form-control">
                                            <?php 
                                            // Assuming $link is your database connection
                                            $res = mysqli_query($link, "SELECT student_number FROM student");
                                            if (mysqli_num_rows($res) > 0) {
                                                while ($row = mysqli_fetch_array($res)) {
                                                    // Check if the current option matches the selected value
                                                    $selected = ($row['student_number'] == $_POST['student_number']) ? 'selected' : '';
                                                    echo "<option value='" . $row['student_number'] . "' $selected>" . $row['student_number'] . "</option>";
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
                                       $res5 = mysqli_query($link, "select * from student where student_number='$_POST[student_number]' ");
                                       while($row5 = mysqli_fetch_array($res5)){   
                                           $student_number  = $row5['student_number'];                
										   $first_name  = $row5['first_name'];
                                           $last_name       = $row5['last_name'];
                                           $middle_name      = $row5['middle_name'];
                                           $email   = $row5['email'];
                                           $course     = $row5['course'];
                                           $year     = $row5['year'];
                                           $semester     = $row5['semester'];
                                           $user_type     = $row5['user_type'];
                                           $_SESSION["user_type"]     = $user_type;
                                           $_SESSION["student_number"]     = $student_number;
                                           $_SESSION["verified"] = $row5['verified']; // Add verified status to session
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
                                               <input type="text" class="form-control" name="student_number" value="<?php echo $student_number; ?>"  disabled> 
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
                                               <input type="text" class="form-control" name="course" value="<?php echo $course; ?>" readonly> 
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                               <input type="text" class="form-control" name="year"  value="<?php echo $year; ?>"  readonly> 
                                            </td>
                                        </tr>
                                         <tr>
                                            <td>
                                               <input type="text" class="form-control" name="semester"  value="<?php echo $semester; ?>"  readonly> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="accession_number" placeholder="Enter Accession ID" required>
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
                                                <?php
                                                // Check if the user is verified before allowing to issue the book
                                                if ($_SESSION["verified"] == 'yes') {
                                                    ?>
                                                    <input type="submit" name="submit2" class="btn btn-info" value="Issue Book">
                                                    <?php
                                                } else {
                                                    ?>
                                                        <div class="alert alert-warning col-lg-6 col-lg-push-3">
                                                            <strong style="">Account is deactivated</strong>
                                                        </div>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                  <?php
                                }
                              
                            ?>
                                </form>
                                <?php
                                if (isset($_POST["submit2"])) {
                                    $qty = 0;
                                    // Validate if the accession_number exists in the book_module table
                                    $accession_number = $_POST['accession_number'];
                                    $res = mysqli_query($link, "SELECT * FROM book_module WHERE accession_number='$accession_number'");
                                    if (mysqli_num_rows($res) == 0) {
                                        ?>
                                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                            <strong style="">Book ID is invalid.</strong>
                                        </div>
                                        <?php
                                        return;
                                    } else {
                                        while ($row = mysqli_fetch_array($res)) {
                                            $qty = $row["available"];
                                            $title_proper = $row["title_proper"];
                                        }
                                        if ($qty == 0) {
                                            ?>
                                            <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                                <strong style="">This book is not available.</strong>
                                            </div>
                                            <?php
                                        } else {
                                            mysqli_query($link, "INSERT INTO issue_book 
                                                    VALUES ('', '$_SESSION[user_type]', '$_SESSION[student_number]', '$_POST[first_name]', '$_POST[last_name]', '$_POST[middle_name]', '$_POST[course]', '', '$_POST[email]', '$title_proper', '$accession_number', '$_POST[booksissuedate]', '$_POST[booksreturndate]','')");
                                        
                                            mysqli_query($link, "update book_module set available=available-1 where accession_number='$accession_number'");
                                            ?>
                                            <br>
                                            <div class="alert alert-success col-lg-6 col-lg-push-3">
                                                <strong style="">Book issued successfully</strong>
                                            </div>
                                            <?php
                                        }
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

	