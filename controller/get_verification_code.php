<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('mail_sender.php');
    require_once('../controller/validation.php');

    if(isset($_POST['email'])){
        $email = $_POST['email'];

        if(empty($email)){
            header('location: ../view/forget_password.php?err=empty'); 
            exit();
        }
        
        if(!isValidEmail($email)) {
            header('location: ../view/forget_password.php?err=invalidEmail'); 
            exit();
        }

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