<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    require_once('../model/userModel.php');

    if(isset($_POST['remove'])){
        $isExist = 'false';
        $username = $_POST['username'];
        $user = getUser($username);
        $q_status = updateUser(
            $username,
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
            $user['status'],
            $isExist
        );
    }

    else if(isset($_POST['ban'])){
        $status = 'banned';
        $username = $_POST['username'];
        $user = getUser($username);
        $q_status = updateUser(
            $username,
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
            $status,
            $user['isExist']
        );

    }

    else if(isset($_POST['unban'])){
        $status = 'valid';
        $username = $_POST['username'];
        $user = getUser($username);
        $q_status = updateUser(
            $username,
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
            $status,
            $user['isExist']
        );
    }

    else if(isset($_POST['restore'])){
        $isExist = 'true';
        $username = $_POST['username'];
        $user = getUser($username);
        $q_status = updateUser(
            $username,
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
            $user['status'],
            $isExist
        );
    }

    else if(isset($_POST['ban_all'])){
        updateColumnValue('status', 'banned');
    }

    else if(isset($_POST['unban_all'])){
        updateColumnValue('status', 'valid');
    }

    else if(isset($_POST['remove_all'])){
        updateColumnValue('isExist', 'false');
    }

    else if(isset($_POST['restore_all'])){
        updateColumnValue('isExist', 'true');
    }

    $view = '';
    if(isset($_POST['view'])) $view = $_POST['view'];
    
    header('location: ../view/manage_user.php?view='.$view);


?>