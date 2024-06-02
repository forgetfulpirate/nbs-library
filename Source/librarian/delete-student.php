<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Retrieve student data from student table
    $result = mysqli_query($link, "SELECT * FROM student WHERE student_number=$id");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
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
