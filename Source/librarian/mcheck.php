<?php

    $to = "cevangelista2021@student.nbscollege.edu.ph";
    $subject = "Account Conformation";
    $message = "Your account is approved. Now you can login your account";
    $header = "From: cevangelista2021@student.nbscollege.edu.ph";
    $result = mail ($to,$subject,$message,$header);
//    if(mail($to,$subject,$message,$header)){
////        echo "Mail send successfully";
////    }
////	else{
////		echo "Mail can't send";
////	}
     if( $result == true){
         echo "Message sent successfully.";
     }
     else{
         echo "Message can't be send";
     }
  
  

?>
