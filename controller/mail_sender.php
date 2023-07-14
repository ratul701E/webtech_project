<?php

    use PHPMailer\PHPMailer\SMTP;
 
    function send_mail($receiver, $subject, $body){
        
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        // Configuration settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'vavavomago@gmail.com';
        $mail->Password = 'uqfpkgspakteisoj';
        $mail->SMTPSecure = 'tls';
        //$mail ->SMTPDebug = SMTP::DEBUG_SERVER;

        // Set sender and recipient
        $mail->setFrom('vavavomago@gmail.com', 'Professional Sage');
        $mail->addAddress($receiver);

        // Set email content
        $mail->Subject = $subject;
        $mail->Body = $body;

        // Send the email
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }

    function getOtp(){
        return (string)rand(0,9)  . (string)rand(0,9) . (string)rand(0,9) .(string)rand(0,9) . (string)rand(0,9) . (string)rand(0,9);
    }
?>
