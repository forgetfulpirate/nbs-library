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

// Check if the return_books table is empty
$result = mysqli_query($link, "SELECT COUNT(*) AS total FROM return_books");
$row = mysqli_fetch_assoc($result);
$total_return_books = $row['total'];

if ($total_return_books == 0) {
    $_SESSION['error_msg'] = "No return books found to archive.";
    header("Location: return-book.php");
    exit();
}

// Fetch all return books
$result = mysqli_query($link, "SELECT * FROM return_books");

// Loop through each return book and insert into return_books_archive
while ($row = mysqli_fetch_assoc($result)) {
    // Escape special characters in the values
    $first_name = mysqli_real_escape_string($link, $row['first_name']);
    $last_name = mysqli_real_escape_string($link, $row['last_name']);
    $middle_name = mysqli_real_escape_string($link, $row['middle_name']);
    $student_number = mysqli_real_escape_string($link, $row['student_number']);
    $utype = mysqli_real_escape_string($link, $row['utype']);
    $email = mysqli_real_escape_string($link, $row['email']);
    $booksname = mysqli_real_escape_string($link, $row['booksname']);
    $accession_number = mysqli_real_escape_string($link, $row['accession_number']);
    $date_issued = mysqli_real_escape_string($link, $row['date_issued']);
    $booksissuedate = mysqli_real_escape_string($link, $row['booksissuedate']);
    $booksreturndate = mysqli_real_escape_string($link, $row['booksreturndate']);
    $issuedby = mysqli_real_escape_string($link, $row['issuedby']);

    // Insert the returned book information into the return_books_archive table
    $insert_query = "INSERT INTO return_books_archive (first_name, last_name, middle_name, student_number, utype, email, booksname, accession_number, date_issued, booksissuedate, booksreturndate, issuedby) 
                    VALUES ('$first_name', '$last_name', '$middle_name', '$student_number', '$utype', '$email', '$booksname', '$accession_number', '$date_issued', '$booksissuedate', '$booksreturndate', '$issuedby')";
    mysqli_query($link, $insert_query);
}

// Delete all return books from return_books
mysqli_query($link, "DELETE FROM return_books");

$_SESSION['success_message'] = "All return books have been archived successfully.";
header("Location: return-book.php");
exit();
?>
