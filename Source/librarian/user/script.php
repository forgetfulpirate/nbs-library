<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

    require 'config.php';

    function sendMail($email, $subject, $message) {
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
            $mail->addReplyTo(REPLY_TO, REPLY_TO_NAME);
    
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;
    
            // Disable SSL certificate verification (for debugging only)
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
    
            // Send email
            $mail->send();
            return 'success';
        } catch (Exception $e) {
            return 'Email not sent. Error: ' . $mail->ErrorInfo;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $details = $_POST['details'];
    
        // Send email using sendMail function from config.php
        $result = sendMail($email, $subject, $details);
    
        if ($result === 'success') {
            echo "Email sent successfully!";
        } else {
            echo "Email could not be sent. Error: " . $result;
        }
    }