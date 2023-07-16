<?php
     if(!isset($_POST['submit'])) {header('location: support.php');}
     require_once('../model/queryModel.php');
     require_once('../controller/validation.php');


     $email = $_POST['email'];
     $query = $_POST['query'];

     if(empty($email) or empty($query)){
        header('location: ../view/support.php?err=empty');
        exit();
     }

     if(!isValidEmail($email)){
        header('location: ../view/support.php?err=invalidEmail');
        exit();
     }



     $status = addQuery($email, $query);
     

    if($status){
        header('location: ../view/support.php?success=sent');
      
    }
    else{
        header('location: ../view/support.php');
    }

    
?>
