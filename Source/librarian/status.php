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
          
                        <h4>User Verification 
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
                                        <th scope="col">Email</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">verified</th>
                                        
                                    </tr>
                                </thead>
                            
                                <tbody>
                                           <?php
                                                $res= mysqli_query($link, "select * from student ORDER BY student_number DESC");
                                                $res2= mysqli_query($link, "select * from teacher ORDER BY id_number DESC");
                                                while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["student_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["first_name"]; "<td>"; echo " "; echo $row["last_name"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                    echo "<td>"; echo $row["course"]; echo "</td>";
                                                    echo "<td>"; echo $row["year"]; echo "</td>";
                                                    echo "<td>"; echo $row["semester"]; echo "</td>";
                                                    echo "<td>"; echo $row["verified"]; echo "</td>";
                                             
                                              
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

        

  

  <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>