
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
    include 'inc/tchfunction.php';
 ?>
 <style>
    .error {
    color: red;
}
 </style>

    
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
            <?php
            if (!empty($_SESSION['success_msg'])) {
                echo '<div class="alert alert-success" role="alert" id="success_msg">' . $_SESSION['success_msg'] . '</div>';
                unset($_SESSION['success_msg']);
            }
            if (isset($_SESSION['error_msg'])) {
                echo '<div class="alert alert-danger" role="alert" >' . $_SESSION['error_msg'] . '</div>';
                unset($_SESSION['error_msg']);
            }   
            ?>

            
            <div class="card border-0">
                 
                        <div class="card-body">
                            <table class="table table-hover text-center table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">verified</th>
                                        <th>Activate</th>
                                        <th>Deactivate</th>
                                        <th>Teacher</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from teacher");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["id_number"]; echo "</td>";
                                            echo "<td>"; echo $row["first_name"]; "<td>"; echo " "; echo $row["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["dept"]; echo "</td>";
                                            echo "<td>"; echo $row["verified"]; echo "</td>";
                                            echo "<td>";
                                            ?>
                                            <button class='btn btn-success btn-sm' onclick="activateUserConfirmation('<?php echo $row["id_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Activate</button>
                                            <?php
                                            echo "</td>";
                                            echo "<td>";
                                            ?>
                                            <button class='btn btn-danger btn-sm' onclick="deactivateUserConfirmation('<?php echo $row["id_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Deactivate</button>
                                            <?php
                                            echo "</td>";
                                            echo "<td>";
                                            ?>
                                                <button class='btn btn-danger btn-sm' onclick="deleteUserConfirmation('<?php echo $row["id_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Delete</button>

                                            <?php
                                            echo "</td>";
                              
                                            echo "</tr>";
                                        }
                                   ?> 
                                </tbody>
                            </table>
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStudentModal">
                                Add Teacher
                                </button>
                                </div>
                        </div>
                    </div>

                    
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel" style="color: red;">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete teacher "<span id="userNameToDelete"></span>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

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

                    
        <!-- Add Teacher Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudntModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    </div>
                    <div class="modal-body">
                    <div class="addUser">
					<div class="reg-body user-content">
                      
            
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="id_number" class="text-right">ID Number <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Student Number" name="id_number" required=""/>
                            </div>
                            <?php if(isset($error_uname)):?>
                                <span class="error"> <?php echo $error_uname; ?></span>
                            <?php endif ?>


                            <div class="form-group">
                                <label for="first_name" class="text-right">First name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="First name" name="first_name" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="last_name" class="text-right">Last name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Last name" name="last_name" required=""/>
                            </div>

                            <div class="form-group">
                                <label for="middle_name" class="text-right">Middle name <span>*</span></label>
                                <input type="text" class="form-control custom" placeholder="Middle name" name="middle_name"/>
                            </div>
  
                
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" class="form-control custom" placeholder="Password" name="password" required=""/>
                            </div>

                            <?php if(isset($error_ua)):?>
                                <span class="error" style="color:red"> <?php echo $error_ua; ?></span>
                            <?php endif ?>

                            <div class="form-group">
                                 <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                
                            </div>

                            <?php if(isset($e_msg)):?>
                                <span class="error"><?php echo $e_msg; ?> </span>
                            <?php endif ?>
                            <?php if(isset($error_email)):?>
                                <span class="error" style="color:red"><?php echo $error_email; ?> </span>
                            <?php endif ?>

                            <div class="form-group">
                                <label for="dept">Course <span>*</span></label>
                                <select class="form-control custom" name="dept" required="">
                                    <option>BSCS</option>
                                    <option>BSA</option>
                                    <option>BSTM</option>
                                    <option>BSAIS</option>
                                </select>
                            </div>
                                <br>
                            <div class="text-end" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                                <button type="submit" class="btn btn-success" name="submit">Add Teacher</button>
                            </div>
                        </form>

					</div>
				</div>
                </div>
            </div>
        </div>
    </div>
              
            </main>

    
    <script>
             $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            {
                    extend: 'pdfHtml5',
                    orientation: 'landscape', // Set orientation to landscape
                    customize: function (doc) {
                        // Set page size and margins
                        doc.pageOrientation = 'landscape';
                        doc.pageSize = 'A3';
                        doc.pageMargins = [15, 15, 15, 15];
                    }
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            
        ],
        "lengthMenu": [[5,10, 25, 50, 100, 500], [5,10, 25, 50, 100, 500]]
    });
        });
    </script>		

    
<?php 
		include 'inc/footer.php';
	 ?>

<script>
     // Function to set the user ID and name and trigger the modal
     function deleteUserConfirmation(userId, userName) {
        // Set the delete link with the user ID
        document.getElementById("confirmDeleteButton").setAttribute("onclick", "window.location.href='delete-teacher.php?id=" + userId + "'");
        // Set the user's name in the modal body
        document.getElementById("userNameToDelete").innerText = userName;
        // Show the delete confirmation modal
        $('#deleteConfirmationModal').modal('show');
    }

    function activateUserConfirmation(userId, userName) {
        // Set the user ID and name in the modal
        document.getElementById("confirmActivateButton").setAttribute("onclick", "window.location.href='approve.php?id=" + userId + "'");
        document.getElementById("userNameToActivate").innerText = userName;
        // Show the activate confirmation modal
        $('#activateConfirmationModal').modal('show');
    }

    function deactivateUserConfirmation(userId, userName) {
        // Set the user ID and name in the modal
        document.getElementById("confirmDeactivateButton").setAttribute("onclick", "window.location.href='notapprove.php?id=" + userId + "'");
        document.getElementById("userNameToDeactivate").innerText = userName;
        // Show the deactivate confirmation modal
        $('#deactivateConfirmationModal').modal('show');
    }
     
</script>


    

    
