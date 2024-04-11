<?php
	if (isset($_POST["submit"])) {
        $id_number = $_POST["id_number"];
		$first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $middle_name = $_POST["middle_name"];                  
		$password = $_POST["password"];
		$email = $_POST["email"];
		$dept = $_POST["dept"];

		if ($id_number =="" | $first_name =="" | $last_name == "" | $password == "" | $email == "" | $dept == "") {
			$error_m= "Error! <span>Feild mustn't be empty</span>";

		}
		$photo = "upload/avatar.jpg";
		$utype = "teacher";
		
         
//          elseif(preg_match('/[^a-z0-9_-]+/i', $username)){
//             $error_msg = "<div class='alert alert-danger'><strong>Error ! </strong>username Must be contain numerical alphabet, dashes, number and Underscore</div>";
//            }
		

        $sql_e= mysqli_query($link,"select * from student where email= '$email'");
        $sql_r= mysqli_query($link,"select * from teacher where id_number= '$id_number'");

        $sql2_e= mysqli_query($link,"select * from teacher where email= '$email'");

        
		if(mysqli_num_rows($sql_r) > 0){
			$error_uname = "student number already exist";
		}
        // if(mysqli_num_rows($sql2_u) > 0){
		// 	$error_uname = "Username already exist";
		// }
        elseif(mysqli_num_rows($sql_e) > 0){
            $error_email = "Email already exist";
        }elseif(mysqli_num_rows($sql2_e) > 0){
            $error_email = "Email already exist";
        }
        // elseif(mysqli_num_rows($sql2_p) > 0){
        //     $error_phone = "Phone already registered";
    
        // }
        elseif(strlen($password) < 6){
            $error_ua ="password too short";
        }elseif (filter_var($email, FILTER_VALIDATE_EMAIL)== false) {
				$e_msg = "<div class='alert alert-danger'><strong>Error ! </strong>Email Address Not Valid</div>";
			} else{
		    $vkey = md5(time().$id_number);
		    $insert = mysqli_query($link, "insert into teacher values('$id_number','$first_name','$last_name','$middle_name','$email','$dept','$password','$utype','$photo','pending','$vkey','no')");
            if($insert){
                // $to = "$email";
                // $subject = "Email Verification";
                // $message = "<a href='http://localhost/nbs-library/nbs-library/Source/librarian/user/student/verify.php?vkey=$vkey'>Verify Email</a>";
                // $headers = "From: cevangelista2021@student.nbscollege.edu.ph \r\n";
                // $headers.= "MIME-Version: 1.0". "\r\n";
                // $headers.= "Content-type: text/html; charset-UTF-8". "\r\n";
                // mail($to, $subject, $message,$headers);

            }else{
                echo $mysqli->error;
            }
		}
	}
?>

