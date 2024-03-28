
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'sinfo';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>

    
            <main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Student Information  
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
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Dept</th>
                                        <th scope="col">Session</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from std_registration");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["regno"]; echo "</td>";
                                            echo "<td>"; echo $row["name"]; echo "</td>";
                                            echo "<td>"; echo $row["username"]; echo "</td>";
                                            echo "<td>"; echo $row["sem"]; echo "</td>";
                                            echo "<td>"; echo $row["dept"]; echo "</td>";
                                            echo "<td>"; echo $row["session"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["phone"]; echo "</td>";
                                            echo "<td>"; echo $row["address"]; echo "</td>";
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
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>		
