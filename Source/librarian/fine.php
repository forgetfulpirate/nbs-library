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
            <h4>Overdue</h4>
            <p id="time"></p>
            <p id="date"></p>
        </div>
    </div>

    <form action="fine-receipt.php" method="post">
    <label for="student_number">Enter Student Number:</label>
    <input type="text" name="student_number" id="student_number" required>
    <button type="submit" name="generate_receipt">Generate Receipt</button>
</form>

    <div class="col-md-12">
    <div class="row text-center align-items-center justify-content-center"> <!-- Added justify-content-center for horizontal centering -->
        <div class="col-md-auto p-2"> <!-- Adjusted padding to add more space -->
            <label for="start_date" class="col-form-label" style="font-size:medium;">Filter Date</label>
        </div>
        <div class="col-md-2 p-2" style="width:200px;"> <!-- Adjusted padding to add more space -->
            <input type="date" id="start_date" class="form-control custom" placeholder="Start Date">
        </div>
        <div class="col-md-auto p-2"> <!-- Adjusted padding to add more space -->
            <label for="start_date" class="col-form-label" style="font-size:medium;">To</label>
        </div>
        <div class="col-md-2 p-2" style="width:200px;"> <!-- Adjusted padding to add more space -->
            <input type="date" id="end_date" class="form-control no-stretch-input" placeholder="End Date" style=""> 
        </div>
        <div class="col-md-auto p-2"> <!-- Adjusted padding to add more space -->
            <button class="btn btn-danger btn-block" onclick="filterByDateRange()">Filter</button>
        </div>
    </div>
