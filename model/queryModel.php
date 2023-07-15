<?php
    require_once('db.php');


    function addQuery($sender_email, $query){
        
        $con = dbConnection();
        $sql = "INSERT into query values(
                                        '',
                                        '{$sender_email}',
                                        '{$query}'
            
            )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }
 
    function deleteQuery($id){
        $con = dbConnection();
        $sql = "DELETE FROM query where query_id='{$id}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;
    }

    function getAllQuery(){
        $con = dbConnection();
        $sql = "SELECT * from query;";
        
        if($result = mysqli_query($con, $sql)){
            $queries = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($queries, $row);
            }
            return $queries;
        }
        return false;
    }

    function getQuery($id){
        $con = dbConnection();
        $sql = "SELECT * from query where query_id='{$id}';";
        
        if($result = mysqli_query($con, $sql)){
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    function updateQuery(){
        
    }

?>