<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit; 
}

include 'inc/connection.php';

// Check if ID and fine amount are provided via GET method
if(isset($_GET['id']) && isset($_GET['fine'])) {
    // Sanitize input
    $id = mysqli_real_escape_string($link, $_GET['id']);
    $fine = mysqli_real_escape_string($link, $_GET['fine']);

    // Fetch the current status from the database
    $status_query = "SELECT status FROM finezone WHERE id = '$id'";
    $status_result = mysqli_query($link, $status_query);
    $row = mysqli_fetch_assoc($status_result);
    $current_status = $row['status'];

    // Check if the fine amount is being updated to zero
    if ($fine == 0) {
        // If the fine amount is zero, set the status to 'yes'
        $status = 'yes';
    } else {
        // For non-zero fine amounts, update the status based on the current status
        if ($current_status == 'yes') {
            // If status is already 'yes', keep it as 'yes'
            $status = 'yes';
        } else {
            // For all other cases, update the status to 'no'
            $status = 'no';
        }
    }

    // Update fine amount and status in the database
    $query = "UPDATE finezone SET fine = '$fine', status = '$status' WHERE id = '$id'";
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
