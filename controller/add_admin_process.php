<?php
    require_once('../model/userModel.php');

    if (isset($_POST['add_admin'])) {
        $username = $_POST["username"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $country = $_POST["country"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        $role = 'Admin';
        $profile = 'default.jpg';
        $validity = 'unverified';



        if(isExistUser($username, $email)) {header('location: ../view/add_admin.php?err=userExist'); exit();}
        if(strlen($password) < 8) {header('location: ../view/add_admin.php?err=shortPassword'); exit();}

        $status = addUser($username, $first_name, $last_name, $email, $phone, $gender, $country, $address, $password, $role, $profile, $validity);

        if($status){
            header('location: ../view/add_admin.php?success=created');
        }
        else{
            header('location: ../view/add_admin.php?err=failed');
        }




    }
?>
