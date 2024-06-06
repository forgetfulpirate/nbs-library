<?php
	    $error_uname = $error_email = $error_ua = $e_msg = "";

        if (isset($_POST["submit"])) {
            $student_number = $_POST["student_number"];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $middle_name = $_POST["middle_name"];                  
            $password = $_POST["password"];
            $email = $_POST["email"];
            // $semester = $_POST["semester"];
            $year = $_POST["year"];
            $course = $_POST["course"];
    
            if ($student_number == "" || $first_name == "" || $last_name == "" || $password == "" || $email == "" || $year == "" || $course == "") {
                $error_m = "Error! <span>Field mustn't be empty</span>";
            } else {
                $sql_u = mysqli_query($link, "SELECT * FROM student WHERE student_number= '$student_number'");
                $sql_e = mysqli_query($link, "SELECT * FROM student WHERE email= '$email'");
                $sql2_e = mysqli_query($link, "SELECT * FROM teacher WHERE email= '$email'");
                $sql3_e = mysqli_query($link, "SELECT * FROM student_archive WHERE student_number= '$student_number'");
    
                if (mysqli_num_rows($sql_u) > 0 || mysqli_num_rows($sql3_e) > 0) {
                    $error_uname = "Student number already exists";
                } elseif (mysqli_num_rows($sql_e) > 0 || mysqli_num_rows($sql2_e) > 0) {
                    $error_email = "Email already exists";
                } elseif (strlen($password) < 6) {
                    $error_ua = "Password too short";
                } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $e_msg = "Email address not valid";
                } else {
                    $vkey = md5(time().$student_number);
                    $insert = mysqli_query($link, "INSERT INTO student VALUES('$student_number', '$first_name', '$last_name', '$middle_name', '$email', '$course', '$year', '', '$password', 'student', 'upload/avatar.jpg', 'no', '$vkey', 'no')");
                    if ($insert) {
                        $_SESSION['success_msg'] = "Student added successfully!";
                        echo '<script type="text/javascript">window.location="all-student-info.php";</script>';
                            exit();
                    } else {
                        echo $mysqli->error;
                    }
                }
            }
        }
?>

