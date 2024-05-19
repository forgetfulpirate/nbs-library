<?php 
    include 'inc/connection.php';
    $id = $_GET["id"];
    $a  = date("Y-m-d");

    // Fetch data from issue_book table
    $res3 = mysqli_query($link, "select * from issue_book where id=$id");
    while($row3=mysqli_fetch_array($res3)){

        $name = $row3["name"];
		$student_number = $row3["student_number"];
        $last_name = $row3["last_name"];
        $middle_name = $row3["middle_name"];
        $utype = $row3["utype"];
        $email = $row3["email"];
        $accession_number = $row3["accession_number"];
        $booksname = $row3["booksname"];
        $brdate = $row3["booksreturndate"];
        $booksissuedate = $row3["booksissuedate"];
    }

    // Fetch data from t_issuebook table
    $res4 = mysqli_query($link, "select * from t_issuebook where id=$id");
    while($row4=mysqli_fetch_array($res4)){
        $name = $row4["name"];
        $student_number = $row3["student_number"];
        $utype = $row4["utype"];
        $email = $row4["email"];
        $booksname = $row4["booksname"];
        $brdate = $row4["booksreturndate"];
    }


    // Calculate fine for overdue books
    $datetime1 = strtotime($a);
    $datetime2 = strtotime($brdate);
    $difference = $datetime1 - $datetime2;
    $days_overdue = floor($difference / (60 * 60 * 24));
    $fine = $days_overdue * 5; // $5 fine for each day overdue

    // Insert fine information into finezone table
    if($fine > 0){
        mysqli_query($link, "insert into finezone values('','$name','$last_name','$middle_name','$student_number','$utype','$email','$booksname','$accession_number','$booksissuedate','$brdate','$a','$fine', '')");
    } else {
        mysqli_query($link, "insert into finezone values('','$name','$last_name','$middle_name','$student_number','$utype','$email','$booksname', '$accession_number','$booksissuedate','$brdate','$a','0','')");
    }

    // Update return date in t_issuebook and issue_book tables
    mysqli_query($link, "update t_issuebook set booksreturndate='$a' where id=$id");
    mysqli_query($link, "update issue_book set booksreturndate='$a' where id=$id");

    // Fetch book name for updating availability
    $accession_number = "";
    $res = mysqli_query($link, "select  * from t_issuebook where id=$id");
    $res2 = mysqli_query($link, "select  * from issue_book where id=$id");
    while($row=mysqli_fetch_array($res)){
        $accession_number = $row["accession_number"];
    }
    while($row=mysqli_fetch_array($res2)){
        $accession_number = $row["accession_number"];
    }

    // Update book availability in add_book table
	mysqli_query($link, "update book_module set available=available+1 where accession_number='$accession_number'");



    // Delete entry from issue_book table
    mysqli_query($link, "DELETE FROM issue_book WHERE id=$id");
	mysqli_query($link, "DELETE FROM t_issuebook WHERE id=$id");

    // Redirect with success message
    echo '<script type="text/javascript">  
                alert("Book returned successfully");
                window.location="issued-books.php";
          </script>';
?>
