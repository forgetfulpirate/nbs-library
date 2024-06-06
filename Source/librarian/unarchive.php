<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include 'inc/connection.php';

if (isset($_GET["student_number"])) {
    $student_number = $_GET["student_number"];

    // Check if the student with the same student_number already exists in the student table
    $checkQuery = "SELECT * FROM student WHERE student_number = '$student_number'";
    $checkResult = mysqli_query($link, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // If the student with the same student_number already exists, display an error message
        $_SESSION['error_msg'] = "Cannot unarchive user. User with the same student number already exists.";
        header("Location: archive-user.php");
        exit();
    }

    // Retrieve user data from student_archive table
    $query = "SELECT * FROM student_archive WHERE student_number = '$student_number'";
    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert retrieved user data into the student table
        $insertQuery = "INSERT INTO student (student_number, first_name, last_name, middle_name, email, course, year, semester, password, user_type, photo, status, vkey, verified) VALUES ('" . $row['student_number'] . "', '" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['middle_name'] . "', '" . $row['email'] . "', '" . $row['course'] . "', '" . $row['year'] . "', '" . $row['semester'] . "', '" . $row['password'] . "', '" . $row['user_type'] . "', '" . $row['photo'] . "', '" . 'no' . "', '" . $row['vkey'] . "', '" . 'no' . "')";

        if (mysqli_query($link, $insertQuery)) {
            // If insertion is successful, remove the user data from the archive table
            $deleteQuery = "DELETE FROM student_archive WHERE student_number = '$student_number'";
            mysqli_query($link, $deleteQuery);

            $_SESSION['success_msg'] = "User successfully unarchived!";
            header("Location: archive-user.php");
            exit();
        } else {
            $_SESSION['error_msg'] = "Failed to unarchive user. Please try again later.";
            header("Location: archive-user.php");
            exit(); 
        }
    } else {
        $_SESSION['error_msg'] = "User not found in the archive.";
        header("Location: archive-user.php");
        exit();
    }
} else {
    $_SESSION['error_msg'] = "Invalid request.";
    header("Location: archive-user.php");
    exit();
}
?>
