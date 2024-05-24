<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'return-books';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->

	    <!-- Display Success or Error Messages -->

    <main class="content px-3 py-2">

	<?php
    if (!empty($_SESSION['success_message'])) {
        echo '<div class="alert alert-success" role="alert" id="success_message">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    if (!empty($_SESSION['success_msg'])) {
        echo '<div class="alert alert-success" role="alert" id="success_msg">' . $_SESSION['success_msg'] . '</div>';
        unset($_SESSION['success_msg']);
    }
    if (isset($_SESSION['error_msg'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_msg'] . '</div>';
        unset($_SESSION['error_msg']);
    }
    ?>

            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Returned Books
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
											<th>ID Number</th>
											<th>Name</th>
											<th>User Type</th>
											<th>Email</th>
											<th>Accession Number</th>
											<th>Books Name</th>
											<th>Date Issued</th>
											<th>Date Due</th>
											<th>Date Returned</th>
						
											<th>Action</th>
                                            </tr>
                                       </thead>
                                        <tbody>
                                            <?php 
                                                $res= mysqli_query($link, "select * from return_books");
                                                $res2= mysqli_query($link, "select * from t_issuebook");
                                                 while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row["student_number"] . "</td>";
													echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
													echo "<td>" . $row["utype"] . "</td>";
													echo "<td>" . $row["email"] . "</td>";
													echo "<td>" . $row["accession_number"] . "</td>";
													echo "<td>" . $row["booksname"] . "</td>";
													echo "<td>" . $row["date_issued"] . "</td>";
													echo "<td>" . $row["booksissuedate"] . "</td>";
													echo "<td>" . $row["booksreturndate"] . "</td>";
                            
                                                    echo "<td>";
                                              
                                                   ?>
                                                         <div class="d-flex justify-content-center">
                                                            <a href="delete-return-book.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this row?')"><span>Delete</span></a>
                                                        </div>
                                                    <?php 
                                                    echo "</td>";
                                                    echo "</tr>";
                                               
                                                   
                                                }
                                                while ($row=mysqli_fetch_array($res2)) {
                                                    echo "<tr>";
                                            
                                                    echo "<td>"; echo $row["booksname"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["name"]; echo "</td>";
                                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                  
                                                    echo "<td>";
                                              
                                                   ?>
                                                         <div class="d-flex justify-content-center">
                                                            <a href="delete-return-book.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this row?')"><span>Delete</span></a>
                                                        </div>
                                                    <?php 
                                                    echo "</td>";
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
    