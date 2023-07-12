<?php
    require_once('../model/queryModel.php');
     if(!isset($_POST['submit'])) {header('location: support.php');}


     $email = $_POST['email'];
     $query = $_POST['query'];

     $status = addQuery($email, $query);
     

    if($status){
        header('location: ../view/support.php');
      
    }
    else{
        header('location: ../view/support.php');
    }

    
?>
