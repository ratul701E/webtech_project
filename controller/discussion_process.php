<?php
    session_start();
    require_once('../model/discussion_commentsModel.php');
    require_once('../model/discussion_postsModel.php');

    $user = $_SESSION['user'];

    if(isset($_POST['comment'])){
        $username = $user['username'];
        $post_id = $_POST['post_id'];
        $comment = $_POST['msg'];

        addComment($post_id, $username, $comment);

    }

    else if(isset($_POST['post'])){

        $title = $_POST['title'];
        $body = $_POST['body'];
        $domain_id = $_POST['domain_id'];
        $author = $user['username'];

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