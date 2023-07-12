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

    function deleteQuery(){

    }

    function getAllQuery(){
        $con = dbConnection();
        $sql = "SELECT * from query;";
        
        //

    }

    function updateUser(){
        
    }

?>