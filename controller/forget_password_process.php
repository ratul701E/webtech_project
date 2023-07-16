<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('../controller/validation.php');

    if(!isset($_POST['reset'])) header('location: ../view/forget_password.php');

    $password = $_POST['new_password'];
    $cpassword = $_POST['confirm_password'];
    $otp = $_POST['otp'];

    if(empty($otp) or empty($password) or empty($cpassword)){
        header('location: ../view/forget_password.php?err=empty'); 
        exit();
    }

    if(!isValidPassword($password)) {
        header('location: ../view/forget_password.php?err=shortPassword'); 
        exit();
    }

    if($password != $cpassword) {
        header('location: ../view/forget_password.php?err=passwordMismatch'); 
        exit();
    }

    if($otp != $_SESSION['forget_password_otp']){
        {header('location: ../view/forget_password.php?err=otpMismatch'); exit();}
    }

    $user = getUser($_SESSION['forget_password_email']);
    


    $status = updateUser(
        $_SESSION['forget_password_email'],
        $user['username'],
        $user['first_name'],
        $user['last_name'],
        $user['email'],
        $user['phone'],
        $user['gender'],
        $user['country'],
        $user['address'],
        $password,
        $user['role'],
        $user['profile_location'],
        $user['status'],
        $user['isExist']
    );

    if($status){
        unset($_SESSION['forget_password_email']);
        unset($_SESSION['forget_password_otp']);
        header('location: ../view/signin.php?success=changed'); 
        exit();
    }
    else{
        header('location: ../view/forget_password.php?err=failed'); 
        exit();
    }



?>