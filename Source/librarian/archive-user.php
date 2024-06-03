<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'user-v';
    include 'inc/connection.php';
    include 'inc/header.php';
    include 'inc/sfunction.php';
    
 ?>

<style>

#time {
    font-size: 20px;
    float: right;
  
}

#date {
    font-size: 20px;
    float: right;
    margin-right: 20px;


}
.h4 {
    float:left;
}
.error {
    color: red;
}

</style>


    
            <main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>User Archive 
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>

              <!-- Display Success or Error Messages -->
                <?php
                if (!empty($_SESSION['success_msg'])) {
                    echo '<div class="alert alert-success" role="alert" id="success_msg">' . $_SESSION['success_msg'] . '</div>';
                    unset($_SESSION['success_msg']);
                }
                if (isset($_SESSION['error_msg'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_msg'] . '</div>';
                    unset($_SESSION['error_msg']);
                }

                                // Check if there is a success message for activation in the session
                if (isset($_SESSION['activation_success_msg'])) {
                    // Display the success message for activation
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['activation_success_msg'] . '</div>';
                    // Clear the session variable to ensure it's only displayed once
                    unset($_SESSION['activation_success_msg']);
                }

                // Check if there is a success message for deactivation in the session
                if (isset($_SESSION['deactivation_success_msg'])) {
                    // Display the success message for deactivation
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['deactivation_success_msg'] . '</div>';
                    // Clear the session variable to ensure it's only displayed once
                    unset($_SESSION['deactivation_success_msg']);
                }
            
                ?>
            
  

            <div class="card border-0">
                
                 
                        <div class="card-body">
                            <table class="table table-hover text-center table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>

                                        <th scope="col">User Type</th>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Course/Department</th>
                                        <th scope="col">verified</th>
                                        <th>Activate</th>
                            
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from student_archive");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["user_type"]; echo "</td>";
                                            echo "<td>"; echo $row["student_number"]; echo "</td>";
                                            echo "<td>"; echo $row["first_name"]; "<td>"; echo " "; echo $row["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["course"]; echo "</td>";
                                            echo "<td>"; echo $row["verified"]; echo "</td>";
                                            echo "<td>";
                                        
                                                ?>
                                      <a href="unarchive.php?student_number=<?php echo $row["student_number"]; ?> " class="btn btn-danger btn-sm ml-2" style="margin-right: 0px; padding-right: 5px; padding-left: 5px;">Unarchive</a>
                                                <?php
                                           
                                            echo "</td>";
                                  
                                         
                              
                                            echo "</tr>";
                                        }

                                        $res1= mysqli_query($link, "select * from teacher_archive");
                                        while ($row1=mysqli_fetch_array($res1)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row1["user_type"]; echo "</td>";
                                            echo "<td>"; echo $row1["id_number"]; echo "</td>";
                                            echo "<td>"; echo $row1["first_name"]; "<td>"; echo " "; echo $row1["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row1["email"]; echo "</td>";
                                            echo "<td>"; echo $row1["dept"]; echo "</td>";
                                            echo "<td>"; echo $row1["verified"]; echo "</td>";
                                            echo "<td>";
                                   
                                                ?>
                                                 <a href="unarchive-teacher.php?id_number=<?php echo $row1["id_number"]; ?>" class="btn btn-danger btn-sm ml-2" style="margin-right: 0px; padding-right: 5px; padding-left: 5px;"><span style="margin-right:5px;">Unarchive</span></a>
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
    
<?php include 'inc/footer.php';?>

    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            // {
            //     extend: 'copy',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5]
            //     }
            // },
            // {
            //     extend: 'csv',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5]
            //     }
            // },
            // {
            //     extend: 'excel',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5]
            //     }
            // },
            // {
            //     extend: 'pdf',
    
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5]
            //     }
            // },
            // {
            //     extend: 'print',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5]
            //     }
            // },
            
        ],
        "lengthMenu": [[5,10, 25, 50, 100, 500], [5,10, 25, 50, 100, 500]]
    });
        });
    </script>	
    





   
     
</script>


    

    
