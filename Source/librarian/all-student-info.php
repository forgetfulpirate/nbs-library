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
    include 'inc/header.php';
    include 'inc/connection.php';
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
          
                        <h4>Student Information 
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
                                        <th scope="col" class="text-left">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Year</th>
                                        <!-- <th scope="col">Semester</th> -->
                                        <th scope="col">verified</th>
                                        <th scope="col">Action</th>
                                        
                                    </tr>
                                </thead>
                            
                                <tbody>
                                           <?php
                                                $res= mysqli_query($link, "select * from student ORDER BY student_number DESC");
                                                $res2= mysqli_query($link, "select * from teacher ORDER BY id_number DESC");
                                                while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["user_type"]; echo "</td>";
                                                    echo "<td>"; echo $row["student_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["first_name"]; "<td>"; echo " "; echo $row["last_name"]; echo "</td>";
                                                    echo "<td>"; echo $row["email"]; echo "</td>";
                                                    echo "<td>"; echo $row["course"]; echo "</td>";
                                                    echo "<td>"; echo $row["year"]; echo "</td>";
                                                    // echo "<td>"; echo $row["semester"]; echo "</td>";
                                                    echo "<td>"; echo $row["verified"]; echo "</td>";
                                                    echo "<td>";
                                                    
                                                    ?>
                           

                                                        <button class='btn btn-danger btn-sm' onclick="resetPasswordConfirmation('<?php echo $row["student_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Reset Password</button>
                                                        <button class='btn btn-danger btn-sm' onclick="deleteUserConfirmation('<?php echo $row["student_number"]; ?>', '<?php echo $row["first_name"] . ' ' . $row["last_name"]; ?>')">Archive</button>
        
                                                    <?php
                                                    echo "</td>";
                                                    
                                                    echo "</tr>";
                                                }

                                            

                                              
                                             ?>
                                       </tbody>
                            </table>
                            <br>
                            <div class="text-end">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addStudentModal">
                                Add Student
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
                            Are you sure you want to delete Student "<span id="userNameToDelete"></span>"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                        </div>
                    </div>
                </div>
            </div> 
         
        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                    </div>
                    <div class="modal-body">
                    <div class="addUser">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="student_number">Student Number <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Student Number" name="student_number" required/>
                                <span class="error"><?php echo $error_uname; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name <span>*</span></label>
                                <input type="text" class="form-control" placeholder="First Name" name="first_name" required/>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name" required/>
                            </div>
                            <div class="form-group">
                                <label for="middle_name">Middle Name <span>*</span></label>
                                <input type="text" class="form-control" placeholder="Middle Name" name="middle_name"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password <span>*</span></label>
                                <input type="password" class="form-control" placeholder="Password" name="password" required/>
                                <span class="error"><?php echo $error_ua; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span>*</span></label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                <span class="error"><?php echo $error_email; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="year">Year <span>*</span></label>
                                <select class="form-control" name="year" required>
                                    <option>1st year</option>
                                    <option>2nd year</option>
                                    <option>3rd year</option>
                                    <option>4th year</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label for="semester">Select Semester <span>*</span></label>
                                <select class="form-control" name="semester" required>
                                    <option>1st</option>
                                    <option>2nd</option>
                                    <option>3rd</option>
                                    <option>4th</option>
                                    <option>5th</option>
                                    <option>6th</option>
                                    <option>7th</option>
                                    <option>8th</option>
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label for="course">Course <span>*</span></label>
                                <select class="form-control" name="course" required>
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
                                <button type="submit" class="btn btn-success" name="submit">Add Student</button>
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
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

       
    </script>

<script type="text/javascript">
    var errorMsg = "";
    <?php if ($error_uname != ""): ?>
        errorMsg += "<?php echo $error_uname; ?><br>";
    <?php endif; ?>
    <?php if ($error_email != ""): ?>
        errorMsg += "<?php echo $error_email; ?><br>";
    <?php endif; ?>
    <?php if ($error_ua != ""): ?>
        errorMsg += "<?php echo $error_ua; ?><br>";
    <?php endif; ?>
    <?php if ($e_msg != ""): ?>
        errorMsg += "<?php echo $e_msg; ?><br>";
    <?php endif; ?>

    $(document).ready(function() {
    var errorMsgShown = false; // Variable to track if error message is shown

    // Function to show error message in modal
    function showErrorModal() {
        $("#errorModalBody").html(errorMsg);
        $("#errorModal").modal('show');
        errorMsgShown = true; // Set flag to true when error message is shown
    }

    // Show error modal if errorMsg is not empty and errorMsgShown is false
    if (errorMsg != "" && !errorMsgShown) {
        showErrorModal();
    }

    // Close button click event handler
    $('#closeErrorModal').on('click', function() {
        $('#errorModal').modal('hide');
        errorMsgShown = false; // Reset flag when modal is closed
    });
});


    $(document).ready(function () {
        // Check if there are any error messages
        var errorMsg = '<?php echo $error_uname . $error_email . $error_ua . $e_msg; ?>';
        
        // If there are error messages, show the modal
        if (errorMsg !== '') {
            $('#addStudentModal').modal('show');
        }

         // Add event listener to the close button
    $('.btn-secondary').on('click', function() {
        $('#addStudentModal').modal('hide');
    });
    });

   
</script>

<!-- SCRRIPT FOR DELETE STUDENT -->
<script>
     function deleteUserConfirmation(userId, userName) {
        // Set the delete link with the user ID
        document.getElementById("confirmDeleteButton").setAttribute("onclick", "window.location.href='delete-student.php?id=" + userId + "'");
        // Set the user's name in the modal body
        document.getElementById("userNameToDelete").innerText = userName;
        // Show the delete confirmation modal
        $('#deleteConfirmationModal').modal('show');
    }
</script>

<script>
    function resetPasswordConfirmation(studentNumber, studentName) {
        // Set the reset password link with the student number
        var resetPasswordUrl = 'reset-password.php?student_number=' + studentNumber;
        // Show confirmation modal
        if(confirm("Are you sure you want to reset the password for " + studentName + "?")) {
            // Redirect to reset-password.php
            window.location.href = resetPasswordUrl;
        }
    }
</script>
