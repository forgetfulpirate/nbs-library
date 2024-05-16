<?php 
  session_start();
    include 'inc/connection.php';
    $id = $_GET["id"];

    

    // Check if the account is already activated or deactivated
    $student_result = mysqli_query($link, "SELECT * FROM student WHERE student_number = $id");
    $teacher_result = mysqli_query($link, "SELECT * FROM teacher WHERE id_number = $id");

    if (mysqli_num_rows($student_result) > 0) {
        // If the ID corresponds to a student
        $student_data = mysqli_fetch_assoc($student_result);
        if ($student_data['status'] == 'yes') {
            $_SESSION['error_msg'] = "User already activated!";
            echo "<script>window.location='all-student-info.php';</script>";
        } elseif ($student_data['status'] == 'no') {
            mysqli_query($link, "UPDATE student SET status='yes', verified='yes' WHERE student_number = $id");
            $_SESSION['success_msg'] = "User activated successfully!";
            echo "<script>window.location='all-student-info.php';</script>";
            exit();
        }
    } elseif (mysqli_num_rows($teacher_result) > 0) {
        // If the ID corresponds to a teacher
        $teacher_data = mysqli_fetch_assoc($teacher_result);
        if ($teacher_data['status'] == 'yes') {
            $_SESSION['error_msg'] = "User already activated!";
            echo "<script>window.location='all-teacher-info.php';</script>";
        } elseif ($teacher_data['status'] == 'no') {
            mysqli_query($link, "UPDATE teacher SET status='yes', verified='yes' WHERE id_number = $id");
            $_SESSION['success_msg'] = "User activated successfully!";
            echo "<script>window.location='all-teacher-info.php';</script>";
        }
    } else {
        // If the ID does not correspond to either a student or a teacher
        echo "<script>alert('Invalid ID.'); window.location='index.php';</script>";
    }
?>
