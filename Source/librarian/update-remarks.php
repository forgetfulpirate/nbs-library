<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; 
}

include 'inc/connection.php';

// Check if ID and remarks are provided 
if(isset($_GET['id']) && isset($_GET['remarks'])) {
    // Sanitize input
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $remarks = mysqli_real_escape_string($link, $_GET['remarks']);

    // Update remarks in the database
    $query = "UPDATE finezone SET remarks = '$remarks' WHERE id = '$id'";
    $result = mysqli_query($link, $query);

    if($result) {
        // display if success message
        $_SESSION['success_message'] = "Remarks updated successfully";
        header("Location: fine.php");
        exit;
    } else {
        // display if error message
        $_SESSION['error_message'] = "Error occurred while updating remarks";
        header("Location: fine.php");
        exit;
    }
} else {
    // Redirect with error message if ID or remarks are missing
    $_SESSION['error_message'] = "ID or remarks are missing";
    header("Location: fine.php");
    exit;
}
?>
