<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; 
}
include 'inc/connection.php';

// Check if ID and remarks are provided 
if(isset($_GET['accession_number']) && isset($_GET['remarks'])) {
    // Sanitize input
    $accession_number = mysqli_real_escape_string($link, $_GET['accession_number']);
    $remarks = mysqli_real_escape_string($link, $_GET['remarks']);

    // Update remarks in the database
    $query = "UPDATE book_module SET remarks = '$remarks' WHERE accession_number = '$accession_number'";
    $result = mysqli_query($link, $query);

    if($result) {
        // display with success message
        $_SESSION['success_message'] = "Remarks updated successfully";
        header("Location: display-book-module.php");
        exit;
    } else {
        // display with error message
        $_SESSION['error_message'] = "Error occurred while updating remarks";
        header("Location: display-book-module.php");
        exit;
    }
} else {
    // display with error message if ID or remarks are missing
    $_SESSION['error_message'] = "ID or remarks are missing";
    header("Location: display-book-module.php");
    exit;
}
?>
