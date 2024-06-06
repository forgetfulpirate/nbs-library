<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

// Include database connection
include 'inc/connection.php';

// Check if id parameter is set
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Retrieve student data from student table
    $result = mysqli_query($link, "SELECT * FROM student WHERE student_number=$id");
    
    // Check if retrieval was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        // Check if the student with the same student_number already exists in the student_archive table
        $checkQuery = "SELECT * FROM student_archive WHERE student_number = '$id'";
        $checkResult = mysqli_query($link, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // If the student with the same student_number already exists in the student_archive table, set an error message and redirect
            $_SESSION['error_msg'] = "Cannot archive student. Student with the same ID number already exists in the archive.";
            echo '<script type="text/javascript">window.location="all-student-info.php";</script>';
            exit();
        }
        
        // Insert the student record into student_archive table
        $query = "INSERT INTO student_archive (student_number, first_name, last_name, middle_name, email, course, year, semester, password, user_type, photo, status, vkey, verified) VALUES ('" . $row['student_number'] . "', '" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['middle_name'] . "', '" . $row['email'] . "', '" . $row['course'] . "', '" . $row['year'] . "', '" . $row['semester'] . "', '" . $row['password'] . "', '" . $row['user_type'] . "', '" . $row['photo'] . "', '" . $row['status'] . "', '" . $row['vkey'] . "', '" . $row['verified'] . "')";
        
        $insert_result = mysqli_query($link, $query);
        
        if ($insert_result) {
            $_SESSION['success_msg'] = "Student archived successfully!";
        } else {
            $_SESSION['error_msg'] = "Failed to archive student!";
        }
        
        // Delete the student record from student table
        mysqli_query($link, "DELETE FROM student WHERE student_number=$id");
        
        echo '<script type="text/javascript">window.location="all-student-info.php";</script>';
        exit();
    } else {
        $_SESSION['error_msg'] = "Failed to retrieve student data!";
        echo '<script type="text/javascript">window.location="all-student-info.php";</script>';
        exit();
    }
}
?>
