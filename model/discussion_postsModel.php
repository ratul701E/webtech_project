<?php
    require_once('db.php');


    function addPost($author_username, $domain_id, $title, $body){
        
        $con = dbConnection();
        $sql = "INSERT into discussion_posts values(
                                        '',
                                        '{$author_username}',
                                        CURRENT_TIMESTAMP,
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

    function deleteAllPost(){
        $con = dbConnection();
        $sql = "DELETE FROM discussion_posts;";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;
    }

    function getAllPosts($like=''){
        $con = dbConnection();
        $sql = "SELECT * from discussion_posts  where author like '%{$like}%' or post_id like '%{$like}%' or date like '%{$like}%' order by date DESC;";
        
        if($result = mysqli_query($con, $sql)){
            $posts = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }
            return $posts;
        }
        return false;
    }

    function getUserAllPosts($username){
        $con = dbConnection();
        $sql = "SELECT * from discussion_posts where author='{$username}' order by date DESC;";
        
        if($result = mysqli_query($con, $sql)){
            $posts = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($posts, $row);
            }
            return $posts;
        }
        return false;
    }

    function getCommentedAllPosts($username){
        $con = dbConnection();
        $sql = "SELECT * from discussion_posts where post_id in (SELECT post_id from discussion_comments where username='{$username}') order by date DESC;";
        
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

    function updatePost($id, $domain_id, $title, $body){
        $con = dbConnection();
        $sql = "UPDATE discussion_posts SET 
                                last_edited=CURRENT_TIMESTAMP,
                                title='{$title}',
                                domain='{$domain_id}',
                                body='{$body}'
                                where post_id='{$id}';";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

?>