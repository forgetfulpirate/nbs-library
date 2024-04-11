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
		$books_name = "";
		$res = mysqli_query($link, "select * from t_issuebook where id=$id");
		$res2 = mysqli_query($link, "select * from issue_book where id=$id");
		while($row=mysqli_fetch_array($res)){
			$books_name = $row["booksname"];
		}
		while($row=mysqli_fetch_array($res2)){
			$books_name = $row["booksname"];
		}
	
		// Delete entry from issue_book table
		mysqli_query($link, "DELETE FROM issue_book WHERE id=$id");
		mysqli_query($link, "DELETE FROM t_issuebook WHERE id=$id");
	
		// Update book availability in add_book table
		mysqli_query($link, "UPDATE book SET books_availability=books_availability+1 WHERE title_of_book='$books_name'");
		mysqli_query($link, "UPDATE add_book SET books_availability=books_availability+1 WHERE books_name='$books_name'");
	
		// Redirect with success message
		echo '<script type="text/javascript">  
					alert("Book returned successfully");
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