</div>
        
        <div class="gap-30"></div>

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
        echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_msg'] . '</div>';
        unset($_SESSION['error_msg']);
    }
    ?>

    
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
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res = mysqli_query($link, "SELECT * FROM finezone");
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
                                              
                                                   ?>
                                  <div class="d-flex justify-content-center align-items-center">
                                        <a href="paid-fine.php?id=<?php echo $row["id"]; ?>" class="btn btn-success btn-sm ml-2" onclick="return confirm('Are you sure this student is paid?')" style="margin-right: 10px;"><span>Paid</span></a>
                                        <a href="not-paid-fine.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure this student is not paid?')"  style="margin-right: 0px; padding-right: 5px; padding-left: 5px;"><span style="margin-right:5px;">Not</span><span>Paid</span></a>
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
<!-- Modal for Print and PDF Download -->
<div class="modal fade" id="printReceiptModal" tabindex="-1" role="dialog" aria-labelledby="printReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header-center">
            <div style="display: flex; align-items: center; justify-content: center;">
                        <img src="inc/img/nbs-icon.png" alt="NBS College Library" style="width: 100px; height: 150px;  margin-right: 10px; margin:0;">
                        <div style="text-align: left; margin-left:20px;">
                            <p style="margin: 0; font-size:small;">NBS College Library, Sct. Borromeo corner Quezon Avenue, Diliman, Lungsod Quezon</p>
                            <p style="margin: 0; font-size:small;">Tel. (xxx) xxx-xxx; Cp No. (63+) xxx-xxx-xxx</p>
                            <p style="margin: 0; font-size:small;">library@nbscollege.edu.ph</p>
                        </div>
                    </div>
            </div>
            <div class="modal-body">
                <div class="receipt">
          
                    <div class="receipt-header">
                        <h3 style="font-weight:bold;">Library Fine Receipt</h3>
                    </div>
                    <div class="receipt-body">
                        <div class="receipt-section">
                            <p style="margin:0px;"><strong style="font-size:larger;">User Type:</strong> <span id="userType" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">User ID:</strong> <span id="userId" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Name:</strong> <span id="userName" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Accession No. Borrowed:</strong> <span id="accessionNo" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Book Name Borrowed:</strong> <span id="bookName" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Date Issued:</strong> <span id="dateIssued" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Date Due:</strong> <span id="dateDue" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Date Returned:</strong> <span id="dateReturned" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Amount:</strong> <span id="amount" style="font-size:16px;"></span></p>
                            <p style="margin:0px;"><strong style="font-size:larger;">Remarks:</strong> <span id="remarks" style="font-size:16px;"></span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="$('#printReceiptModal').modal('hide');">Close</button>
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                <button type="button" class="btn btn-danger" onclick="downloadPDF()">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT FOR PDF DOWNLOAD -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<!-- Add this script for html2canvas -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- SCRIPT FOR PRINT RECEIPT  -->
<script>
$(document).ready(function () {
    // Handle print button click for a specific user
    $('.printReceiptBtn').click(function () {
        // Get the row data
        var userType = $(this).closest('tr').find('td:eq(2)').text();
        var userId = $(this).closest('tr').find('td:eq(0)').text();
        var userName = $(this).closest('tr').find('td:eq(1)').text();
        var accessionNo = $(this).closest('tr').find('td:eq(4)').text();
        var bookName = $(this).closest('tr').find('td:eq(5)').text();
        var dateIssued = $(this).closest('tr').find('td:eq(6)').text();
        var dateDue = $(this).closest('tr').find('td:eq(7)').text();
        var dateReturned = $(this).closest('tr').find('td:eq(8)').text();
        var amount = $(this).closest('tr').find('td:eq(9)').text();
        var remarks = $(this).closest('tr').find('td:eq(10)').text();

        // Display the user details in the modal
        $('#userType').text(userType);
        $('#userId').text(userId);
        $('#userName').text(userName);
        $('#accessionNo').text(accessionNo);
        $('#bookName').text(bookName);
        $('#dateIssued').text(dateIssued);
        $('#dateDue').text(dateDue);
        $('#dateReturned').text(dateReturned);
        $('#amount').text(amount);
        $('#remarks').text(remarks);
        $('#printReceiptModal').modal('show');
    });

    // Function to print the receipt
    function printReceipt() {
        var receiptContent = document.getElementById('printReceiptModal').innerHTML;
        var originalContent = document.body.innerHTML;
        document.body.innerHTML = receiptContent;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload(); // Reload to restore the original content
    
        
    }

    // Function to download the receipt as PDF
    function downloadPDF() {
        var { jsPDF } = window.jspdf;
        $('.modal-footer').hide();


        html2canvas(document.querySelector("#printReceiptModal")).then(canvas => {
            var imgData = canvas.toDataURL('image/png');
            var pdf = new jsPDF('p', 'mm', 'a4');
            var imgWidth = 210; 
            var pageHeight = 295;  
            var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;

            var position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            pdf.save('receipt.pdf');
        });
    }

    window.printReceipt = printReceipt;
    window.downloadPDF = downloadPDF;
});
</script>

<script>
     $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [
                {
                    extend: 'copy',
                    filename: 'return-fine',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]   
                    }
                },
                {
                    extend: 'csv',
                    filename: 'return-fine',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]    
                    }
                },
                {
                    extend: 'excel',
                    filename: 'return-fine',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]  
                    }
                },
                {
                    extend: 'pdfHtml5',
                    filename: 'return-fine',
                    orientation: 'landscape', // Set orientation to landscape
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]   
                    }
                },
                {
                    extend: 'print',
                    filename: 'return-fine',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]  
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

<script>
function filterByDateRange() {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
    var tableRows = document.querySelectorAll("#dtBasicExample tbody tr");

    tableRows.forEach(function(row) {
        var returnedDate = row.cells[8].textContent; // Assuming the date returned is in the 9th cell, adjust index accordingly
        var dateReturned = new Date(returnedDate);
        var start = new Date(startDate);
        var end = new Date(endDate);

        // Adjust end date to include the entire end day
        end.setDate(end.getDate() + 1);

        // If start date is empty or the returned date is within the date range
        if ((startDate === "" || dateReturned >= start) && (endDate === "" || dateReturned < end)) {
            row.style.display = ""; // Show the row
        } else {
            row.style.display = "none"; // Hide the row
        }
    });
}

    
</script>

    
<?php include 'inc/footer.php'; ?>
