<?php 
     session_start();
    if(!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page ='return-book';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>

<main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Borrowed Book History
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>
          
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table table-hover text-left table-striped" id="dtBasicExample">
                            <thead>
                                            <tr>
												<th>Student Number</th>
												<th>Name</th>
                                                <th>Accession No</th>
												<th>Books Name</th>
												<th>Issue Date</th>
                                                <th>Date Due</th>
												<th>Return Date</th>
                                                <th>Issued By</th>
                       
                                            </tr>
                                       </thead>
                                        <tbody>
										<?php 
											$res= mysqli_query($link, "select * from return_history where student_number='".$_SESSION['student']."' ORDER BY id DESC");
											
											while ($row=mysqli_fetch_array($res)) {
												echo "<tr>";
												echo "<td>"; echo $row["student_number"]; echo "</td>";
												echo "<td>"; echo $row["first_name"]; echo "</td>";
                                                echo "<td>"; echo $row["accession_number"]; echo "</td>";
												echo "<td>"; echo $row["booksname"]; echo "</td>";
												echo "<td>"; echo $row["date_issued"]; echo "</td>";
                                                echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
												echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                                echo "<td>"; echo $row["issuedby"]; echo "</td>";
                                                
												echo "</tr>";
											}
										?>
                                        </tbody>
                                
                            </table>
                        </div>
                    </div>
            
            </main>
     <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>

<?php 
		include 'inc/footer.php';
	 ?>
    