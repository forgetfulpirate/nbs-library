<?php 
	include 'inc/connection.php';
	$id = $_GET["id"];

	// Deactivate the account and reset verification status
	$student_result = mysqli_query($link, "SELECT * FROM student WHERE student_number = $id");
	$teacher_result = mysqli_query($link, "SELECT * FROM teacher WHERE id_number = $id");

	if (mysqli_num_rows($student_result) > 0) {
	    // If the ID corresponds to a student
	    mysqli_query($link, "UPDATE student SET status='no', verified='no' WHERE student_number = $id");
	    echo "<script>alert('Student account deactivated successfully!'); window.location='all-student-info.php';</script>";
	} elseif (mysqli_num_rows($teacher_result) > 0) {
	    // If the ID corresponds to a teacher
	    mysqli_query($link, "UPDATE teacher SET status='no', verified='no' WHERE id_number = $id");
	    echo "<script>alert('Teacher account deactivated successfully!'); window.location='all-teacher-info.php';</script>";
	} else {
	    // If the ID does not correspond to either a student or a teacher
	    echo "<script>alert('Invalid ID.'); window.location='index.php';</script>";
	}

	// Send email notification about account deactivation
	$res = mysqli_query($link, "SELECT * FROM student WHERE student_number=$id");
	$res2 = mysqli_query($link, "SELECT * FROM teacher WHERE id_number=$id");
	while($row = mysqli_fetch_array($res)){
	    $email = $row['email']; 
	}
	while($row2 = mysqli_fetch_array($res2)){
	    $email = $row2['email'];
	}
	$to = "$email";
	$subject = "Account Deactivation";
	$message = "Your account has been deactivated. If you believe this is in error, please contact us for assistance.";
	$headers = "From: cevangelista2021@student.nbscollege.edu.ph";
	mail($to, $subject, $message, $headers);
?>
