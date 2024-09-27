<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
        <?php
    }
    $page = 'return-books';
    include 'inc/header.php';
    include 'inc/connection.php';
    if (isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {

        $start_date = mysqli_real_escape_string($link, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($link, $_POST['end_date']);
    
        $filter_criteria = $_POST['filter_criteria'];
    
        $query = "SELECT * FROM return_books WHERE $filter_criteria BETWEEN '$start_date' AND '$end_date' ORDER BY $filter_criteria ASC";
    
        // Set the filename based on the date range
        $filename = "return-books($start_date - $end_date)";    
    } else {
        // If start_date and end_date are not set, fetch all records
        $query = "SELECT * FROM return_books ORDER BY date_issued ASC"; // Default ordering by date_issued
        $filename = "return-books(all)";
    }
    
    $res = mysqli_query($link, $query);
    
    // Check if there are any results
    $num_rows = mysqli_num_rows($res);

    ?>
<style>

.no-stretch-input { 
    min-width: 0;
}

div.dt-buttons > .dt-button.buttons-excel {
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    background-color: #d52033; 
    border-color: #d52033; 
    color: #fff; 
    font-size: 1rem; 
    line-height: 1.5; 
    transition: background-color 0.3s ease; 
}

/* Hover effect */
div.dt-buttons > .dt-button.buttons-excel:hover {
    background-color: #c82333;
    border-color: #bd2130; 
}
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
</style>
<!-- Dashboard area -->
<main class="content px-3 py-2">



    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Return Books
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>
    <br>

    <?php
    // Display Success or Error Messages
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

        <!--dashboard area-->
        <form method="POST">
                <div class="col-md-12">
                    <div class="row text-center align-items-center justify-content-center"> <!-- Added justify-content-center for horizontal centering -->
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

    <div class="card border-0">
        <div class="card-body">
            <table class="table table-hover text-left table-striped" id="dtBasicExample">
                <thead>
                    <tr>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>User Type</th>
                        <!-- <th>Email</th> -->
                        <th>Accession Number</th>
                        <th>Books Name</th>
                        <th>Date Issued</th>
                        <th>Date Due</th>
                        <th>Date Returned</th>
                        <th>Issued By</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        // Fetch and display all data by default
                 
                        while ($row=mysqli_fetch_array($res)) {
                            echo "<tr>";
                            echo "<td>" . $row["student_number"] . "</td>";
                            echo "<td>" . $row["first_name"];"</td>";
                            echo "<td>" . $row["utype"] . "</td>";
                            // echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["accession_number"] . "</td>";
                            echo "<td>" . $row["booksname"] . "</td>";
                            echo "<td>" . $row["date_issued"] . "</td>";
                            echo "<td>" . $row["booksissuedate"] . "</td>";
                            echo "<td>" . $row["booksreturndate"] . "</td>";
                            echo "<td>" . $row["issuedby"] . "</td>";
                            echo "<td>";
                    ?>
                                <div class="d-flex justify-content-center">
                                    <a href="delete-return-book.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to archive this row?')"><span>Archive</span></a>
                                </div>
                    <?php 
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
    </div>

        <div class="text-end" style="padding:20px;">
                <button class="btn btn-danger" onclick="archiveAll()">Archive All</button>
        </div>  

    </div>
</main>

<script>
 $(document).ready(function () {
    var filterCriteria = '<?php echo isset($filter_criteria) ? $filter_criteria : "date_issued"; ?>';
    var orderColumn;
    
    switch (filterCriteria) {
        case "date_issued":
            orderColumn = 5; // Index for "Date Issued" column
            break;
        case "booksissuedate":
            orderColumn = 6; // Index for "Date Due" column
            break;
        case "booksreturndate":
            orderColumn = 7; // Index for "Books Return Date" column
            break;
        default:
            orderColumn = 5; // Default to "Date Issued" column
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


        window.setInterval(ut, 1000);

        function ut() {
            var d = new Date();
            document.getElementById("time").innerHTML = d.toLocaleTimeString();
            document.getElementById("date").innerHTML = d.toLocaleDateString();
        }

        function resetFilter() {
        document.getElementsByName("start_date")[0].value = ''; // Reset start_date input
        document.getElementsByName("end_date")[0].value = ''; // Reset end_date input
        document.querySelector("form").submit(); // Submit the form
        }
</script>


<script>
function archiveAll() {
    // Check if there are any records in the table
    var tableRows = document.querySelectorAll("#dtBasicExample tbody tr");
    
    if (tableRows.length === 1) {
        alert("No records found to archive.");
    } else {
        // Prompt the user for confirmation
        if (confirm("Are you sure you want to archive all return books?")) {
            // Submit a form to a PHP script to handle archiving
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'archive-all-return.php'; // Replace with your PHP script handling archiving

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'archive_all';
            input.value = '1';

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    }
}
</script>


<?php 
    include 'inc/footer.php';
?>
