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
 ?>

<main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Returned Books
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
   
          
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table table-hover text-center table-striped" id="dtBasicExample">
                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Books Name</th>
                                                
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                       </thead>
                                       <tbody>
                                           <?php
                                                $res= mysqli_query($link, "select * from finezone");
                                                while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["first_name"]; echo "</td>";
                                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksname"]; echo "</td>";
                                                    echo "<td>"; echo $row["fine"]; echo "</td>";
													echo "<td>";
													?><a href="delete-fine.php?id=<?php echo $row["id"]; ?> " style="color: red"><i class="fas fa-trash"></i></a><?php
													echo "</td>";
                                                    echo "</tr>";
                                                }
                                             ?>
                                       </tbody>
                                
                            </table>
                        </div>
                    </div>
                    
                </div>
                
                </div>

                

                
                
            
            </main>

        

            </div>
            
    </div>
 

  <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
                buttons:['copy','csv','excel','pdf', 'print'],
                "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]]
            });
   
        });
    </script>