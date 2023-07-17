<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    
    if(!isset($_POST['update'])) {header('location: ../view/update_profile.php');}
    require_once('../model/userModel.php');
    require_once('../controller/validation.php');

    $user = getUser($_POST['username']);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if(!isValidName($first_name)) {
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidFirstName');
        else header('location: ../view/update_profile.php?err=invalidFirstName');
        exit();
    }
    
    if(!isValidName($last_name)) {
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidLastName');
        else header('location: ../view/update_profile.php?err=invalidLastName');
        exit();
    }

    if(!isValidEmail($email)) {
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidEmail');
        else header('location: ../view/update_profile.php?err=invalidEmail');
        exit();
    }


    if(empty($_POST['gender'])){
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidGender');
        else header('location: ../view/update_profile.php?err=invalidGender');
        exit();
    }
    else{
        $gender = $_POST['gender'];
    }

    if(empty($_POST['country'])){
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidCountry');
        else header('location: ../view/update_profile.php?err=invalidCountry');
        exit();
    }
    else{
        $country = $_POST['country'];
    }

    if(!isValidPhone($phone, $country)) {
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidPhone');
        else header('location: ../view/update_profile.php?err=invalidPhone');
        exit();
    }

    if(strlen($address) < 5) {
        if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidAddress');
        else header('location: ../view/update_profile.php?err=invalidAddress');
        exit();
    }

    
    
    $profile = '';

    if($_FILES['profile']['size'] > 0){
        if(!isValidFile($_FILES['profile']['type'], 'image')){
            if(isset($_POST['admin_updating'])) header('location: ../view/update_profile.php?username='.$user['username'].'&err=invalidFileFormat');
            else header('location: ../view/update_profile.php?err=invalidFileFormat');
            exit();

        }
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