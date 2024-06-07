<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'ibook';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->

    <main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Borrowed Books
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>

            
        <!-- Generate Receipt Form -->
        <div class="col-lg-12 col-12"> <!-- Full width on mobile, half width on large screens -->
            <form action="issue-book-receipt.php" method="post" id="receiptForm" target="_blank" onsubmit="return validateForm()">
                <div class="row text-center text-lg-end align-items-center justify-content-center justify-content-lg-end"> <!-- Center on mobile, right align on large screens -->
                    <div class="col-auto p-2">
                        <label for="student_number" class="col-form-label" style="font-size:medium;">Enter ID Number:</label>
                    </div>
                    <div class="col-auto p-2" style="width:200px;">
                        <input type="text" name="student_number" id="student_number" class="form-control custom" placeholder="Enter ID" required>
                    </div>
                    <div class="col-auto p-2">
                        <button class="btn btn-danger btn-block" type="submit" name="issue_book_receipt">Generate Loan Receipt</button>
                    </div>
                </div>
            </form>
        </div>
          
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table table-hover text-left table-striped" id="dtBasicExample">
                            <thead>
                                            <tr>
                                                <th>Accession Number</th>
                                                <th>Books Name</th>
                                                <th>Date Issued</th>
                                                <th>Date Due</th>
                                                <th>User Type</th>
                                                <th>Name</th>
                                                <th>ID Number</th>
                                                <th>Issued By</th>
                                                <th>Return Book</th>
                                            </tr>
                                       </thead>
                                        <tbody>
                                            <?php 
                                                $res= mysqli_query($link, "select * from issue_book");
                                                $res2= mysqli_query($link, "select * from t_issuebook");
                                                 while ($row=mysqli_fetch_array($res)) {
                                                    echo "<tr>";
                                                    echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksname"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                                                    echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                                    echo "<td>"; echo $row["utype"]; echo "</td>";
                                                    echo "<td>"; echo $row["name"]; echo " "; echo "</td>";
                                                    echo "<td>"; echo $row["student_number"]; echo "</td>";
                                                    echo "<td>"; echo $row["username"]; echo "</td>";
                                
                                                    echo "<td>";
                                              
                                                   ?>
                                                         <div class="d-flex justify-content-center">
                                                            <a href="return.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-sm" onclick="return confirm('Are you sure you want to return this book?')"  style="margin-right: 10px"><span>Return</span></a>
                                                            <!-- <a href="delete.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this row?')"><span>Cancel</span></a> -->
                                                        </div>
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

        


    

     <script>
        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });

        function validateForm() {
    var studentNumber = document.getElementById("student_number").value;
    
    // Check if the student number is empty or not a number
    if (studentNumber.trim() === "" || isNaN(studentNumber)) {
        alert("Please enter a valid ID number.");
        return false; // Prevent form submission
    }
    
    return true; // Allow form submission
}
</script>
    </script>

    

<?php 
		include 'inc/footer.php';
	 ?>
    