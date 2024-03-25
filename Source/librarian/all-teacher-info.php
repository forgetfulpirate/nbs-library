<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'tinfo';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>


            <main class="content px-3 py-2">
            
            <div class="card border-0">
                  
                 
                        <div class="card-body">
                        <table id="dtBasicExample" class="table table-striped text-center">
                                    <thead>
                                         <tr>
                                             <th>Id No</th>
                                             <th>Name</th>
                                             <th>Username</th>
                                             <th>Lecturer</th>
                                             <th>Email</th>
                                             <th>Phone</th>
                                             <th>Address</th>
                                         </tr>
                                    </thead>
                                    <tbody>       
                                        <?php   
                                             $res= mysqli_query($link, "select * from t_registration");
                                             while ($row=mysqli_fetch_array($res)) {
                                                echo "<tr>";
                                                echo "<td>"; echo $row["idno"]; echo "</td>";
                                                echo "<td>"; echo $row["name"]; echo "</td>";
                                                echo "<td>"; echo $row["username"]; echo "</td>";
                                                echo "<td>"; echo $row["lecturer"]; echo "</td>";
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

