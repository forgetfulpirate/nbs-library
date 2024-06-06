<?php
session_start();
if (!isset($_SESSION["username"])) {
    echo '<script type="text/javascript">window.location="login.php";</script>';
    exit();
}

include 'inc/connection.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    // Retrieve teacher data from teacher table
    $result = mysqli_query($link, "SELECT * FROM teacher WHERE id_number=$id");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        // Check if teacher's id_number already exists in teacher_archive table
        $check_query = "SELECT * FROM teacher_archive WHERE id_number='$id'";
        $check_result = mysqli_query($link, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $_SESSION['error_msg'] = "Teacher with ID $id is already archived!";
            header("Location: all-teacher-info.php");
            exit();
        }
        
        // Insert the teacher record into teacher_archive table
        $query = "INSERT INTO teacher_archive (id_number, first_name, last_name, middle_name, email, dept, password, user_type, photo, status, vkey, verified) VALUES ('" . $row['id_number'] . "', '" . $row['first_name'] . "', '" . $row['last_name'] . "', '" . $row['middle_name'] . "', '" . $row['email'] . "', '" . $row['dept'] . "', '" . $row['password'] . "', '" . $row['user_type'] . "', '" . $row['photo'] . "', '" . $row['status'] . "', '" . $row['vkey'] . "', '" . $row['verified'] . "')";
        
        $insert_result = mysqli_query($link, $query);
        
        if ($insert_result) {
            $_SESSION['success_msg'] = "Teacher archived successfully!";
        } else {
            $_SESSION['error_msg'] = "Failed to archive teacher!";
        }
        
        // Delete the teacher record from teacher table
        mysqli_query($link, "DELETE FROM teacher WHERE id_number=$id");
        
        header("Location: all-teacher-info.php");
        exit();
    } else {
        $_SESSION['error_msg'] = "Failed to retrieve teacher data!";
        header("Location: all-teacher-info.php");
        exit();
    }
}
?>
