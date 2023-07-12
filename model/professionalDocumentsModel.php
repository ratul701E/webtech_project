<?php
    require_once('db.php');


    function addDocument($username, $location){
        
        $con = dbConnection();
        $sql = "INSERT into professional_documents values(
                                        '{$username}',
                                        '{$location}'
                                        )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deleteDocument($username, $file){
        $con = dbConnection();
        $sql = "DELETE FROM professional_documents where username='{$username}' and file_location='{$file}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;

    }

    function getDocuments($username){
        $con = dbConnection();
        $sql = "SELECT file_location from professional_documents where username='{$username}';";
        
        if($result = mysqli_query($con, $sql)){
            $files = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($files, $row['file_location']);
            }
            return $files;
        }
        return false;
    }

?>