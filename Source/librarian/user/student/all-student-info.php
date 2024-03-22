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
							<span class="disabled">all student info</span>
						</div>
					</div>
				</div>
				<div class="student-wrapper">
					<div class="row">
						<div class="col-md-12">
							<div class="std-info">
								<table class="table  table-striped table-dark text-center">
									<thead>
										<tr>
											<th>Reg No</th>
											<th>Name</th>
											<th>Username</th>
											<th>Semester</th>
											<th>Dept</th>
											<th>Session</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Address</th>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
								</table>
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