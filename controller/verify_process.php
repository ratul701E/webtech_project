<?php
    session_start();
    require_once('../model/userModel.php');
    require_once('../model/professionalDocumentsModel.php');

    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');

    if(isset($_POST['verify']) or isset($_POST['remove'])){
        $targeted_user = $_POST['targeted_user'];
        $user = getUser($targeted_user);

        if(isset($_POST['remove'])) {
            $status = 'invalid';
            $exist = 'false';
        }
        else if(isset($_POST['verify'])){
            $status = 'valid';
            $exist = 'true';
        }
        
        $q_status = updateUser(
            $targeted_user,
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
            $exist
        );
    
        if($q_status){
            header('location: ../view/verify.php?success=successful'); 
            exit();
        }
        else{
            header('location: ../view/verify.php?err=failed'); 
            exit();
        }


    }

    else if(isset($_POST['remove_doc'])){
        $targeted_user = $_POST['targeted_user'];
        $file = $_POST['file'];
        $status = deleteDocument($targeted_user, $file);
        header('location: ../view/view_professional_documents.php?prof='.$targeted_user);
        exit();
    }

    else header('location: ../');




?>