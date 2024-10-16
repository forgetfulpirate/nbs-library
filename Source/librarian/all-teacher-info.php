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
    include 'inc/header.php';
    include 'inc/connection.php';
    include 'inc/tchfunction.php';


 ?>
 <style>
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
          
                        <h4>Faculty Information 
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
            
                ?>
          
            <div class="card border-0">
                
                        <div class="card-body">
                            <table class="table table-hover  table-striped" id="dtBasicExample">
                                <thead style="text-align: left;">
                                    <tr>
                                        <th scope="col">User Type</th>
                                        <th scope="col" class="text-left">Faculty Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department</th>
                                        <th scope="col">Reset Password</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                            
                                <tbody class="text-left">
                                <?php
                                        
                                        $res2= mysqli_query($link, "select * from teacher ORDER BY id_number DESC");
                                      
                                        while ($row1=mysqli_fetch_array($res2)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row1["user_type"]; echo "</td>";
                                            echo "<td>"; echo $row1["id_number"]; echo "</td>";
                                            echo "<td>"; echo $row1["first_name"]; "<td>"; echo " "; echo $row1["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row1["email"]; echo "</td>";
                                            echo "<td>"; echo $row1["dept"]; echo "</td>";
                                            echo "<td>";
                                            ?>
                                                <button style="text-align:left; width:128px; max-width:128px;" class='btn btn-danger btn-sm' onclick="resetPasswordConfirmation('<?php echo $row1["id_number"]; ?>', '<?php echo $row1["first_name"] . ' ' . $row1["last_name"]; ?>')">Reset Password</button>


                                            <?php
                                            echo "</td>";
                                            echo "<td>";
                                            ?>
                                               
                                                <button class='btn btn-danger btn-sm' onclick="deleteUserConfirmation1('<?php echo $row1["id_number"]; ?>', '<?php echo $row1["first_name"] . ' ' . $row1["last_name"]; ?>')">Archive</button>

                                            <?php
                                            echo "</td>";
                                            echo "</tr>";
                                        }

                                      
                                     ?>
                                       </tbody>
                            </table>
                            <br>
                            <div class="text-end">
                           
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addTeacherModal">
                                Add Teacher
                                </button>
                            </div>
                        </div>                
                    </div>

                        <!-- Add Teacher Modal -->
        <div class="modal fade" id="addTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addStudntModalLabel" aria-hidden="true">
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
                                <input type="text" class="form-control custom" placeholder="ID Number" name="id_number" required=""/>
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
                                <label for="dept">Department <span>*</span></label>
                                <select class="form-control custom" name="dept" required="">
                                    <option>BSCS</option>
                                    <option>BSA</option>
                                    <option>BSTM</option>
                                    <option>BSEntrep</option>
                                    <option>BSAIS</option>
                                </select>
                            </div>
                                <br>
                            <div class="text-end" >
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                                Close
                            </button>
                                <button type="submit1" class="btn btn-danger" name="submit">Add Teacher</button>
                            </div>
                        </form>

					</div>
				</div>
                </div>
            </div>
        </div>
    </div>

     <!-- END Add Teacher Modal -->

     <!-- Delete Confirmation Modal -->
     <div class="modal fade" id="deleteConfirmationModal1" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteConfirmationModalLabel1" style="color: red;">Confirm Archive</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to Archive Teacher "<span id="userNameToDelete1" style="color:#d52033"></span>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton1">Archive</button>
                        </div>
                    </div>
                </div>
            </div> 
                 <!-- End DeleteConfirmation Modal -->

                 <!-- Reset Password Confirmation Modal -->
<div class="modal fade" id="resetPasswordConfirmationModal" tabindex="-1" aria-labelledby="resetPasswordConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resetPasswordConfirmationModalLabel">Reset Password Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to reset the password for <span id="facultyNameToReset" style="color:#d52033"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmResetPasswordButton">Reset Password</button>
            </div>
        </div>
    </div>
</div>
 <!-- END Reset Password Confirmation Modal -->
 </main>

 <?php 
		include 'inc/footer.php';
	 ?>


  <script>
          $(document).ready(function () {
            $('#dtBasicExample').DataTable({
        dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "order": [[1, 'asc']], // This sets the default sorting to the second column (accession_number) in ascending order
    });
        });

    
    </script>

<script>
     // Function to set the user ID and name and trigger the modal
     function deleteUserConfirmation1(userId, userName) {
        // Set the delete link with the user ID
        document.getElementById("confirmDeleteButton1").setAttribute("onclick", "window.location.href='delete-teacher.php?id=" + userId + "'");
        // Set the user's name in the modal body
        document.getElementById("userNameToDelete1").innerText = userName;
        // Show the delete confirmation modal
        $('#deleteConfirmationModal1').modal('show');
    }

   
     
</script>

<script>
    function resetPasswordConfirmation(idNumber, facultyName) {
        // Set the reset password link with the student number
        var resetPasswordUrl = 'reset-password-teacher.php?id_number=' + idNumber;
        // Show confirmation modal
        if(confirm("Are you sure you want to reset the password for " + facultyName + "?")) {
            // Redirect to reset-password.php
            window.location.href = resetPasswordUrl;
        }
    }
</script>

<!-- reset password modal script -->
<script>
    function resetPasswordConfirmation(idNumber, facultyName) {
        // Set the faculty name in the modal
        document.getElementById("facultyNameToReset").innerText = facultyName;
        // Show the reset password confirmation modal
        $('#resetPasswordConfirmationModal').modal('show');
        
        // Set the action when the reset password button is clicked
        document.getElementById("confirmResetPasswordButton").onclick = function() {
            // Construct the reset password URL
            var resetPasswordUrl = 'reset-password-teacher.php?id_number=' + idNumber;
            // Redirect to the reset password URL
            window.location.href = resetPasswordUrl;
        };
    }
</script>
