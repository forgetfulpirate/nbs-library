<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'user-archive';
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
                            <table class="table table-hover text-left table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>

                                        <th scope="col">User Type</th>
                                        <th scope="col">ID Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Course/Department</th>
                                        <th scope="col">verified</th>
                                        <th>Action</th>
                            
                                   
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
                <a href="#" 
                class="btn btn-danger btn-sm ml-2 unarchiveBtn" 
                data-toggle="modal" 
                data-target="#unarchiveModal" 
                data-id="<?php echo $row["student_number"]; ?>" 
                data-name="<?php echo $row["first_name"]; echo ' ';echo $row["last_name"]; ?>"
                data-type="student">Unarchive</a>                                                <?php
                                           
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
                                                    <a href="#" 
                                                    class="btn btn-danger btn-sm ml-2 unarchiveBtn" 
                                                    data-toggle="modal" 
                                                    data-target="#unarchiveModal" 
                                                    data-id="<?php echo $row1["id_number"]; ?>" 
                                                    data-name="<?php echo $row1["first_name"]; echo ' '; echo $row1["last_name"]; ?>"
                                                    data-type="teacher">Unarchive</a>                                                <?php
                                            
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

<div class="modal fade" id="unarchiveModal" tabindex="-1" role="dialog" aria-labelledby="unarchiveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="unarchiveModalLabel">Confirm Unarchive</h5>

      </div>
      <div class="modal-body">
        Are you sure you want to unarchive <span id="unarchiveUserName" style="color:#d52033"></span>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="#" id="confirmUnarchiveBtn" class="btn btn-danger">Unarchive</a>
      </div>
    </div>
  </div>
</div>

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
    
     



    <script>
$(document).ready(function() {
    $('.unarchiveBtn').on('click', function() {
        var userId = $(this).data('id');
        var userName = $(this).data('name');
        var userType = $(this).data('type');
        
        $('#unarchiveUserName').text(userName);
        
        var unarchiveUrl = userType === 'student' 
            ? 'unarchive.php?student_number=' + userId 
            : 'unarchive-teacher.php?id_number=' + userId;
        
        $('#confirmUnarchiveBtn').attr('href', unarchiveUrl);
    });
});
</script>


    
