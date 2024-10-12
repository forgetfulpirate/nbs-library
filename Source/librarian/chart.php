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
    include 'inc/header.php';  // Include header
    include 'inc/connection.php';  // Include the connection file

    // Get the current month and year
    $current_month = date('m');
    $current_year = date('Y');

    // Check if both month and year are set
    if (isset($_POST['month']) && isset($_POST['year']) && !empty($_POST['month']) && !empty($_POST['year'])) {
        $month = mysqli_real_escape_string($link, $_POST['month']);
        $year = mysqli_real_escape_string($link, $_POST['year']);
        $start_date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';  // Construct the first day of the selected month
        
        // Query to fetch data for the selected month and year
        $query = "
            SELECT student_number, name, COUNT(*) AS total
            FROM issue_book_archive
            WHERE booksissuedate BETWEEN '$start_date' AND LAST_DAY('$start_date')
            GROUP BY student_number, name
            ORDER BY student_number ASC";
        
        $filename = "borrowed-books($month-$year)";
    } else {
        // If month and year are not set, fetch all records (default)
        $query = "SELECT student_number, name, COUNT(*) AS total
                  FROM issue_book_archive
                  GROUP BY student_number, name
                  ORDER BY student_number ASC";  // Default ordering by student_number
        $filename = "borrowed-books(all)";
    }

    $res = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($res);

    // Initialize arrays to store data for the chart
    $student_numbers = [];
    $totals = [];
    $names = [];

    // Fetch the results and store them in the arrays for the chart
    if ($num_rows > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $student_numbers[] = $row["student_number"];
            $names[] = $row["name"];
            $totals[] = (int)$row["total"];  // Ensure it's an integer
        }
    }

    // Convert PHP arrays to JavaScript arrays
    $student_numbers_json = json_encode($student_numbers);
    $names_json = json_encode($names);
    $totals_json = json_encode($totals);
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

    /* Flexbox container to center the dropdowns and button */
    .form-container {
        display: flex;
        justify-content: center; /* Center the items horizontally */
        align-items: center;     /* Vertically align the items */
        gap: 20px;              /* Space between the elements */
        margin-top: 20px;        /* Space from top */
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
            <h4>Borrowed Books Report</h4>
            <form method="POST" action="">
        <label for="month">Select Month:</label>
        <select name="month" id="month" required>
            <option value="">--Select Month--</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $month_value = str_pad($i, 2, '0', STR_PAD_LEFT);
                $selected = (isset($_POST['month']) && $_POST['month'] == $month_value) ? 'selected' : '';
                echo "<option value=\"$month_value\" $selected>" . date('F', mktime(0, 0, 0, $i, 1)) . "</option>";
            }
            ?>
        </select>

        <label for="year">Select Year:</label>
        <select name="year" id="year" required>
            <option value="">--Select Year--</option>
            <?php
            for ($i = 2020; $i <= date('Y'); $i++) { // Adjust the year range as needed
                $selected = (isset($_POST['year']) && $_POST['year'] == $i) ? 'selected' : '';
                echo "<option value=\"$i\" $selected>$i</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

        </div>
    </div>

    <!-- Chart.js Canvas for the Dynamic Chart -->
    <div class="card border-0">
        <div class="card-body">
            <canvas id="borrowedBooksChart"></canvas>
        </div>
    </div>
</main>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Convert PHP arrays to JavaScript arrays
var studentNumbers = <?php echo $student_numbers_json; ?>;
var names = <?php echo $names_json; ?>;
var totals = <?php echo $totals_json; ?>;

// Create a chart
var ctx = document.getElementById('borrowedBooksChart').getContext('2d');
var borrowedBooksChart = new Chart(ctx, {
    type: 'bar', // Bar chart
    data: {
        labels: names, // Student names or numbers
        datasets: [{
            label: 'Total Books Borrowed',
            data: totals, // Total number of books borrowed by each student
            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Light green color
            borderColor: 'rgba(75, 192, 192, 1)', // Dark green border
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true, // Ensure the y-axis starts at 0
                title: {
                    display: true,
                    text: 'Total Books Borrowed'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Student Names'
                }
            }
        },
        plugins: {
            legend: {
                display: true
            },
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return tooltipItem.raw + ' books';
                    }
                }
            }
        }
    }
});
</script>

<?php 
    include 'inc/footer.php';
?>
