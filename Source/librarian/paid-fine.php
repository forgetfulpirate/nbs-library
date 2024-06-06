<?php 
  session_start();
    include 'inc/connection.php';
    $id = $_GET["id"];

    

    // Check if the account is already activated or deactivated
    $fine_result = mysqli_query($link, "SELECT * FROM finezone WHERE id = $id");

    if (mysqli_num_rows($fine_result) > 0) {
        // If the ID corresponds to a student
        $fine_data = mysqli_fetch_assoc($fine_result);
        if ($fine_data['status'] == 'yes') {
            $_SESSION['error_msg'] = "The user already paid or 0 fine";
            echo "<script>window.location='fine.php';</script>";
        } elseif ($fine_data['status'] == 'no') {
            // Insert data into return_books
            $insert_query = "INSERT INTO return_books (first_name, last_name, middle_name, student_number, utype, email, booksname, accession_number, date_issued, booksissuedate, booksreturndate, issuedby) 
                             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";


            $stmt = mysqli_prepare($link, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $name, $last_name, $middle_name, $student_number, $utype, $email, $booksname, $accession_number, $date_issued, $booksissuedate, $booksreturndate, $issuedby);
        
            $name = $fine_data['first_name'];
            $last_name = $fine_data['last_name'];
            $middle_name = $fine_data['middle_name'];
            $student_number = $fine_data['student_number'];
            $utype = $fine_data['utype'];
            $email = $fine_data['email'];
            $booksname = $fine_data['booksname'];
            $accession_number = $fine_data['accession_number'];
            $date_issued = $fine_data['date_issued'];
            $booksissuedate = $fine_data['booksissuedate'];
            $booksreturndate = $fine_data['booksreturndate'];
            $issuedby = $fine_data['username'];
        
            mysqli_stmt_execute($stmt);
        
            // Insert data into return_history
            $insert_history_query = "INSERT INTO return_books_archive (first_name, last_name, middle_name, student_number, utype, email, booksname, accession_number, date_issued, booksissuedate, booksreturndate, issuedby) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt_history = mysqli_prepare($link, $insert_history_query);
            mysqli_stmt_bind_param($stmt_history, "ssssssssssss", $name, $last_name, $middle_name, $student_number, $utype, $email, $booksname, $accession_number, $date_issued, $booksissuedate, $booksreturndate, $issuedby);

            // Corrected variable binding
            $name = $fine_data['first_name'];
            $last_name = $fine_data['last_name'];
            $middle_name = $fine_data['middle_name'];
            $student_number = $fine_data['student_number'];
            $utype = $fine_data['utype'];
            $email = $fine_data['email'];
            $booksname = $fine_data['booksname'];
            $accession_number = $fine_data['accession_number'];
            $date_issued = $fine_data['date_issued'];
            $booksissuedate = $fine_data['booksissuedate'];
            $booksreturndate = $fine_data['booksreturndate'];
            $issuedby = $fine_data['username'];
        
            mysqli_stmt_execute($stmt_history);
        
            // Update status in finezone
            mysqli_query($link, "UPDATE finezone SET status='yes' WHERE id = $id");
            // Archive the record in issue_book_archive before deleting
            mysqli_query($link, "insert into finezone_archive select * from finezone where id=$id");
              // Delete from finezone
            mysqli_query($link, "DELETE FROM finezone WHERE id = $id");

        
            $_SESSION['success_msg'] = "The user paid successfully";
            echo "<script>window.location='fine.php';</script>";
            exit();
        }
    } 
?>
