<?php 
	include 'inc/connection.php';
	$id = $_GET["id"];
	$a  = date("m/d/Y");
    $res3 = mysqli_query($link, "select * from issue_book where id=$id");
    while($row3=mysqli_fetch_array($res3)){
		$username = $row3["username"];
		$utype = $row3["utype"];
		$email = $row3["email"];
        $booksname = $row3["booksname"];
        $brdate = $row3["booksreturndate"];
	}
    $datetime1 = strtotime($a);
    $datetime2 = strtotime($brdate);
    $difference = $datetime1 - $datetime2;
    $days_overdue = floor($difference / (60 * 60 * 24));
    $fine = $days_overdue * 10; // $10 fine for each day overdue
    if($fine > 0){
        mysqli_query($link, "insert into finezone values('','$username','$utype','$email','$booksname','$fine')");
    }
    $res4 = mysqli_query($link, "select * from t_issuebook where id=$id");
    while($row4=mysqli_fetch_array($res4)){
		$username = $row4["username"];
		$utype = $row4["utype"];
		$email = $row4["email"];
        $booksname = $row4["booksname"];
        $brdate = $row4["booksreturndate"];
	}
  
	$res = mysqli_query($link, "update t_issuebook set booksreturndate='$a' where id=$id");
	$res2 = mysqli_query($link, "update issue_book set booksreturndate='$a' where id=$id");

	$books_name="";
	$res = mysqli_query($link, "select  * from t_issuebook where id=$id");
    $res2 = mysqli_query($link, "select  * from issue_book where id=$id");
	while($row=mysqli_fetch_array($res)){
		$books_name = $row["booksname"];
	}
    while($row=mysqli_fetch_array($res2)){
		$books_name = $row["booksname"];
	}
	 mysqli_query($link, "update add_book set books_availability=books_availability+1 where books_name='$books_name'");
?>

 <script type="text/javascript">
 	window.location="issued-books.php";
 </script>
