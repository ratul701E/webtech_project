<?php
    require_once('db.php');


    function addDomain($name){
        
        $con = dbConnection();
        $sql = "INSERT into domains values(
                                        '',
                                        '{$name}'
                                        )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deleteDomains($id){
        $con = dbConnection();
        $sql = "DELETE FROM domains where id='{$id}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;

    }

    function getAllDomains($username){
        $con = dbConnection();
        $sql = "SELECT * from domains where domain_id NOT IN (SELECT domain_id from user_domains where username='{$username}');";
        
        if($result = mysqli_query($con, $sql)){
            $domains = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($domains, $row);
            }
            return $domains;
        }
        return false;
    }

?>