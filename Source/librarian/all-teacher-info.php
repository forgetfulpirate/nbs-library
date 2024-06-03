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
          
                        <h4>Teacher Information 
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
                            <table class="table table-hover  table-striped" id="dtBasicExample">
                                <thead style="text-align: left;">
                                    <tr>
                                        <th scope="col">User Type</th>
                                        <th scope="col" class="text-left">Faculty Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Department</th>
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
                                <button type="submit1" class="btn btn-success" name="submit">Add Teacher</button>
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
                            <h5 class="modal-title" id="deleteConfirmationModalLabel1" style="color: red;">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete Teacher "<span id="userNameToDelete1"></span>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton1">Delete</button>
                        </div>
                    </div>
                </div>
            </div> 
                 <!-- End DeleteConfirmation Modal -->
 </main>

  <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
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

