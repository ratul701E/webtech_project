<?php
    session_start();
    require_once('../model/userModel.php');
    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');
    if(!isset($_POST['change_password'])) header('location: ../view/profile.php?username='.$user['username']); 

    $user = $_SESSION['user'];

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $cnew_password = $_POST['confirm_new_password'];

    if($old_password != $user['password']){
        header('location: ../view/change_password.php?err=oldPasswordMismatch'); 
        exit();
    }
    if($new_password != $cnew_password){
        header('location: ../view/change_password.php?err=newPasswordMismatch'); 
        exit();
    }
    if(strlen($new_password) < 8) {header('location: ../view/change_password.php?err=shortPassword'); exit();}

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