<?php
    require_once('../model/discussion_postsModel.php');

    if(isset($_POST['remove'])){

        $post_id = $_POST['post_id'];
        deletePost($post_id);
        header('location: ../view/discussion.php?success=deleted');
        exit();
    }   

    else if(isset($_POST['save_changes'])){
        $body = $_POST['body'];
        $title = $_POST['title'];
        $domain_id = $_POST['domain_id'];
        $post_id = $_POST['post_id'];

        if(empty($title) or empty($body) or empty($domain_id)){
            header('location: ../view/discussion.php?err=editFailed');
            exit();
        }

        updatePost($post_id, $domain_id, $title, $body);
        header('location: ../view/discussion.php?success=updated');
        exit();

    }

    else header('location: ../view/signin.php');
?>