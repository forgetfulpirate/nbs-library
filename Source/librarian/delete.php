<?php
	  session_start();
      if (!isset($_SESSION["username"])) {
            ?>
                <script type="text/javascript">
                    window.location="login.php";
                </script>
            <?php
        }  
         
		
	include 'inc/connection.php';
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$accession_number = "";
		$res = mysqli_query($link, "select * from t_issuebook where id=$id");
		$res2 = mysqli_query($link, "select * from issue_book where id=$id");
		while($row=mysqli_fetch_array($res)){
			$accession_number = $row["accession_number"];
		}
		while($row=mysqli_fetch_array($res2)){
			$accession_number = $row["accession_number"];
		}
	
		// Delete entry from issue_book table
		mysqli_query($link, "DELETE FROM issue_book WHERE id=$id");
		mysqli_query($link, "DELETE FROM t_issuebook WHERE id=$id");
	
		// Update book availability in add_book table
		mysqli_query($link, "UPDATE book_module SET available=available+1 WHERE accession_number='$accession_number'");

		// Redirect with success message
		echo '<script type="text/javascript">  
					alert("Book cancel successfully");
					window.location="issued-books.php";
			  </script>';
	}
	else{
		?>
		<script type="text/javascript">
			window.location="issued-books.php";
		</script>
		<?php
	}


 ?>