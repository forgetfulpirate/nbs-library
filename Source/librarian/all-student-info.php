
<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'sinfo';
    include 'inc/connection.php';
    include 'inc/header.php';
 ?>

<style>

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

    
            <main class="content px-3 py-2">
            <div class="gap-30"></div>
                <div class="container-fluid">
				<div class="mb-3">
          
                        <h4>Student Information  
                        <p id="time"></p>
                          
                            <p id="date"></p>
                        </h4>
                           
             
                 </div>
            </div>
            <br>
          
            <div class="card border-0">
                
                 
                        <div class="card-body">
                            <table class="table table-hover text-center table-striped" id="dtBasicExample">
                                <thead>
                                    <tr>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Year</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">verified</th>
                                        <th>Activate</th>
                                        <th>Deactivate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        $res= mysqli_query($link, "select * from student");
                                        while ($row=mysqli_fetch_array($res)) {
                                            echo "<tr>";
                                            echo "<td>"; echo $row["student_number"]; echo "</td>";
                                            echo "<td>"; echo $row["first_name"]; "<td>"; echo " "; echo $row["last_name"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["course"]; echo "</td>";
                                            echo "<td>"; echo $row["year"]; echo "</td>";
                                            echo "<td>"; echo $row["semester"]; echo "</td>";
                                            echo "<td>"; echo $row["verified"]; echo "</td>";
                                            echo "<td>";
                                            ?>
                                            <a href="approve.php?id=<?php echo $row["student_number"];?>" class='btn btn-success btn-sm'>Activate</a>
                                            <?php
                                            
                                            echo "</td>";
                                            echo "<td>";
                                            ?>
                                                <a href="notapprove.php?id=<?php echo $row["student_number"];?>" class='btn btn-danger btn-sm'>Deactivate</a>
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
        $(document).ready(function () {
            $('#dtBasicExample').DataTable({
        dom: '<"html5buttons"B>1Tfgitp',
        buttons: [
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(:nth-last-child(2)):not(:last-child)' // Exclude last column from copying
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':not(:nth-last-child(2)):not(:last-child)' // Exclude last column from CSV
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':not(:nth-last-child(2)):not(:last-child)' // Exclude last column from Excel
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':not(:nth-last-child(2)):not(:last-child)' // Exclude last column from PDF
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(:nth-last-child(2)):not(:last-child)' // Exclude last column from printing
                }
            }
        ],
        "lengthMenu": [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]]
    });
        });
    </script>	
    
    <script> 
         window.setInterval(ut, 1000);

        function ut() {
        var d = new Date();
        document.getElementById("time").innerHTML = d.toLocaleTimeString();
        document.getElementById("date").innerHTML = d.toLocaleDateString();
        }
        </script>

    
<?php 
		include 'inc/footer.php';
	 ?>


    

    
