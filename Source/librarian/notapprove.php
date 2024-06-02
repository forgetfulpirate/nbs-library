<?php
session_start();
include 'inc/connection.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

// Include the sendMail function
require 'script.php';

$id = $_GET["id"];

// Check if the account is already activated or deactivated
$student_result = mysqli_query($link, "SELECT * FROM student WHERE student_number = $id");
$teacher_result = mysqli_query($link, "SELECT * FROM teacher WHERE id_number = $id");

if (mysqli_num_rows($student_result) > 0) {
    // If the ID corresponds to a student
    $student_data = mysqli_fetch_assoc($student_result);
    if ($student_data['status'] == 'no') {
        $_SESSION['error_msg'] = "User already Deactivated!";
        echo "<script>window.location='status.php';</script>";
    } elseif ($student_data['status'] == 'yes') {
        mysqli_query($link, "UPDATE student SET status='no', verified='no' WHERE student_number = $id");
        $_SESSION['success_msg'] = "User Deactivated successfully!";
        // Send email notification
        $email = $student_data['email'];
        $subject = "Account Deactivation Notification";
        $message = "Your account has been deactivated by the librarian. If you have any questions, please contact the NBS Library.";
        sendMail($email, $subject, $message);
        echo "<script>window.location='status.php';</script>";
    }
} elseif (mysqli_num_rows($teacher_result) > 0) {
    // If the ID corresponds to a teacher
    $teacher_data = mysqli_fetch_assoc($teacher_result);
    if ($teacher_data['status'] == 'no') {
        $_SESSION['error_msg'] = "User already Deactivated!";
        echo "<script>window.location='status.php';</script>";
    } elseif ($teacher_data['status'] == 'yes') {
        mysqli_query($link, "UPDATE teacher SET status='no', verified='no' WHERE id_number = $id");
        $_SESSION['success_msg'] = "User Deactivated successfully!";
        // Send email notification
        $email = $teacher_data['email'];
        $subject = "Account Deactivation Notification";
        $message = "Your account has been deactivated by the librarian. If you have any questions, please contact the NBS Library.";
        sendMail($email, $subject, $message);
        echo "<script>window.location='status.php';</script>";
    }
} else {
    // If the ID does not correspond to either a student or a teacher
    echo "<script>alert('Invalid ID.'); window.location='index.php';</script>";
}
?>
