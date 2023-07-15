<?php
    session_start();
    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');
    if(!isset($_POST['submit_document']) ) header('location: signin.php');

    require_once('../model/professionalDocumentsModel.php');


    $user = $_SESSION['user'];


    if($_FILES['document']['size'] > 0){
        $document = $_FILES['document']['name'];
        $document_src = $_FILES['document']['tmp_name'];
        $document_des = "../vendor/documents/".$_FILES['document']['name'];
        if(move_uploaded_file($document_src, $document_des)){}
        else {
            header('location: ../view/unverified_professional.php?err=uploadFailed');
            exit();
        }
    }
    else{
        header('location: ../view/unverified_professional.php?err=uploadFailed');
        exit();
    }





    $status = addDocument($user['username'], $_FILES['document']['name']);

    if($status){
        header('location: ../view/unverified_professional.php?success=uploaded');
    }
    else{
        header('location: ../view/signup.php?err=uploadFailed');
    }

?>
