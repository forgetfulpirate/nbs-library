<?php
    session_start();
    if (!isset($_SESSION["username"])) {
    ?>
        <script type="text/javascript">
            window.location="login.php";
        </script>
    <?php
    }

	include 'inc/connection.php';
	$id= $_GET["id"];
    mysqli_query($link, "update std_registration set verified='yes' where id=$id");
    mysqli_query($link, "update t_registration set verified='yes' where id=$id");
    mysqli_query($link, "update student set status='yes' where student_number=$id");
    mysqli_query($link, "update student set verified='yes' where student_number=$id");

 

    echo "<script type='text/javascript'>";
    echo "alert('Account activated successfully!');";
    echo "window.location='all-student-info.php';";
    echo "</script>";
    
   
 ?>




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
    $subject = "Account Conformation";
    $message = "Your account is approved. Now you can login your account";
    $headers = "From: cevangelista2021@student.nbscollege.edu.ph";
    mail($to,$subject,$message,$headers);
?> -->



 