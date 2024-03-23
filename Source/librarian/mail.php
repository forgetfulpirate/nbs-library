<?php
    include 'inc/connection.php';
    $id= $_GET["id"];
    $sql = "select * from std_registration where id=$id";
    $res = mysqli_query($link, $sql);
    while($row = mysqli_fetch_array($res)){
        $email      = $row['email']; 
    }
    $to = "$email";
    $subject = "Account Conformation";
    $message = "Your account is approved. Now you can login your account";
    $headers = "From: cevangelista2021@student.nbscollege.edu.ph";
    if(mail($to,$subject,$message,$headers)){
        echo "Mail send successfully";
    }
	else{
		echo "Mail can't send";
	}
?>
