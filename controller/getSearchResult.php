<?php

include('../model/userModel.php');
include('../model/discussion_postsModel.php');

if(isset($_POST['get_searched_users'])){
    $search = $_POST['search'];
    echo json_encode(getAllUsers($search));
}
else if(isset($_POST['get_searched_posts'])){
    $search = $_POST['search'];
    echo json_encode(getAllPosts($search));
}

?>