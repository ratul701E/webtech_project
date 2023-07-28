<?php
    require_once('db.php');


    function addComment($post_id, $username, $comment){
        
        $con = dbConnection();
        $sql = "INSERT into discussion_comments values(
                                        '',
                                        '{$post_id}',
                                        '{$username}',
                                        CURRENT_TIMESTAMP,
                                        '{$comment}'
                                        )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deleteComment($id){
        $con = dbConnection();
        $sql = "DELETE FROM discussion_comments where comment_id='{$id}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;

    }

    function getAllComment($id){
        $con = dbConnection();
        $sql = "SELECT * from discussion_comments where post_id = '{$id}';";
        
        if($result = mysqli_query($con, $sql)){
            $comments = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($comments, $row);
            }
            return $comments;
        }
        return false;
    }

?>