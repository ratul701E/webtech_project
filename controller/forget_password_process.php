<?php
    session_start();
    require_once('../model/userModel.php');

    if(!isset($_POST['reset'])) header('location: ../view/forget_password.php');

    $password = $_POST['new_password'];
    $cpassword = $_POST['confirm_password'];

    if(strlen($password) < 8) {header('location: ../view/forget_password.php?err=shortPassword'); exit();}
    if($password != $cpassword) {header('location: ../view/forget_password.php?err=passwordMismatch'); exit();}

    $user = getUser('ratul@gmail.com'/*$_SESSION['forget_password_email']*/);


    $status = updateUser(
        'ratul@gmail.com'/*$_SESSION['forget_password_email']*/, // set by get verification code
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
        header('location: ../view/signin.php?success=changed'); 
        exit();
    }
    else{
        header('location: ../view/forget_password.php?err=failed'); 
        exit();
    }



?>