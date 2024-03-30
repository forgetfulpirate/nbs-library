
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'tbook';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>
            
    
            <main class="content px-3 py-2">
       
                <div class="container-fluid">
				<div class="mb-3">
                <div style="margin-bottom:10px;"></div>
                        <h4>Display Book
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
        
            
            <div class="card border-0">
                
                
                  
                 
                        <div class="card-body">
                            <table class="table table-striped table-hover text-center" id="dtBasicExample">
                                <thead>
                                    <tr>
                                        <th class="col">Books image</th>
                                        <th scope="col">Accession Number</th>
                                        <th scope="col">Date Received</th>
                                        <th scope="col">Call No.</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Title of Book</th>
                                        <th scope="col">Edition</th>
                                        <th scope="col">Volume</th>
                                        <th scope="col">Pages</th>
                                        <th scope="col">Source of Fund</th>
                                        <th scope="col">Cost of Price</th>
                                        <th scope="col">Publisher</th>
                                        <th scope="col">Place of Publication</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Remarks</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Call Number</th>
                                        <th scope="col">Location</th>
                                       

                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from book");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; ?><img src="<?php echo $row["book_image"]; ?> " height="100" width="80" alt="no cover available"> <?php echo "</td>";
                                            echo "<td>"; echo $row["accession_number"]; echo "</td>";
                                            echo "<td>"; echo $row["date_recieved"]; echo "</td>";
                                            echo "<td>"; echo $row["call_no"]; echo "</td>";
                                            echo "<td>"; echo $row["ISBN"]; echo "</td>";
                                            echo "<td>"; echo $row["author"]; echo "</td>";
                                            echo "<td>"; echo $row["title_of_book"]; echo "</td>";
                                            echo "<td>"; echo $row["edition"]; echo "</td>";
                                            echo "<td>"; echo $row["volume"]; echo "</td>";
                                            echo "<td>"; echo $row["pages"]; echo "</td>";
                                            echo "<td>"; echo $row["source_of_fund"]; echo "</td>";
                                            echo "<td>"; echo $row["cost_price"]; echo "</td>";
                                            echo "<td>"; echo $row["publisher"]; echo "</td>";
                                            echo "<td>"; echo $row["place_of_publication"]; echo "</td>";
                                            echo "<td>"; echo $row["year"]; echo "</td>";
                                            echo "<td>"; echo $row["remarks"]; echo "</td>";
                                            echo "<td>"; echo $row["program"]; echo "</td>";
                                            echo "<td>"; echo $row["call_number"]; echo "</td>";
                                            echo "<td>"; echo $row["location"]; echo "</td>";
                                            echo "</tr>";
                                        }
                                   ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                </div>
            
            </main>

        </div>
    </div>
    
    <script>
    $(document).ready(function () {
        
        $('#dtBasicExample').DataTable({
            dom: '<html5buttons"B>1Tfgitp',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape', // Set orientation to landscape
                    customize: function (doc) {
                        // Set page size and margins
                        doc.pageOrientation = 'landscape';
                        doc.pageSize = 'A3';
                        doc.pageMargins = [15, 15, 15, 15];
                    }
                },
                'copy',
                'csv',
                'excel',
                'print'
            ],
            "lengthMenu": [[5, 10, 25, 50, 100, 500], [5, 10, 25, 50, 100, 500]]
            
        });
        
    });
</script>
		
