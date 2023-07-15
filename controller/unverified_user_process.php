<?php
    session_start();
    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');

    require_once('mail_sender.php');
    require_once('../model/userModel.php');
    

    $user = $_SESSION['user'];

    if(isset($_POST['verify'])){

        $otp = $_POST['otp'];
        if($otp != $_SESSION['verify_user_otp']){
            header('location: ../view/unverified_user.php?err=otpMismatch');
            exit();
        }

        $status = updateUser(
            $user['username'],
            $user['username'],
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            $user['phone'],
            $user['gender'],
            $user['country'],
            $user['address'],
            $user['password'],
            $user['role'],
            $user['profile_location'],
            'valid',
            $user['isExist']
        );
    
        if($status){
            unset($_SESSION['verify_user_otp']);
            $_SESSION['user'] = getUser($user['username']);
            header('location: ../view/profile.php?username='.$user['username']); 
            exit();
        }
        else{
            header('location: ../view/unverified_user.php?err=failed'); 
            exit();
        }


    }
    else if(isset($_POST['get_otp'])){
        $email = $user['email']; 
        $otp = getOtp();   

        $status = send_mail($email, 'Your OTP for account verify is '.$otp, 'Your OTP for account verify is '.$otp);
        if($status){
            $_SESSION['verify_user_otp'] = $otp;
            header('location: ../view/unverified_user.php?success=sent');
            exit();
        } 
        else{
            header('location: ../view/unverified_user.php?err=failed');
            exit();
        }
    }

    


?>