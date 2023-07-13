<?php
    require_once('db.php');


    function addPost($author_username, $domain_id, $title, $body){
        
        $con = dbConnection();
        $sql = "INSERT into discussion_posts values(
                                        '',
                                        '{$author_username}',
                                        CURRENT_TIMESTAMP,
                                        '{$domain_id}',
                                        '{$title}',
                                        '{$body}'
                                        )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deletePost($id){
        $con = dbConnection();
        $sql = "DELETE FROM discussion_posts where post_id='{$id}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;

    }

    function getAllPosts($username = ''){
        $con = dbConnection();
        $sql = "SELECT * from discussion_posts;";
        
        if($result = mysqli_query($con, $sql)){
            $posts = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }
            return $posts;
        }
        return false;
    }

    function getPost($id){
        $con = dbConnection();
        $sql = "SELECT * from discussion_posts where post_id='{$id}';";
        
        if($result = mysqli_query($con, $sql)){
            return $row=mysqli_fetch_assoc($result);
        }
        return false;
    }


?>