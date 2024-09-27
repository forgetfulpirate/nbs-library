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

    // Check if both start_date and end_date are set
    if (isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
   
        $start_date = mysqli_real_escape_string($link, $_POST['start_date']);
        $end_date = mysqli_real_escape_string($link, $_POST['end_date']);


        $filter_criteria = $_POST['filter_criteria'];

        $query = "SELECT * FROM issue_book_archive WHERE $filter_criteria BETWEEN '$start_date' AND '$end_date' ORDER BY $filter_criteria ASC";

        // Set the filename based on the date range
        $filename = "borrowed-books($start_date - $end_date)";
    } else {
        // If start_date and end_date are not set, fetch all records
        $query = "SELECT * FROM issue_book_archive ORDER BY booksissuedate ASC"; // Default ordering by booksissuedate
        $filename = "borrowed-books(all)";
    }

    $res = mysqli_query($link, $query);


    $num_rows = mysqli_num_rows($res);

    // If no results found, display an alert
    if ($num_rows == 0) {
        // echo "<script>alert('No results found in the selected date range.');</script>";
    }
?>
<style>

    /* Style the Export Excel button */
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
        float: left;
    }

    /* Responsive adjustments */
    @media only screen and (max-width: 768px) {
        #time, #date, .h4 {
            font-size: 20px; 
            float: none; 
            text-align: center; 
            margin: 10px auto; 
        }
    }

</style>

<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Borrowed Books Report
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>
    <br>
    <!--dashboard area-->
    <form method="POST" id="filterForm">
        <div class="col-md-12">
            <div class="row text-center align-items-center justify-content-center"> <!-- Added justify-content-center for horizontal centering -->
                <div class="col-auto p-2">
                    <label for="filter_criteria" class="col-form-label" style="font-size:medium;">Filter By</label>
                </div>
                <div class="col-auto p-2" style="width:200px;">
                    <select name="filter_criteria" class="form-control custom">
                    <option value="booksissuedate" <?php echo isset($_POST['filter_criteria']) && $_POST['filter_criteria'] == 'booksissuedate' ? 'selected' : ''; ?>>Date Issued</option>
        <option value="booksreturndate" <?php echo isset($_POST['filter_criteria']) && $_POST['filter_criteria'] == 'booksreturndate' ? 'selected' : ''; ?>>Date Due</option>
                    </select>
                </div>
                <div class="col-auto p-2">
                    <label for="start_date" class="col-form-label" style="font-size:medium;">From</label>
                </div>
                <div class="col-auto p-2" style="width:200px;">
                    <input type="date" name="start_date" class="form-control custom" placeholder="Start Date" value="<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>">
                </div>
                <div class="col-auto p-2">
                    <label for="start_date" class="col-form-label" style="font-size:medium;">To</label>
                </div>
                <div class="col-auto p-2" style="width:200px;">
                    <input type="date" name="end_date" class="form-control no-stretch-input" placeholder="End Date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>">
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
                        <th>User Type</th>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Accession Number</th>
                        <th>Books Name</th>
                        <th>Date Issued</th>
                        <th>Date Due</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        while ($row = mysqli_fetch_array($res)) {
                            echo "<tr>";
                            echo "<td>" . $row["utype"] . "</td>";
                            echo "<td>" . $row["name"] . " " . $row["last_name"] . "</td>";
                            echo "<td>" . $row["student_number"] . "</td>";
                            echo "<td>" . $row["accession_number"] . "</td>";
                            echo "<td>" . $row["booksname"] . "</td>";
                            echo "<td>" . $row["booksissuedate"] . "</td>";
                            echo "<td>" . $row["booksreturndate"] . "</td>";
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
    var filterCriteria = '<?php echo isset($filter_criteria) ? $filter_criteria : "booksissuedate"; ?>';
    var orderColumn = filterCriteria === "booksissuedate" ? 5 : 6; // 5 is the index for "Date Issued" column, 6 is for "Date Due" column

    $('#dtBasicExample').DataTable({
        dom: '<html5buttons"B>1Tfgitp',
        buttons: [
            {
                extend: 'excel',
                filename: '<?php echo $filename; ?>', 
                text: 'Export Excel', // Change the label to "Export Excel"
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6]               
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

<?php 
    include 'inc/footer.php';
?>
