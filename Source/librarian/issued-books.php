<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'ibook';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->

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
                                                <th>Accession Number</th>
                                                <th>Books Name</th>
                                                <th>Date Issued</th>
                                                <th>Date Due</th>
                                                <th>User Type</th>
                                                <th>Name</th>
                                                <th>ID Number</th>
                                                <th>Email</th>
                                                <th>Return Book</th>
                                            </tr>
                                       </thead>
                                        <tbody>
                                            <?php 
                                                $res= mysqli_query($link, "select * from issue_book");
                                                $res2= mysqli_query($link, "select * from t_issuebook");
                                                 while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksname"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["name"]; echo " "; echo $row["last_name"]; echo "</td>";
                                                    echo "<td>"; echo $row["student_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                
                                                    echo "<td>";
                                              
                                                   ?>
                                                         <div class="d-flex justify-content-center">
                                                            <a href="return.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to return this book?')"  style="margin-right: 10px"><span>Return</span></a>
                                                            <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this row?')"><span>Cancel</span></a>
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
                                                        <ul>
                                                            <li><a style="color: green;" href="return.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('are you sure you want to return this book?')"><i class="fas fa-undo-alt"></i></a></li>
                                                            <li><a style="color: red;" href="delete.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Are you sure you want to cancel this issue book?')"><i class="fas fa-trash"></i></a></li>
                                                        </ul> 
                                                        </ul> 
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
    