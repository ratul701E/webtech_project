<?php
    require_once('../model/userModel.php');
    require_once('validation.php');

    if (isset($_POST['add_admin'])) {
        $username = trim($_POST["username"]);
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $email = $_POST["email"];
        $phone = trim($_POST["phone"]);
        $gender = $_POST["gender"];
        $country = $_POST["country"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $role = 'Admin';
        $profile = 'default.jpg';
        $validity = 'unverified';

        //validation here 


        if(isExistUser($username, $email)) {
            header('location: ../view/add_admin.php?err=userExist'); 
            exit();
        }
        if(!isValidUsername($username)) {
            header('location: ../view/add_admin.php?err=invalidUsername'); 
            exit();
        }
        if(!isValidName($first_name)) {
            header('location: ../view/add_admin.php?err=invalidFirstName'); 
            exit();
        }
        
        if(!isValidName($last_name)) {
            header('location: ../view/add_admin.php?err=invalidLastName'); 
            exit();
        }
        
        if(!isValidEmail($email)) {
            header('location: ../view/add_admin.php?err=invalidEmail'); 
            exit();
        }
        if(!isValidPhone($phone, $country)) {
            header('location: ../view/add_admin.php?err=invalidPhone'); 
            exit();
        }
        if(strlen($address) < 4) {
            header('location: ../view/add_admin.php?err=invalidAddress'); 
            exit();
        }
        if(!isValidPassword($password)) {
            header('location: ../view/add_admin.php?err=invalidPassword'); 
            exit();
        }


        $status = addUser($username, $first_name, $last_name, $email, $phone, $gender, $country, $address, $password, $role, $profile, $validity);

        if($status){
            header('location: ../view/add_admin.php?success=created');
        }
        else{
            header('location: ../view/add_admin.php?err=failed');
        }
    }
?>
