<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'config.php';
include 'inc/connection.php';

function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    // Hash the generated password before returning it
    return hashPassword($password);
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function updateStudentPassword($link, $student_number, $hashed_password) {
    $sql = "UPDATE student SET password = ? WHERE student_number = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $student_number);
    if(mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function sendPasswordEmail($email, $new_password) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = MAILHOST;
        $mail->SMTPAuth = true;
        $mail->Username = USERNAME;
        $mail->Password = PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom(SEND_FROM, SEND_FROM_NAME);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Library Password Reset';
        $mail->Body = "Your new password is: $new_password";

        $mail->send();
        return 'success';
    } catch (Exception $e) {
        return 'error: ' . $mail->ErrorInfo;
    }
}

if(isset($_GET['student_number'])) {
    $student_number = $_GET['student_number'];

    $query = "SELECT email FROM student WHERE student_number = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "s", $student_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Generate a random password and hash it
        $new_password = generateRandomPassword();

        if(updateStudentPassword($link, $student_number, $new_password)) {
            if(sendPasswordEmail($email, $new_password) == 'success') {
                // Password reset successfully, set success message
                $_SESSION['success_msg'] = "Password reset successfully!";
            } else {
                // Error sending email, set error message
                $_SESSION['error_msg'] = "Error sending email. Please try again later.";
            }
        } else {
            // Error updating password, set error message
            $_SESSION['error_msg'] = "Error updating password. Please try again later.";
        }
    } else {
        // Student number not found, set error message
        $_SESSION['error_msg'] = "Error: Student number not found.";
    }
} else {
    // Student number not provided, set error message
    $_SESSION['error_msg'] = "Error: Student number not provided.";
}
// Redirect to all-student-info.php
header("Location: all-student-info.php");
exit();
