<?php 
     session_start();
    if (!isset($_SESSION["student"])) {
        ?>
            <script type="text/javascript">
                window.location="login.php";
            </script>
        <?php
    }
    $page = 'ebooks';
    include 'inc/header.php';
    include 'inc/connection.php';
 ?>
	<!--dashboard area-->
	<div class="dashboard-content">
		<div class="dashboard-header">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="left">
							<p><span>dashboard</span>User panel</p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="right text-right">
							<a href="dashboard.php"><i class="fas fa-home"></i>home</a>
							<span class="disabled">books</span>
						</div>
					</div>
				</div>
				<div class="books">
					<form action="" method="post" name="form1">
						<table class="table ">
							<tr>
								<td>
									<input type="text" name="search" class="form-control" placeholder="Enter book name">
								</td>
								<td>
									 <input type="submit" name="submit1" class="btn btn-info" value="Search Book">
								</td>
                                
							</tr>
						</table>
                    </form>
                    <?php
                        if (isset($_POST["submit1"])) {
                            $i=0;
                            $res = mysqli_query($link,"select * from ebook where author like('$_POST[search]%')");
                            $res = mysqli_query($link,"select * from ebook where accession_number like('$_POST[search]%')");
                            $res = mysqli_query($link,"select * from ebook where title like('$_POST[search]%')");
                            echo "<table class='table control-books'>";
                            echo "<tr>";
                            while ($row = mysqli_fetch_array($res)){
                                 $i=$i+1;
                                 echo "<td>";
                                
                                 echo "</br>";
                                 echo "</br>";
                                 echo "<img src=>";
                                 echo "<b>".$row["author"]; "</b>";
                                 echo "<br>";
                                 echo "<b>".$row["title"]; "</b>";
                                 echo "</br>";
                            
                                 echo "</td>";

                                 if ($i>=1) {
                                     echo "</tr>";
                                     echo "<tr>";
                                     $i=0;
                                 }

                        }
                        echo "</tr>";
                        echo "</table>";
                        }
                        else{
                            $i=0;
                            $res = mysqli_query($link,"select * from ebook");
                            echo "<table id='dtBasicExample' class='table control-books'>";
                            echo "<tr>";
                            while ($row = mysqli_fetch_array($res)){
                                 $i=$i+1;
                               
                                   echo "<td>";
                                
                                 echo "</br>";
                                 echo "</br>";
                                 echo "<img src=>";
                                 echo "<b>".$row["author"]; "</b>";
                                 echo "<br>";
                                 echo "<b>".$row["title"]; "</b>";
                                 echo "</br>";
                            
                                 echo "</td>";

                                 if ($i>=1) {
                                     echo "</tr>";
                                     echo "<tr>";
                                     $i=0;
                                 }

                            }
                            echo "</tr>";
                            echo "</table>";
                            }
                     ?>
				</div>
			</div>					
		</div>
	</div>
	
 <script>
    $(document).ready(function () {
    $('#dtBasicExample').DataTable({
            "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]],
            "paging": true
        });

    });
  </script>