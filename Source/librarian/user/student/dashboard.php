<?php 
     session_start();
    if(!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page ='home';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>

<main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Borrowed Books
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>
          
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table table-hover text-center table-striped" id="dtBasicExample">
                            <thead>
                                            <tr>
												<th>Student Number</th>
												<th>Name</th>
												<th>Books Name</th>
												<th>Books Issue Date</th>
												<th>Books Return Date</th>
                                            </tr>
                                       </thead>
                                        <tbody>
										<?php 
											$res= mysqli_query($link, "select * from issue_book where student_number='".$_SESSION['student']."' ORDER BY id DESC");
											
											while ($row=mysqli_fetch_array($res)) {
												echo "<tr>";
												echo "<td>"; echo $row["student_number"]; echo "</td>";
												echo "<td>"; echo $row["name"]; echo "</td>";
												echo "<td>"; echo $row["booksname"]; echo "</td>";
												echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
												echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
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
    