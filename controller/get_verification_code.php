<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('mail_sender.php');

    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $user = getUser($email);

        if($user == false){
            header('location: ../view/forget_password.php?err=wrongEmail'); 
            exit();
        }

        $otp = getOtp();
        $_SESSION['forget_password_otp'] = $otp;
        $_SESSION['forget_password_email'] = $email;

        $status = send_mail($email, 'Your OTP for password reset is '.$otp, 'Your OTP for password reset is '.$otp);
        if($status){
            header('location: ../view/forget_password.php?success=sent');
            exit();
        } 
        else{
            header('location: ../view/forget_password.php?err=sendFailed');
            exit();
        }
    }

    header('location: ../view/forget_password.php');

?>