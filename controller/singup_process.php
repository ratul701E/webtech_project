<?php
    
    if(!isset($_POST['signup'])) {header('location: ../view/signup.php');}
    require_once('../model/userModel.php');
    require_once('../controller/validation.php');

    
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $validity = 'unverified';


    if(!isset($_POST['role'])) {
        header('location: ../view/signup.php?err=invalidRole'); 
        exit();
    }
    else{
        $role = $_POST['role'];
    }

    if(isExistUser($username, $email)) {
        header('location: ../view/signup.php?err=userExist'); 
        exit();
    }

    if(!isValidUsername($username)) {
        header('location: ../view/signup.php?err=invalidUsername'); 
        exit();
    }

    if(!isValidName($first_name)) {
        header('location: ../view/signup.php?err=invalidFirstName'); 
        exit();
    }
    
    if(!isValidName($last_name)) {
        header('location: ../view/signup.php?err=invalidLastName'); 
        exit();
    }
    
    if(!isValidEmail($email)) {
        header('location: ../view/signup.php?err=invalidEmail'); 
        exit();
    }


    if(empty($_POST['gender'])){
        header('location: ../view/signup.php?err=invalidGender'); 
        exit();
    }
    else{
        $gender = $_POST['gender'];
    }

    if(empty($_POST['country'])){
        header('location: ../view/signup.php?err=invalidCountry'); 
        exit();
    }
    else{
        $country = $_POST['country'];
    }

    if(!isValidPhone($phone, $country)) {
        header('location: ../view/signup.php?err=invalidPhone'); 
        exit();
    }

    if(strlen($address) < 5) {
        header('location: ../view/signup.php?err=invalidAddress'); 
        exit();
    }

    if(!isValidPassword($password)) {
        header('location: ../view/signup.php?err=shortPassword'); 
        exit();
    }

    if($password != $cpassword) {
        header('location: ../view/signup.php?err=passwordMismatch'); 
        exit();
    }


    
    
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