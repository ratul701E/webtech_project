<?php
    session_start();
    require_once('../model/discussion_commentsModel.php');
    require_once('../model/discussion_postsModel.php');

    if(!isset($_SESSION['logged_in'])){
        header('location: ../view/signin.php');
        exit();
    }

    $user = $_SESSION['user'];

    if(isset($_POST['comment'])){
        $username = $user['username'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['msg'];

        if(empty($comment)){
            header('location: ../view/discussion.php?err=commentFieldEmpty');
            exit();
        }

        addComment($post_id, $username, $comment);

    }

    if(isset($_POST['delete_comment'])){
        $comment_id = $_POST['comment_id'];

        $status = deleteComment($comment_id);

        if($status){
            header('location: ../view/discussion.php?success=commentDeleted');
            exit();
        }

    }

    else if(isset($_POST['post'])){

        $title = $_POST['title'];
        $body = $_POST['body'];
        $domain_id = $_POST['domain_id'];
        $author = $user['username'];

        if(empty($title) or empty($body) or empty($domain_id)){
            header('location: ../view/discussion.php?err=postFieldEmpty');
            exit();
        }
        

        $status = addPost($author, $domain_id, $title, $body);

        if($status){
            header('location: ../view/discussion.php?success=posted');
            exit();
        }else{
            header('location: ../view/discussion.php?err=failed');
            exit();
        }
    }


    header('location: ../view/discussion.php');

?>