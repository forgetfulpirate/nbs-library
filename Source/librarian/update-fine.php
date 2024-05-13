<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; // Stop further execution
}

// Include database connection
include 'inc/connection.php';

// Check if ID and fine amount are provided via GET method
if(isset($_GET['id']) && isset($_GET['fine'])) {
    // Sanitize input
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $fine = mysqli_real_escape_string($link, $_GET['fine']);

    // Update fine amount in the database
    $query = "UPDATE finezone SET fine = '$fine' WHERE id = '$id'";
    $result = mysqli_query($link, $query);

    if($result) {
        // Redirect with success message
        $_SESSION['success_message'] = "Fine amount updated successfully";
        header("Location: fine.php");
        exit;
    } else {
        // Redirect with error message
        $_SESSION['error_message'] = "Error occurred while updating fine amount";
        header("Location: returned-books.php");
        exit;
    }
} else {
    // Redirect with error message if ID or fine amount is missing
    $_SESSION['error_message'] = "ID or fine amount is missing";
    header("Location: fine.php");
    exit;
}
?>
