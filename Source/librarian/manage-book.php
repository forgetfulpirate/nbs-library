
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'manage-book';
    include 'inc/connection.php';
    include 'inc/header.php';

    $message = "";

    if(isset($_GET['message'])) {
        $message = $_GET['message'];
    }

 ?>
            
            


            <main class="content px-3 py-2">  
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Book Collections
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>
                 
             <?php
                if (!empty($_SESSION['success_message'])) {
                    echo '<div class="alert alert-success" role="alert">' . $_SESSION['success_message'] . '</div>';
                    unset($_SESSION['success_message']);
                }
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']);
                }
            
                ?>


            
           
            <div class="card border-0">
                
                  
            
                 
                        <div class="card-body" >
                               <!-- Display Success or Error Messages -->
               
                            <table class="table table-hover text-left" id="dtBasicExample">
                                
                                <thead>
                                    <tr >
                              
                                    <th class="col">Accession Number</th>
                                    <th class="col">ISBN</th>
                                    <th class="col">Title of Book</th>
                                    <th class="col">Author</th>
                                    <th class="col">Edition</th>
                                    <th class="col">Publisher</th>
                                    <th class="col">Place of Publication</th>
                                    <th class="col">Year</th>
                                    <th class="col">Call Number</th>
                                    <th class="col">Publisher</th>
                                    <th class="col">Quantity</th>
                                    <th class="col">Location</th>
                                    <th class="col">Remarks</th>

                          
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $res = mysqli_query($link, "select * from book_module");
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>";
                              
                                    echo "<td>";                            
                                    echo $row["accession_number"];
                                    echo "</td>";

                                    echo "<td>";                            
                                    echo $row["ISBN"];
                                    echo "</td>";   

                                    echo "<td>";                   
                                    echo $row["title_proper"];
                                    echo "</td>";

                                    echo "<td>";                         
                                    echo $row["main_creator"];
                                    echo "</td>";

                                    echo "<td>";                         
                                    echo $row["edition"];
                                    echo "</td>";

                                    echo "<td>";                         
                                    echo $row["publisher"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["place_of_publication"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["date_of_publication"];
                                    echo "</td>";
 
                                    echo "<td>";                            
                                    echo $row["call_number_info"];
                                    echo "</td>";



                                    echo "<td>";
                                    echo $row["publisher"];
                                    echo "</td>";
                   
                                    echo "<td>";
                                    echo $row["quantity"];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row["location"];
                                    echo "</td>";
                               
                                    echo "<td>";
                                    echo $row["remarks"];
                                    echo "</td>";

                                }
                                 ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                
                

        
                    </main>

             



                    <div class="modal fade" id="editRemarksModal" tabindex="-1" role="dialog" aria-labelledby="editRemarksModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRemarksModalLabel">Edit Remarks</h5>
            </div>
            <div class="modal-body">
                <form id="editRemarksForm">
                    <input type="hidden" id="remarksId" name="remarksId">
                    <div class="form-group">
                        <label for="remarksText">Remarks:</label>
                        <textarea class="form-control" id="remarksText" name="remarksText"></textarea>
                        <small id="remarksTextError" class="text-danger"></small> <!-- Error message placeholder -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="dismissRemarksModalBtn">Close</button>
                <button type="button" class="btn btn-danger" id="saveRemarksBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>


    



    <script>
        $(document).ready(function () {
            
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
                buttons:['copy','csv','excel','pdf', 'print'],
                "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]]
            }); 

            $('.editRemarksLink').click(function (e) {
            e.preventDefault();
            var remarksText = $(this).data('remarks');
            var remarksId = $(this).data('accession_number');
            $('#remarksText').val(remarksText);
            $('#remarksId').val(remarksId);
            $('#editRemarksModal').modal('show');
        });

        $('#saveRemarksBtn').click(function () {
            var remarksText = $('#remarksText').val();

            // Validate input
            if (!isValidRemarksText(remarksText)) {
                $('#remarksTextError').text("Invalid input. Please enter valid text.");
                return;
            }

            // If input is valid, proceed with saving changes
            var remarksId = $('#remarksId').val();
            window.location = 'update-remarks-book-module.php?accession_number=' + remarksId + '&remarks=' + encodeURIComponent(remarksText);
        });

        // Function to validate remarks input
        function isValidRemarksText(text) {
            return text.trim().length > 0;
        }

        $('#dismissRemarksModalBtn').click(function () {
            $('#editRemarksModal').modal('hide');
        });

        // Handle pressing Enter key
        $('#remarksText').keydown(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $('#saveRemarksBtn').click(); // Trigger save button click event
            }
        });

        // Handle pressing Esc key
        $(document).keydown(function(event) {
            if (event.keyCode === 27) {
                $('#editRemarksModal').modal('hide'); // Hide the modal
            }
        });
        });
    </script>	

<?php 
		include 'inc/footer.php';
	 ?>





