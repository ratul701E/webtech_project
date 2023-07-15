<?php
    
    if(!isset($_POST['signup'])) {header('location: ../view/signup.php');}
    require_once('../model/userModel.php');

    
    $username = $_POST['username'];
    $role = $_POST['role'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $validity = 'unverified';


    if(isExistUser($username, $email)) {header('location: ../view/signup.php?err=userExist'); exit();}
    if(strlen($password) < 8) {header('location: ../view/signup.php?err=shortPassword'); exit();}
    if($password != $cpassword) {header('location: ../view/signup.php?err=passwordMismatch'); exit();}

    if($password != $cpassword) {header('location: ../view/signup.php?err=passwordMismatch'); exit();}


    
    
    $profile = '';

    if($_FILES['profile']['size'] > 0){
        $profile = $_FILES['profile']['name'];
        $profile_src = $_FILES['profile']['tmp_name'];
        $profile_des = "../vendor/profiles/".$_FILES['profile']['name'];
        if(move_uploaded_file($profile_src, $profile_des)){}
        else header('location: ../view/signup.php?file_err=true');
    }
    else $profile = 'default.jpg';




    $status = addUser($username, $first_name, $last_name, $email, $phone, $gender, $country, $address, $password, $role, $profile, $validity);

    if($status){
        header('location: ../view/signin.php?success=created');
    }
    else{
        header('location: ../view/signup.php?unknown=true');
    }


    
?>