<?php 
     session_start();
    if (!isset($_SESSION["teacher"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'finezone';
    include 'inc/header.php';
    include 'inc/connection.php';

      // Initialize a variable to track if the student has a fine greater than zero
     // Fetch fine information
     $res1 = mysqli_query($link, "SELECT * FROM finezone WHERE student_number='".$_SESSION['teacher']."' ORDER BY id DESC");

     // Check if the user has any fine with status "paid"
     $hasUnpaidFine = false;
     while ($row = mysqli_fetch_array($res1)) {
         if ($row["fine"] > 0 && $row["status"] == "no") {
             $hasUnpaidFine = true;
             break;
         }
     }
     
 ?>

<main class="content px-3 py-2">
    <div class="gap-30"></div>
    <div class="container-fluid">
        <div class="mb-3">
            <h4>My Overdue</h4>
            <p id="time"></p>
            <p id="date"></p>
        </div>
    </div>
    
    <div class="card border-0">
        <div class="card-body">
            <table class="table table-hover text-left table-striped" id="dtBasicExample">
            <thead>
								   <tr>
                                        <th>Student number</th>
                                        <th>Name</th>
										<th>Accession Number</th>
                                        <th>Books Name</th>
                                        <th>Issued Date</th>
                                        <th>Date due</th>
                                        <th>Date Returned</th>
                                        <th>Fine</th>
                                        <th>Status</th>
								   </tr>
								</thead>
                                <tbody>
						
                                <?php 
                                    // Display fine records
                                    $res1 = mysqli_query($link, "SELECT * FROM finezone WHERE student_number='".$_SESSION['teacher']."' ORDER BY id DESC");
                                    while ($row = mysqli_fetch_array($res1)) {
                                        if ($row["fine"] > 0 && $row["status"] == "no") {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["student_number"]; echo "</td>";
                                            echo "<td>"; echo $row["first_name"];echo "</td>";
                                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                            echo "<td>"; echo $row["booksname"]; echo "</td>";
                                            echo "<td>"; echo $row["date_issued"]; echo "</td>";
                                            echo "<td>"; echo $row["booksissuedate"]; echo "</td>";
                                            echo "<td>"; echo $row["booksreturndate"]; echo "</td>";
                                            echo "<td style='color:red'>"; echo $row["fine"]; echo "</td>";
                                            echo "<td>";
                                            if ($row["status"] == "no") {
                                                echo "Not paid";
                                            } else {
                                                echo $row["status"];
                                            }
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
							  </tbody>
							</table>
        </div>
    </div>
</main>

	
	<?php 
		include 'inc/footer.php';
	 ?>
    <script>
        $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
        });
    </script>