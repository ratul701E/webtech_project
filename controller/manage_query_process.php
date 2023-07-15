<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    require_once('../model/queryModel.php');
    require_once('../controller/mail_sender.php');

    if(isset($_POST['remove'])){
        $query_id = $_POST['query_id'];

        deleteQuery($query_id);
        header('location: ../view/manage_query.php?success=removed');
         exit();

    }


    if(isset($_POST['reply'])){
        $query_id = $_POST['query_id'];
        $query = getQuery($query_id);

        $reply = $_POST['reply_msg'];
        $user = $_SESSION['user'];

        $body = $reply.' Regards '.$user['first_name'].' '.$user['last_name'].' from Professional Sage';
        $status = send_mail($query['sender_email'], 'Thanks for message our support', $body);

        if($status){

            deleteQuery($query_id);
            header('location: ../view/manage_query.php?success=replySend');
            exit();
        }

    }

    header('location: ../view/manage_query.php');

?>