<?php
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
}
include 'inc/header.php';
include 'inc/connection.php';

  // Check if both start_date and end_date are set
  if (isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
    // Sanitize the input to prevent SQL injection
    $start_date = mysqli_real_escape_string($link, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($link, $_POST['end_date']);

    // Get the selected filtering criteria
    $filter_criteria = $_POST['filter_criteria'];

    // Construct the SQL query
    $query = "SELECT * FROM finezone WHERE $filter_criteria BETWEEN '$start_date' AND '$end_date' ORDER BY $filter_criteria ASC";

    // Set the filename based on the date range
    $filename = "overdue-return($start_date - $end_date)";    
} else {
    // If start_date and end_date are not set, fetch all records
    $query = "SELECT * FROM finezone ORDER BY date_issued ASC"; // Default ordering by date_issued
    $filename = "overdue-return(all)";
}

$res = mysqli_query($link, $query);

// Check if there are any results
$num_rows = mysqli_num_rows($res);
?>

<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Overdue</h4>
            <p id="time"></p>
            <p id="date"></p>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <!-- Filter Date Form -->
            <div class="col-lg-12 mb-1"> <!-- Full width on mobile, full width on large screens -->
                                <!-- Generate Receipt Form -->
                    <div class="col-lg-12 mb-4 text-lg-right"> <!-- Full width on mobile, full width on large screens -->
                        <form action="fine-receipt.php" method="post" id="receiptForm" target="_blank" onsubmit="return validateForm()">
                            <div class="row text-center text-lg-end align-items-center justify-content-center justify-content-lg-end"> <!-- Center on mobile, right align on large screens -->
                                <div class="col-auto p-2">
                                    <label for="student_number" class="col-form-label" style="font-size:medium;">Enter ID Number:</label>
                                </div>
                                <div class="col-auto p-2" style="width:200px;">
                                    <input type="text" name="student_number" id="student_number" class="form-control custom" placeholder="Enter ID" required>
                                </div>
                                <div class="col-auto p-2">
                                    <button class="btn btn-danger btn-block" type="submit" name="generate_receipt">Generate Receipt</button>
                                </div>
                            </div>
                        </form>
                    </div>
         
                <form method="POST" id="filterForm">
                    <div class="col-md-12">
                        <div class="row text-center align-items-center justify-content-center"> <!-- Center the filter form horizontally and vertically -->
                            <div class="col-auto p-2">
                                <label for="filter_criteria" class="col-form-label" style="font-size:medium;">Filter By</label>
                            </div>
                            <div class="col-auto p-2" style="width:200px;">
                                <select name="filter_criteria" class="form-control custom">
                                    <option value="date_issued" <?php echo isset($_POST['filter_criteria']) && $_POST['filter_criteria'] == 'date_issued' ? 'selected' : ''; ?>>Date Issued</option>
                                    <option value="booksissuedate" <?php echo isset($_POST['filter_criteria']) && $_POST['filter_criteria'] == 'booksissuedate' ? 'selected' : ''; ?>>Date Due</option>
                                    <option value="booksreturndate" <?php echo isset($_POST['filter_criteria']) && $_POST['filter_criteria'] == 'booksreturndate' ? 'selected' : ''; ?>>Books Return Date</option>
                                </select>
                            </div>
                            <div class="col-auto p-2">
                                <label for="start_date" class="col-form-label" style="font-size:medium;">From</label>
                            </div>
                            <div class="col-auto p-2" style="width:200px;">
                                <input type="date" name="start_date" class="form-control custom" placeholder="Start Date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>" required>
                            </div>
                            <div class="col-auto p-2">
                                <label for="start_date" class="col-form-label" style="font-size:medium;">To</label>
                            </div>
                            <div class="col-auto p-2" style="width:200px;">
                                <input type="date" name="end_date" class="form-control no-stretch-input" placeholder="End Date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>" required>
                            </div>
                            <div class="col-auto p-2">
                                <button type="submit" class="btn btn-danger btn-block">Filter</button>
                            </div>
                            <div class="col-auto p-2">
                            <button type="button" class="btn btn-secondary btn-block" onclick="resetFilter()">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Success or Error Messages -->
    <?php
if (!empty($_SESSION['success_message'])) {
    echo '<div class="alert alert-success" role="alert" id="success_message">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
}
if (!empty($_SESSION['success_msg'])) {
    echo '<div class="alert alert-success" role="alert" id="success_msg">' . $_SESSION['success_msg'] . '</div>';
    unset($_SESSION['success_msg']);
}
if (isset($_SESSION['error_msg'])) {
    echo '<div class="alert alert-danger" role="alert" id="error_msg">' . $_SESSION['error_msg'] . '</div>';
    unset($_SESSION['error_msg']);
}
?>

<script>
// Function to hide the display message after 3 seconds
function hideMessage() {
    setTimeout(function() {
        var successMessage = document.getElementById('success_message');
        var successMsg = document.getElementById('success_msg');
        var errorMessage = document.getElementById('error_msg');
        
        if (successMessage) {
            successMessage.style.display = 'none';
        }
        if (successMsg) {
            successMsg.style.display = 'none';
        }
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 2000); // 3000 milliseconds = 3 seconds
}

// Call the hideMessage function when the page loads
window.onload = hideMessage;
</script>

    
    <div class="card border-0">
        <div class="card-body">
            <table class="table table-hover text-left table-striped" id="dtBasicExample">
                <thead>
                    <tr>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <th>Email</th>
                        <th>Accession Number</th>
                        <th>Books Name</th>
                        <th>Date Issued</th>
                        <th>Date Due</th>
                        <th>Date Returned</th>
                        <th>Overdue</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
  
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . $row["student_number"] . "</td>";
                        echo "<td>" . $row["first_name"];"</td>";
                        echo "<td>" . $row["utype"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["accession_number"] . "</td>";
                        echo "<td>" . $row["booksname"] . "</td>";
                        echo "<td>" . $row["date_issued"] . "</td>";
                        echo "<td>" . $row["booksissuedate"] . "</td>";
                        echo "<td>" . $row["booksreturndate"] . "</td>";
                        echo "<td><a href='#' class='editFineLink' data-id='" . $row["id"] . "' data-amount='" . $row["fine"] . "' style='color: " . ($row["fine"] == 0 ? "" : "red") . "'>" . $row["fine"] . "</a></td>";
                        echo "<td><a href='#' class='editRemarksLink' data-id='" . $row["id"] . "' data-remarks='" . htmlspecialchars($row["remarks"], ENT_QUOTES) . "'>" . ($row["remarks"] ? $row["remarks"] : "n/a") . "</a></td>";
                        // echo "<td><a href='delete-fine.php?id=" . $row["id"] . "' style='color: red'><i class='fas fa-trash'></i></a> 
                        //             <span> <a href='paid-fine.php?id=" . $row["id"] . "' style='color: red'>Paid</a></span>
                        //     </td>";

                        echo "<td>" . ($row["status"] == "yes" ? "Paid" : "Not Paid") . "</td>";

                        echo "<td>";
                        echo "<div class='d-flex justify-content-center align-items-center'>";
                        echo "<a href='#' class='btn btn-success btn-sm ml-2 confirmPaidBtn' data-id='" . $row['id'] . "' data-username='" . $row['first_name'] . "'>Paid</a>";
                        // Rest of the code
                        echo "</div>";
                        echo "</td>";

                        
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            
        </div>
    </div>

 
    <!-- HTML form -->
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

<div class="modal fade" id="editFineModal" tabindex="-1" role="dialog" aria-labelledby="editFineModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFineModalLabel">Edit Fine Amount</h5>
            </div>
            <div class="modal-body">
                <form id="editFineForm">
                    <input type="hidden" id="fineId" name="fineId">
                    <div class="form-group">
                        <label for="fineAmount">Fine Amount:</label>
                        <input type="number" class="form-control" id="fineAmount" name="fineAmount">
                        <small id="fineAmountError" class="text-danger"></small> <!-- Error message placeholder -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="dismissFineModalBtn">Close</button>
                <button type="button" class="btn btn-danger" id="saveFineBtn">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Add this modal HTML code at the end of your HTML file, just before the closing body tag -->
<div class="modal fade" id="confirmPaidModal" tabindex="-1" role="dialog" aria-labelledby="confirmPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmPaidModalLabel">Confirmation</h5>
            </div>

            <div class="modal-body">
    Are you sure <span id="userName" style="color:#d52033"></span> has paid the fine?
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeConfirmPaidModalBtn">Cancel</button>
                <a id="confirmPaidButton" href="#" class="btn btn-success">Paid</a>
            </div>
        </div>
    </div>
</div>

<!-- Inside your PHP loop where you output the Paid/Not Paid buttons, add this JavaScript -->
<script>
$(document).ready(function() {
    // Function to handle "Paid" button click
    $('.confirmPaidBtn').click(function(e) {
        e.preventDefault();
        var fineId = $(this).data('id');
        var userName = $(this).data('username');
        // Set the user's name in the modal
        $('#userName').text(userName);
        // Set the href attribute of the confirmation button to the paid-fine.php script with the fine ID
        $('#confirmPaidButton').attr('href', 'paid-fine.php?id=' + fineId);
        // Show the confirmation modal
        $('#confirmPaidModal').modal('show');
    });

    // Function to handle close button click
    $('#closeConfirmPaidModalBtn').click(function() {
        // Hide the confirmation modal when close button is clicked
        $('#confirmPaidModal').modal('hide');
    });
});
</script>



<script>
     $(document).ready(function () {
        $('.editFineLink').click(function (e) {
            e.preventDefault();
            var fineAmount = $(this).data('amount');
            var fineId = $(this).data('id');
            $('#fineAmount').val(fineAmount);
            $('#fineId').val(fineId);
            $('#editFineModal').modal('show');
        });

        $('#saveFineBtn').click(function () {
            var fineAmount = $('#fineAmount').val();

            // Validate input
            if (!isValidFineAmount(fineAmount)) {
                $('#fineAmountError').text("Invalid input. Please enter a valid number.");
                return;
            }

            // If input is valid, proceed with saving changes
            var fineId = $('#fineId').val();
            window.location = 'update-fine.php?id=' + fineId + '&fine=' + fineAmount;
        });

        // Function to validate fine amount input
        function isValidFineAmount(amount) {
            // Use regex to check if the input is a valid number
            return /^\d+(\.\d{1,2})?$/.test(amount);
        }

        $('#dismissFineModalBtn').click(function () {
            $('#editFineModal').modal('hide');
        });

        // Handle pressing Enter key
        $('#fineAmount').keydown(function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $('#saveFineBtn').click(); // Trigger save button click event
            }
        });

        // Handle pressing Esc key
        $(document).keydown(function(event) {
            if (event.keyCode === 27) {
                $('#editFineModal').modal('hide'); // Hide the modal
            }
        });

        $('.editRemarksLink').click(function (e) {
            e.preventDefault();
            var remarksText = $(this).data('remarks');
            var remarksId = $(this).data('id');
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
            window.location = 'update-remarks.php?id=' + remarksId + '&remarks=' + encodeURIComponent(remarksText);
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

<script>
 $(document).ready(function () {
    var filterCriteria = '<?php echo isset($filter_criteria) ? $filter_criteria : "date_issued"; ?>';
    var orderColumn;
    
    switch (filterCriteria) {
        case "date_issued":
            orderColumn = 6; // Index for "Date Issued" column
            break;
        case "booksissuedate":
            orderColumn = 7; // Index for "Date Due" column
            break;
        case "booksreturndate":
            orderColumn = 8; // Index for "Books Return Date" column
            break;
        default:
            orderColumn = 6; // Default to "Date Issued" column
    }

    $('#dtBasicExample').DataTable({
        dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            {
                extend: 'excel',
                filename: '<?php echo $filename; ?>', // Dynamically set the filename
                text: 'Export Excel', // Change the label to "Export Excel"
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]               
                }
            },
        ],
        "lengthMenu": [[5, 10, 25, 50, 100, 500], [5, 10, 25, 50, 100, 500]],
        "order": [[orderColumn, 'asc']] // Order by the selected date criteria column
    });
});
function resetFilter() {
    // Reset start_date input
    document.getElementsByName("start_date")[0].value = ''; 
    // Reset end_date input
    document.getElementsByName("end_date")[0].value = ''; 
    // Reset the filter_criteria select element to its default value
    document.getElementsByName("filter_criteria")[0].value = 'date_issued'; 
    // Submit the form to fetch all data without filtering
    document.querySelector("#filterForm").submit(); 
    return false; // Prevent form submission
}
    
        </script>
<script>
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
    
<?php include 'inc/footer.php'; ?>
