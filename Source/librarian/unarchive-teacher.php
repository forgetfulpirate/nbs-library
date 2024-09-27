<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}


include 'inc/connection.php';

// Check if id_number parameter is set
if (isset($_GET["id_number"])) {
    $id_number = $_GET["id_number"]; // Correct variable name

    // Check if the teacher with the same id_number already exists in the teacher table
    $checkQuery = "SELECT * FROM teacher WHERE id_number = '$id_number'";
    $checkResult = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // If the teacher with the same id_number already exists, set an error message and redirect
        $_SESSION['error_msg'] = "Cannot unarchive user. User with the same ID number already exists.";
        header("Location: archive-user.php");
        exit();
    }

    // Retrieve user data from teacher_archive table
    $query = "SELECT * FROM teacher_archive WHERE id_number = '$id_number'";
    $result = mysqli_query($link, $query);

    // Check if query was successful and if there are results
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert retrieved user data into teacher table
        $insertQuery = "INSERT INTO teacher (id_number, first_name, last_name, middle_name, email, dept, password, user_type, photo, status, vkey, verified) VALUES ('" . $row['id_number'] . "', '" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['middle_name'] . "', '" . $row['email'] . "', '" . $row['dept'] . "', '" . $row['password'] . "', '" . $row['user_type'] . "', '" . $row['photo'] . "', '" . 'no' . "', '" . $row['vkey'] . "', '" . 'no' . "')";

        // Execute the insertion query
        if (mysqli_query($link, $insertQuery)) {
            // If insertion is successful, remove the user data from the archive table
            $deleteQuery = "DELETE FROM teacher_archive WHERE id_number = '$id_number'";
            mysqli_query($link, $deleteQuery);

            // Set success message
            $_SESSION['success_msg'] = "User successfully unarchived!";
        } else {
            // Set error message if insertion fails
            $_SESSION['error_msg'] = "Failed to unarchive user. Please try again later.";
        }
    } else {
        // Set error message if user is not found in the archive
        $_SESSION['error_msg'] = "User not found in the archive.";
    }
} else {
    // Set error message for invalid request
    $_SESSION['error_msg'] = "Invalid request.";
}

// Redirect to archive-user.php regardless of success or failure
header("Location: archive-user.php");
exit();
?>
