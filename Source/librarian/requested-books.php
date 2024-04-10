<?php 
     session_start();
    if (!isset($_SESSION["username"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'rbook';
    include 'inc/header.php';
    include 'inc/connection.php';
    mysqli_query($link,"update request_books set read1='yes'");
 ?>

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
											<th scope="col" >Name</th>
											<th scope="col">Username</th>
											<th scope="col">User Type</th>								
											<th scope="col">Email</th>
											<th scope="col">Book Name</th>
											<th scope="col">Book Url</th>										
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $res= mysqli_query($link, "select * from request_books ORDER BY id DESC");
                                        while ($row=mysqli_fetch_array($res)) {
                                            $burl = $row['burl'];
                                            echo "<tr>";
                                            echo "<td>"; echo $row["name"]; echo "</td>";
                                            echo "<td>"; echo $row["username"]; echo "</td>";
                                            echo "<td>"; echo $row["utype"]; echo "</td>";
                                            echo "<td>"; echo $row["email"]; echo "</td>";
                                            echo "<td>"; echo $row["bname"]; echo "</td>";
                                            echo "<td>";
                                            ?><a href="<?php echo $burl; ?>" target="_blank">View</a><?php
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
				// dom: '<html5buttons"B>1Tfgitp',
                // buttons:['copy','csv','excel','pdf', 'print'],
                "lengthMenu": [[5,10, 25, 50, 100, 500], [5,10, 25, 50, 100, 500]]
			});
			
       
        });
    </script>

<?php 
		include 'inc/footer.php';
	 ?>