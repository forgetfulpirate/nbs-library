<?php 
     session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'ibook';
    include 'inc/header.php';
    include 'inc/connection.php';

      // Initialize a variable to track if the student has a fine greater than zero
     // Fetch fine information
     $res1 = mysqli_query($link, "SELECT * FROM finezone WHERE student_number='".$_SESSION['student']."' ORDER BY id DESC");

     // Check if the user has any fine with status "paid"
     $hasUnpaidFine = false;
     while ($row = mysqli_fetch_array($res1)) {
         if ($row["fine"] > 0 && $row["status"] == "no") {
             $hasUnpaidFine = true;
             break;
         }
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
							<span class="disabled">my issued books</span>
						</div>
					</div>
				</div>
			</div>	
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="st-issuedBook">
							<table id="dtBasicExample" class="table table-dark table-striped text-center">
								<thead>
								   <tr>
                                        <th>Student number</th>
                                        <th>Name</th>
										<th>Accession Number</th>
                                        <th>Books Name</th>
                                        <th>Issued Date</th>
                                        <th>Date due</th>
                                        <th>Date Returned</th>
                                        <th>Fine</th>
								   </tr>
								</thead>
                                <tbody>
						
                                <?php 
                                    // Display fine records
                                    $res1 = mysqli_query($link, "SELECT * FROM finezone WHERE student_number='".$_SESSION['student']."' ORDER BY id DESC");
                                    while ($row = mysqli_fetch_array($res1)) {
                                        if ($row["fine"] > 0 && $row["status"] == "no") {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["student_number"]; echo "</td>";
                                            echo "<td>"; echo $row["first_name"] . ' ' . $row["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                            echo "<td>"; echo $row["booksname"]; echo "</td>";
                                            echo "<td>"; echo $row["date_issued"]; echo "</td>";
                                            echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                                            echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                            echo "<td>"; echo $row["fine"]; echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
							  </tbody>
							</table>
						</div>		
					</div>
				</div>
			</div>
									
			
		</div>

		
	</div>

	

	
	<?php 
		include 'inc/footer.php';
	 ?>
    <script>
        $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>