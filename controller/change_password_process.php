<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('../controller/validation.php');

    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');
    if(!isset($_POST['change_password'])) header('location: ../view/profile.php?username='.$user['username']); 

    $user = $_SESSION['user'];

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $cnew_password = $_POST['confirm_new_password'];

    if(empty($old_password) or empty($new_password) or empty($cnew_password)){
        header('location: ../view/change_password.php?err=empty'); 
        exit();
    }

    if($old_password != $user['password']){
        header('location: ../view/change_password.php?err=oldPasswordMismatch'); 
        exit();
    }
    if(!isValidPassword($new_password)) {
        header('location: ../view/change_password.php?err=shortPassword'); 
        exit();
    }
    if($new_password != $cnew_password){
        header('location: ../view/change_password.php?err=newPasswordMismatch'); 
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
        $new_password,
        $user['role'],
        $user['profile_location'],
        $user['status'],
        $user['isExist']
    );

    if($status){
        $_SESSION['user'] = getUser($user['username']); // updation latest infos
        header('location: ../view/profile.php?username='.$user['username']); 
        exit();
    }
    else{
        header('location: ../view/change_password.php'); 
        exit();
    }


    

?>