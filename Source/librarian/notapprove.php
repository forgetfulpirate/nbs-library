<?php 
	include 'inc/connection.php';
	$id= $_GET["id"];

	mysqli_query($link, "update std_registration set status='no' where id=$id");
	mysqli_query($link, "update t_registration set status='no' where id=$id");
    mysqli_query($link, "update std_registration set verified='no' where id=$id");
	mysqli_query($link, "update t_registration set verified='no' where id=$id");
    mysqli_query($link, "update student set status='no' where student_number=$id");
    mysqli_query($link, "update student set verified='no' where student_number=$id");
    echo "<script type='text/javascript'>";
    echo "alert('Account deactivated successfully!');";
    echo "window.location='all-student-info.php';";
    echo "</script>";
 ?>
 <!-- <script type="text/javascript">
 	window.location="all-student-info.php";
 </script> -->


 <!-- <?php 

     $res = mysqli_query($link, "select * from std_registration where id=$id");
     $res2 = mysqli_query($link, "select * from t_registration where id=$id");
    while($row = mysqli_fetch_array($res)){
        $email      = $row['email']; 
    }
    while($row2 = mysqli_fetch_array($res2)){
        $email      = $row2['email'];
    }
    $to = "$email";
    $subject = "Account Approve problem";
    $message = "We can't approve your account. Might be your information is not correct. Please register with real information <br> Thanks";
    $headers = "From: cevangelista2021@student.nbscollege.edu.ph";
    mail($to,$subject,$message,$headers);
?> -->