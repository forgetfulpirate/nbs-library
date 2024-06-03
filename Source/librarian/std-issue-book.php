<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'issue-student';
    include 'inc/header.php';
    include 'inc/connection.php';
    $rdate = date("m-d-Y", strtotime("+30 days"));
?>
<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Student Issue Book 
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>
    <br>
    <div class="issueBook">
        <div class="row">
            <div class="col-md-6">
                <div class="issue-wrapper">
                    <form action="" class="form-control" method="post" name="student_number">
                        <table class="table">
                            <tr>
                                <td class="">
                                <input type="text" name="student_number" class="form-control" placeholder="Enter Student Number" value="<?php echo isset($_POST['student_number']) ? htmlspecialchars($_POST['student_number']) : ''; ?>">
                                    <span id="invalidStudentNumber" style="color: red; display: none;">Student number is invalid</span>
                                    <span id="emptyStudentNumber" style="color: red; display: none;">Student number cannot be empty</span>

                                </td>
                                <td>
                                    <input type="submit" class="btn btn-info" value="Select" name="submit1">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <br>
                    <?php 
                        if (isset($_POST["submit1"])) {
                            $studentNumber = mysqli_real_escape_string($link, $_POST["student_number"]);
                            $res5 = mysqli_query($link, "select * from student where student_number='$studentNumber' ");
                            if(mysqli_num_rows($res5) == 0) {
                    ?>
                                <script>
                                    document.getElementById('invalidStudentNumber').style.display = 'block';
                                </script>
                    <?php
                            } else {
                                while($row5 = mysqli_fetch_array($res5)){   
                                    $student_number  = $row5['student_number'];                
                                    $first_name  = $row5['first_name'];
                                    $last_name       = $row5['last_name'];
                                    $user_type     = $row5['user_type'];
                                    $_SESSION["user_type"]     = $user_type;
                                    $_SESSION["student_number"]     = $student_number;
                                    $_SESSION["verified"] = $row5['verified']; // Add verified status to session
                                }
                    ?>
                        <br>
                        <form action="" class="form-control" method="post" name="issue_book">
                            <!-- Display student information -->
                            <table class="table table-bordered">
                                <tr>
                                    <td>
                                        <label>User Type</label>
                                        <input type="text" class="form-control" name="user_type" value="<?php echo $user_type; ?>" disabled> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Student Number</label>
                                        <input type="text" class="form-control" name="student_number" value="<?php echo $student_number; ?>" disabled> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo $first_name . ' ' . $last_name; ?>" readonly> 
                                    </td>
                                </tr>
                                <tr hidden>
                                    <td>
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name" value="<?php echo $last_name;?>"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Book Accession No</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="accession_number[]" placeholder="Enter Book Accession No" required>
                                            <div class="input-group-append">
                                                <button class="btn btn-success add-accession" type="button"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered" id="accession_table">
                                <tr>
                                    <td>
                                        <label>Issued Date</label>
                                        <input type="date" class="form-control" name="booksissuedate" value="<?php echo date("Y-m-d"); ?>" readonly> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Date Due</label>
                                        <input type="date" class="form-control" name="booksreturndate" id="booksreturndate" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
                                        <div id="returnDateError" style="color: red; display: none;">Return date cannot be earlier than issue date.</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Issued By:</label>
                                        <input type="text" class="form-control" name="username" value="" placeholder="Issued By" required> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php
                                        // Check if the user is verified before allowing to issue the book
                                        if ($_SESSION["verified"] == 'yes') {
                                        ?>
                                            <input type="submit" name="submit2" class="btn btn-info" value="Issue Book">
                                        <?php
                                        } else {
                                        ?>
                                            <div class="alert alert-warning col-lg-6 col-lg-push-3">
                                                <strong>Account is deactivated</strong>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    <?php
                            }
                        }
                    ?>
                    <?php
                       if (isset($_POST["submit2"])) {
                        // Check if the student has already issued 5 books
                        $studentNumber = $_SESSION["student_number"];
                        $issuedBooksQuery = mysqli_query($link, "SELECT COUNT(*) AS total_books FROM issue_book WHERE student_number='$studentNumber'");
                        $issuedBooksResult = mysqli_fetch_assoc($issuedBooksQuery);
                        $totalBooksIssued = $issuedBooksResult["total_books"];
                    
                        // Calculate the number of books the student is attempting to issue in the current request
                        $booksToIssueCount = count($_POST['accession_number']);
                    
                        // Check if issuing more books would exceed the limit of 5
                        if ($totalBooksIssued + $booksToIssueCount > 5) {
                            ?>
                            <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                <strong>You can only issue a maximum of 5 books for students.</strong>
                            </div>
                            <?php
                        } else {
                            // Proceed with the issuance process
                            $issuedCount = 0; // Counter for the number of successfully issued books
                            foreach ($_POST['accession_number'] as $accession_number) {
                                if ($issuedCount >= 5) {
                                    // If already issued 5 books, stop issuing more
                                    break;
                                }
                                $qty = 0;
                                // Validate if the accession_number exists in the book_module table
                                $accession_number = mysqli_real_escape_string($link, $accession_number);
                                $res = mysqli_query($link, "SELECT * FROM book_module WHERE accession_number='$accession_number'");
                                if (mysqli_num_rows($res) == 0) {
                                    ?>
                                    <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                        <strong>Book Accession No <?php echo $accession_number; ?> is invalid.</strong>
                                    </div>
                                    <?php
                                    continue; // Move to the next iteration if the current book ID is invalid
                                } else {
                                    while ($row = mysqli_fetch_array($res)) {
                                        $qty = $row["available"];
                                        $title_proper = $row["title_proper"];
                                    }
                                    if ($qty == 0) {
                                        ?>
                                        <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                            <strong>This book with Accession No <?php echo $accession_number; ?> is not available.</strong>
                                        </div>
                                        <?php
                                        continue; // Move to the next iteration if the current book is not available
                                    } else {
                                        // Check if return date is valid
                                        // $issuedDate = strtotime($_POST['booksissuedate']);
                                        // $returnDate = strtotime($_POST['booksreturndate']);
                                        // if ($returnDate < $issuedDate) {
                                            ?>
                                            <!-- <div class="alert alert-danger col-lg-6 col-lg-push-3">
                                                <strong>Return date cannot be earlier than issue date.</strong>
                                            </div> -->
                                            <?php
                                        //     continue; // Move to the next iteration if return date is invalid
                                        // }
                                        
                                        $title_proper = mysqli_real_escape_string($link, $title_proper);
                                        mysqli_query($link, "INSERT INTO issue_book VALUES ('', '$_SESSION[user_type]', '$_SESSION[student_number]', '$_POST[first_name]', '$_POST[last_name]', '', '', '', '', '$title_proper', '$accession_number', '$_POST[booksissuedate]', '$_POST[booksreturndate]','$_POST[username]')");
                                        
                                        mysqli_query($link, "update book_module set available=available-1 where accession_number='$accession_number'");
                                        $issuedCount++; // Increment the counter for successfully issued books
                                        ?>
                                        <br>
                                        <div class="alert alert-success col-lg-6 col-lg-push-3">
                                            <strong>Book Accession No <?php echo $accession_number; ?> issued successfully</strong>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        }
                    }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
 // JavaScript to validate the student number
document.forms['student_number'].addEventListener('submit', function(event) {
    var studentNumber = document.forms['student_number']['student_number'].value;
    if (studentNumber.trim() === '') {
        event.preventDefault();
        document.getElementById('invalidStudentNumber').style.display = 'none'; // Hide the invalid student number message
        document.getElementById('emptyStudentNumber').style.display = 'block'; // Show the empty field message
        return;
    } else {
        document.getElementById('emptyStudentNumber').style.display = 'none'; // Hide the empty field message if student number is not empty
    }
    // You can add more validation if needed, like length check, format check, etc.
});

    // JavaScript to add more accession number input fields dynamically
    document.addEventListener("click", function(event) {
        // Check if the clicked element is to add accession number and if the count is less than 5
        if ((event.target.classList.contains("add-accession") || event.target.parentElement.classList.contains("add-accession")) && document.querySelectorAll('input[name="accession_number[]"]').length < 5) {
            var buttonRow = event.target.closest("tr");
            var newRow = document.createElement("tr");
            var newData = document.createElement("td");
            var inputGroup = document.createElement("div");
            inputGroup.className = "input-group";
            var inputField = document.createElement("input");
            inputField.type = "text";
            inputField.className = "form-control";
            inputField.name = "accession_number[]";
            inputField.placeholder = "Enter Book Accession No";
            inputField.required = true;
            var inputGroupAppend = document.createElement("div");
            inputGroupAppend.className = "input-group-append";
            var removeButton = document.createElement("button");
            removeButton.className = "btn btn-danger remove-accession";
            removeButton.type = "button";
            var removeIcon = document.createElement("i");
            removeIcon.className = "fas fa-times";
            removeButton.appendChild(removeIcon);
            inputGroupAppend.appendChild(removeButton);
            inputGroup.appendChild(inputField);
            inputGroup.appendChild(inputGroupAppend);
            newData.appendChild(inputGroup);
            newRow.appendChild(newData);
          
            var lastAccessionRow = buttonRow.closest("table").querySelector(".accession-row:last-child");
        if (lastAccessionRow) {
            lastAccessionRow.parentNode.insertBefore(newRow, lastAccessionRow.nextSibling);
        } else {
            buttonRow.parentNode.insertBefore(newRow, buttonRow.nextSibling);
        }
        newRow.classList.add("accession-row");


        }

        // Handle removal of accession number input fields
        if (event.target.classList.contains("remove-accession") || event.target.parentElement.classList.contains("remove-accession")) {
            var row = event.target.closest("tr");
            row.parentNode.removeChild(row);
        }
    });
</script>
<?php 
    include 'inc/footer.php';
?>
