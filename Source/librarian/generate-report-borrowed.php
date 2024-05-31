<?php 
    session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = '';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
<!--dashboard area-->

<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Generate Report Borrowed Books
                <p id="time"></p>
                <p id="date"></p>
            </h4>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row text-center align-items-center justify-content-center">
     
            <div class="col-md-auto p-2">
       
                <label for="start_date" class="col-form-label" style="font-size:medium;">Filter Date</label>
            </div>
            <div class="col-md-2 p-2" style="width:200px;">
               
                <input type="date" id="start_date" class="form-control custom" placeholder="Start Date" required>
            </div>
            <div class="col-md-auto p-2">
             
                <label for="start_date" class="col-form-label" style="font-size:medium;">To</label>
            </div>
            <div class="col-md-2 p-2" style="width:200px;">
             
                <input type="date" id="end_date" class="form-control no-stretch-input" placeholder="End Date" required>
            </div>
            <div class="col-md-auto p-2">
            
                <button class="btn btn-danger btn-block" onclick="filterByDateRange()">Filter</button>
            </div>
        </div>
    </div>

    <div class="gap-30"></div>

    <div class="card border-0" id="bookTable" style="display: none;">
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
                        $res= mysqli_query($link, "select * from issue_book_archive");
                        while ($row=mysqli_fetch_array($res)) {
                            echo "<tr>";
                            echo "<td>"; echo $row["utype"]; echo "</td>";
                            echo "<td>"; echo $row["name"]; echo " "; echo $row["last_name"]; echo "</td>";
                            echo "<td>"; echo $row["student_number"]; echo "</td>";
                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                            echo "<td>"; echo $row["booksname"]; echo "</td>";
                            echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                            echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                          
                 
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
        var foundResults = false; // Variable to track if any results were found

        if (startDate === "" || endDate === "") {
            alert("Please select both start and end dates.");
            return;
        }

        var tableRows = document.querySelectorAll("#dtBasicExample tbody tr");

        tableRows.forEach(function(row) {
            var issuedDate = row.cells[5].textContent;
            var dateIssued = new Date(issuedDate);
            var start = new Date(startDate);
            var end = new Date(endDate);
            end.setDate(end.getDate() + 1);

            if ((dateIssued >= start) && (dateIssued < end)) {
                row.style.display = ""; // Show the row
                foundResults = true; // Mark that results were found
            } else {
                row.style.display = "none"; // Hide the row
            }
        });

        if (!foundResults) {
            alert("No data found for the selected date range."); // Alert if no results were found
            document.getElementById("bookTable").style.display = "none"; // Hide the table
        } else {
            document.getElementById("bookTable").style.display = "block"; // Show the table
        }
    }
</script>



<script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable({
                dom: '<html5buttons"B>1Tfgitp',
        buttons: [
               
            
                {
                    extend: 'excel',
                    filename: 'book-borrowed-report',
                   
                },
            
              
            ],
            "lengthMenu": [[5, 25, 50, 100, 500], [5, 25, 50, 100, 500]]
        });
    });
</script>

<?php 
    include 'inc/footer.php';
?>
