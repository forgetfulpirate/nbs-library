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
    include 'inc/sfunction.php';
 ?>
 <main class="content px-3 py-2">
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
                            <a href="add-teacher.php"><i class="fas fa-user"></i>add teacher</a>
							<span class="disabled">add student</span>
						</div>
					</div>
				</div>
				<div class="addUser">
					<div class="gap-40"></div>
					<div class="reg-body user-content">
                        <?php if(isset($s_msg)):?>
                            <span class="success" style="color:green"> <?php echo $s_msg; ?></span>
                        <?php endif ?>
                        <?php if(isset($error_m)):?>
                            <span class="error"> <?php echo $error_m; ?></span>
                        <?php endif ?>
                        <h4 style="text-align: center; margin-bottom: 25px;">Student registration form</h4>
                        <form action="" class="form-inline" method="post">

                            <div class="form-group">
                                <label for="student_number" class="text-right">Student Number <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Student Number" name="student_number" required=""/>
                            </div>
                            <?php if(isset($error_uname)):?>
                                <span class="error"> <?php echo $error_uname; ?></span>
                            <?php endif ?>

                           

                            <div class="form-group">
                                <label for="first_name" class="text-right">First name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="First name" name="first_name" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="text-right">Last name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Last name" name="last_name" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="middle_name" class="text-right">Middle name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Middle name" name="middle_name"/>
                            </div>
  
                     
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" class="form-control custom" placeholder="Password" name="password" required=""/>
                            </div>
                            <?php if(isset($error_ua)):?>
                                <span class="error" style="color:red"> <?php echo $error_ua; ?></span>
                            <?php endif ?>

                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Email" name="email" required=""/>
                            </div>
                            <?php if(isset($e_msg)):?>
                                <span class="error"><?php echo $e_msg; ?> </span>
                            <?php endif ?>
                            <?php if(isset($error_email)):?>
                                <span class="error" style="color:red"><?php echo $error_email; ?> </span>
                            <?php endif ?>

                            <div class="form-group">
                                <label for="year">Year <span>*</span></label>
                                <select class="form-control custom" name="year" required="">
                                    <option>1st year</option>
                                    <option>2nd year</option>
                                    <option>3rd year</option>
                                    <option>4th year</option>
                            
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="semester">Select Semester <span>*</span></label>
                                <select class="form-control custom" name="semester" required="">
                                    <option>1st</option>
                                    <option>2nd</option>
                                    <option>3rd</option>
                                    <option>4th</option>
                                    <option>5th</option>
                                    <option>6th</option>
                                    <option>7th</option>
                                    <option>8th</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="course">Course <span>*</span></label>
                                <select class="form-control custom" name="course" required="">
                                    <option>BSCS</option>
                                    <option>BSA</option>
                                    <option>BSTM</option>
                                    <option>BSAIS</option>
                                </select>
                            </div>

                       
                   
                         
                            <div class="submit">
                                <input type="submit" value="Add Student" name="submit" class="btn change text-center">
                            </div>
                        </form>

					</div>
				</div>
				
			</div>					
		</div>
	</div>

    </main>			


<?php 
    include 'inc/footer.php';
 ?>

 
