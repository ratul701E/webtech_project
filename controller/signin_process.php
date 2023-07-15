<?php
    session_start();
    require_once('../model/userModel.php');

     if(!isset($_POST['signin'])) {header('location: ../view/signin.php');}

     $username = $_POST['username'];
     $password = $_POST['password'];
     $save = $_POST['save'];

    $status = login($username, $password);

     if($status){

         $user = getUser($username);

         if($user['isExist'] == 'false'){
            header('location: ../view/signin.php?err=falseUser');
            exit();
         }
         else if($user['status'] == 'banned'){
            header('location: ../view/signin.php?err=bannedUser');
            exit();
         }

         $_SESSION['logged_in'] = true;
         $_SESSION['username'] = $user['username'];
         $_SESSION['user'] = $user;

         if($save === 'yes'){
            setcookie('logged_in', true, time()+10000000000, '/');
            setcookie('username', $username, time()+10000000000, '/');
         }

        header('location: ../view/discussion.php');
        exit();
     }
     else header('location: ../view/signin.php?err=mismatch');

?>