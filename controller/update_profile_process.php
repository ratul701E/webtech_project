<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    
    if(!isset($_POST['update'])) {header('location: ../view/update_profile.php');}
    require_once('../model/userModel.php');

    $user = $_SESSION['user'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    
    
    $profile = '';

    if($_FILES['profile']['size'] > 0){
        $profile = $_FILES['profile']['name'];
        $profile_src = $_FILES['profile']['tmp_name'];
        $profile_des = "../vendor/profiles/".$_FILES['profile']['name'];
        if(move_uploaded_file($profile_src, $profile_des)){}
        else header('location: ../view/signup.php?file_err=true');
    }
    else $profile = $user['profile_location'];


    $status = updateUser(
        $user['username'],
        $user['username'],
        $first_name,
        $last_name,
        $email,
        $phone,
        $gender,
        $country,
        $address,
        $user['password'],
        $user['role'],
        $profile,
        $user['status'],
        $user['isExist']
    );

    if($status){
        $_SESSION['user'] = getUser($user['username']);
        header('location: ../view/profile.php?username='.$user['username']); 
        exit();
    }
    else{
        header('location: ../view/update_profile.php'); 
        exit();
    }


    
?>