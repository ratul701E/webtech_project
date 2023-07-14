<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    require_once('../model/discussion_postsModel.php');

    if(isset($_POST['remove_post'])){
        $post_id = $_POST['post_id'];

        deletePost($post_id);

    }

    header('location: ../view/manage_discussionPosts.php');

?>