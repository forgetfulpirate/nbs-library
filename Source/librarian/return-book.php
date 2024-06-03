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
?>
<style>
    /* Custom CSS to prevent stretching of input fields */
.no-stretch-input {
    min-width: 0;
}
/* Change color of Export Excel button to btn-danger */
/* Style the Export Excel button */
div.dt-buttons > .dt-button.buttons-excel {
    padding: 0.375rem 0.75rem;
    border-radius: 0.25rem;
    background-color: #d52033; /* Red color of btn-danger */
    border-color: #d52033; /* Border color */
    color: #fff; /* Text color */
    font-size: 1rem; /* Font size */
    line-height: 1.5; /* Line height */
    transition: background-color 0.3s ease; /* Smooth transition for hover effect */
}

/* Hover effect */
div.dt-buttons > .dt-button.buttons-excel:hover {
    background-color: #c82333; /* Darker shade of red on hover */
    border-color: #bd2130; /* Darker border color on hover */
}
</style>
<!-- Dashboard area -->
<main class="content px-3 py-2">
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

    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Returned Books</h4>
            <p id="time"></p>
            <p id="date"></p>
        </div>
        <div class="gap-30"></div>

    </div>

    <div class="col-md-12">
    <div class="row text-center align-items-center justify-content-center"> <!-- Added justify-content-center for horizontal centering -->
    <div class="col-auto p-2">
                    <label for="start_date" class="col-form-label" style="font-size:medium;">Filter Date</label>
                </div>
                <div class="col-auto p-2" style="width:200px;">
                    <input type="date" id="start_date" class="form-control custom" placeholder="Start Date">
                </div>
                <div class="col-auto p-2">
                    <label for="start_date" class="col-form-label" style="font-size:medium;">To</label>
                </div>
                <div class="col-auto p-2" style="width:200px;">
                    <input type="date" id="end_date" class="form-control no-stretch-input" placeholder="End Date">
                </div>
                <div class="col-auto p-2">
                    <button class="btn btn-danger btn-block" onclick="filterByDateRange()">Filter</button>
                </div>
    </div>
</div>
        
        <div class="gap-30"></div>


    
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
                        $res= mysqli_query($link, "select * from return_books");
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
                                    <a href="delete-return-book.php?id=<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm ml-2" onclick="return confirm('Are you sure you want to delete this row?')"><span>Delete</span></a>
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
function filterByDateRange() {
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
    var tableRows = document.querySelectorAll("#dtBasicExample tbody tr");

    tableRows.forEach(function(row) {
        var returnedDate = row.cells[7].textContent; // Assuming the date returned is in the 9th cell, adjust index accordingly
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



<script>
         $(document).ready(function () {
            $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [

            // {
            //     extend: 'csv',
            //     filename: 'return-books',
            //     exportOptions: {
            //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]                
            //     }
            // },
            {
                extend: 'excel',
                filename: 'return-books',
                text: 'Export Excel', // Change the label to "Export Excel"
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]               
                 }
            },
 
            
        ],
        "lengthMenu": [[5,10, 25, 50, 100, 500], [5,10, 25, 50, 100, 500]]
    });
        });
</script>

<?php 
    include 'inc/footer.php';
?>
