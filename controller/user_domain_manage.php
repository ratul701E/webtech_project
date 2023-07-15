<?php
    session_start();
    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    require_once('../model/user_domainsModel.php');
    require_once('../model/userModel.php');

    $user = $_SESSION['user'];
    $username = $user['username'];

    if(isset($_POST['remove_domain'])){
        
        $domain_id = $_POST['domain_id'];
 
        deleteDomain($username, $domain_id);

        
    }

    else if(isset($_POST['add_new_domain'])){
        $domain_id = $_POST['domain_id'];

        addUserDomain($username, $domain_id);

        if($user['role'] == 'Professional'){
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
                $user['password'],
                $user['role'],
                $user['profile_location'],
                'invalid',
                $user['isExist']
            );

            $_SESSION['user'] = getUser($user['username']);

            header('location: ../view/unverified_professional.php');
            exit();
        }
    
    }


    header('location: ../view/profile.php?username='.$user['username']);


?>