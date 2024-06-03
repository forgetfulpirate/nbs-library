<?php
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
    return $password;
}

function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function updateTeacherPassword($link, $id_number, $hashed_password) {
    $sql = "UPDATE teacher SET password = ? WHERE id_number = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $hashed_password, $id_number);
    if(mysqli_stmt_execute($stmt)) {
        return true;
    } else {
        return false;
    }
}

function sendPasswordEmail($email, $new_password) {
    $hashed_password = hashPassword($new_password); // Hash the password
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
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_GET['id_number'])) {
    $id_number = $_GET['id_number'];

    // Sanitize input to prevent SQL injection
    $id_number = mysqli_real_escape_string($link, $id_number);

    $query = "SELECT email FROM teacher WHERE id_number = ?";
    $stmt = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($stmt, "s", $id_number);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Generate a random password
        $new_password = generateRandomPassword();

        // Update password
        if(updateTeacherPassword($link, $id_number, $new_password)) {
            // Send email
            if(sendPasswordEmail($email, $new_password)) {
                // Password reset successfully, redirect with alert
                echo '<script>alert("Password reset successfully!");';
                echo 'window.location.href = "all-teacher-info.php";</script>';
            } else {
                // Error sending email
                echo '<script>alert("Error sending email. Please try again later.");';
                echo 'window.location.href = "all-teacher-info.php";</script>';
            }
        } else {
            // Error updating password
            echo '<script>alert("Error updating password. Please try again later.");';
            echo 'window.location.href = "all-teacher-info.php";</script>';
        }
    } else {
        // Teacher ID not found
        echo '<script>alert("Error: ID number not found.");';
        echo 'window.location.href = "all-teacher-info.php";</script>';
    }
} else {
    // Teacher ID not provided
    echo '<script>alert("Error: ID number not provided.");';
    echo 'window.location.href = "all-teacher-info.php";</script>';
}
?>
