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
                <h4>User Verification  
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
                    unset($_SESSION['activation_success_msg']);
                }

                // Check if there is a success message for deactivation in the session
                if (isset($_SESSION['deactivation_success_msg'])) {
                    // Display the success message for deactivation
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['deactivation_success_msg'] . '</div>';
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
                                        <th>Deactivate</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from student");
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
                                                <button class='btn btn-success btn-sm' onclick="activateUserConfirmation('<?php echo $row["student_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Activate</button>
                                                <?php
                                           
                                            echo "</td>";
                                            echo "<td>";
                                           
                                                ?>
                                                <button class='btn btn-danger btn-sm' onclick="deactivateUserConfirmation('<?php echo $row["student_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Deactivate</button>
                                                <?php
                                            
                                            echo "</td>";
                                         
                              
                                            echo "</tr>";
                                        }

                                        $res1= mysqli_query($link, "select * from teacher");
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
                                                <button class='btn btn-success btn-sm' onclick="activateUserConfirmation('<?php echo $row1["id_number"]; ?>', '<?php echo $row1["first_name"] . ' ' . $row1["last_name"]; ?>')">Activate</button>
                                                <?php
                                            
                                            echo "</td>";
                                            echo "<td>";
                                            
                                                ?>
                                                <button class='btn btn-danger btn-sm' onclick="deactivateUserConfirmation('<?php echo $row1["id_number"]; ?>', '<?php echo $row1["first_name"] . ' ' . $row1["last_name"]; ?>')">Deactivate</button>
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

                  <!-- Activate Confirmation Modal -->
                  <div class="modal fade" id="activateConfirmationModal" tabindex="-1" aria-labelledby="activateConfirmationModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                            <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="activateConfirmationModalLabel" style="color: green;">Confirm Activation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                            <div class="modal-body">
                                Are you sure you want to activate "<span id="userNameToActivate"></span>"?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" id="confirmActivateButton">Activate</button>
                             </div>

                            </div>
                        </div>
                    </div>

                <!-- Deactivate Confirmation Modal -->
                <div class="modal fade" id="deactivateConfirmationModal" tabindex="-1" aria-labelledby="deactivateConfirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deactivateConfirmationModalLabel" style="color: red;">Confirm Deactivation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to deactivate "<span id="userNameToDeactivate"></span>"?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDeactivateButton">Deactivate</button>
                            </div>
                        </div>
                    </div>
                </div>
    
<?php include 'inc/footer.php';?>
    <!-- script for export table-->
    <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
    
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            
        ],
        "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]]
    });
        });
    </script>	
    

<script>
     // FUNCTION FOR deleteConfirmationModal 
     function deleteUserConfirmation(userId, userName) {
        document.getElementById("confirmDeleteButton").setAttribute("onclick", "window.location.href='delete-student.php?id=" + userId + "'");
        document.getElementById("userNameToDelete").innerText = userName;
        $('#deleteConfirmationModal').modal('show');
    }

      // FUNCTION FOR aCTIVATED CONFIRMATION MODAL 
    function activateUserConfirmation(userId, userName) {
        document.getElementById("confirmActivateButton").setAttribute("onclick", "window.location.href='approve.php?id=" + userId + "'");
        document.getElementById("userNameToActivate").innerText = userName;
        $('#activateConfirmationModal').modal('show');
    }

    // FUNCTION FOR DEACTIVATE CONFIRMATION MODAL 
    function deactivateUserConfirmation(userId, userName) {
        document.getElementById("confirmDeactivateButton").setAttribute("onclick", "window.location.href='notapprove.php?id=" + userId + "'");
        document.getElementById("userNameToDeactivate").innerText = userName;
        $('#deactivateConfirmationModal').modal('show');
    }

</script>

<!-- Script for delete confirmation modal -->
<script>
     function deleteUserConfirmation1(userId, userName) {

        document.getElementById("confirmDeleteButton1").setAttribute("onclick", "window.location.href='delete-teacher.php?id=" + userId + "'");
        document.getElementById("userNameToDelete1").innerText = userName;
        $('#deleteConfirmationModal1').modal('show');

    }
</script>


    

    
