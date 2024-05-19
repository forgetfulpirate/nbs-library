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
?>

<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Returned Books</h4>
            <p id="time"></p>
            <p id="date"></p>
        </div>
    </div>

    <!-- Display Success or Error Messages -->
    <?php
    if (!empty($_SESSION['success_message'])) {
        echo '<div class="alert alert-success" role="alert" id="success_message">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    if (isset($_SESSION['error_msg'])) {
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_msg'] . '</div>';
        unset($_SESSION['error_msg']);
    }
    ?>

    
    <div class="card border-0">
        <div class="card-body">
            <table class="table table-hover text-center table-striped" id="dtBasicExample">
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
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($link, "SELECT * FROM finezone");
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td>" . $row["student_number"] . "</td>";
                        echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
                        echo "<td>" . $row["utype"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["accession_number"] . "</td>";
                        echo "<td>" . $row["booksname"] . "</td>";
                        echo "<td>" . $row["date_issued"] . "</td>";
                        echo "<td>" . $row["booksissuedate"] . "</td>";
                        echo "<td>" . $row["booksreturndate"] . "</td>";
                        echo "<td><a href='#' class='editFineLink' data-id='" . $row["id"] . "' data-amount='" . $row["fine"] . "' style='color: " . ($row["fine"] == 0 ? "" : "red") . "'>" . $row["fine"] . "</a></td>";
                        echo "<td><a href='#' class='editRemarksLink' data-id='" . $row["id"] . "' data-remarks='" . htmlspecialchars($row["remarks"], ENT_QUOTES) . "'>" . ($row["remarks"] ? $row["remarks"] : "n/a") . "</a></td>";
                        echo "<td><a href='delete-fine.php?id=" . $row["id"] . "' style='color: red'><i class='fas fa-trash'></i></a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

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
        buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude last column from copying
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude last column from CSV
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude last column from Excel
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape', // Set orientation to landscape
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude last column from PDF
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude last column from printing
                    }
                }
            ],
            "lengthMenu": [[5, 25, 50, 100, 500], [5, 25, 50, 100, 500]]
        });

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

<?php include 'inc/footer.php'; ?>
