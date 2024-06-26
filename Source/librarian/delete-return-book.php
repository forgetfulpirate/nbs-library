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

    // Fetch the returned book information from the return_books table
    $result = mysqli_query($link, "SELECT * FROM return_books WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

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

    // Delete the returned book information from the return_books table
    mysqli_query($link, "DELETE FROM return_books WHERE id=$id");

    $_SESSION['success_message'] = "Returned books archived successfully";
    ?>
    <script type="text/javascript">
        window.location="return-book.php";
    </script>
    <?php
}
?>
