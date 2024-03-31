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
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>User Type</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>verified</th>
                                                <th>Activate</th>
                                                <th>Deactivate</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                           <?php
                                                $res= mysqli_query($link, "select * from std_registration ORDER BY id DESC");
                                                $res2= mysqli_query($link, "select * from t_registration ORDER BY id DESC");
                                                while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["name"]; echo "</td>";
                                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                    echo "<td>"; echo $row["status"]; echo "</td>";
                                                    echo "<td>"; echo $row["verified"]; echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                              <a href="approve.php?id=<?php echo $row["id"];?>" class='btn btn-success btn-sm'>Activate</a>
                                                          
                                                            
                                                          
                                                       
                                                    <?php
                                                    
                                                    echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                         <a href="notapprove.php?id=<?php echo $row["id"];?>" class='btn btn-danger btn-sm'>Deactivate</a>
                                                     <?php
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                while ($row=mysqli_fetch_array($res2)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["name"]; echo "</td>";
                                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                    echo "<td>"; echo $row["status"]; echo "</td>";
                                                    echo "<td>"; echo $row["verified"]; echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                            <a href="approve.php?id=<?php echo $row["id"];?>" class='btn btn-success btn-sm'>Activate</a>
                                                           
                                                    <?php
                                                    
                                                    echo "</td>";
                                                    echo "<td>";
                                                    ?>
                                                            <a href="notapprove.php?id=<?php echo $row["id"];?>" class='btn btn-danger btn-sm'>Deactivate</a>
                                                     <?php
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

        

  

  <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>