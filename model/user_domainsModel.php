<?php
    require_once('db.php');


    function addUserDomain($username, $domain_id){
        
        $con = dbConnection();
        $sql = "INSERT into user_domains values(
                                        '$username',
                                        '{$domain_id}'
                                        )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deleteDomain($username, $domain_id){
        $con = dbConnection();
        $sql = "DELETE FROM user_domains where username='{$username}' and domain_id='{$domain_id}';";
        if(mysqli_query($con, $sql)){
            return true;
        }
        return false;

    }

    function getUserDomains($username){
        $con = dbConnection();
        $sql = "SELECT * from domains where domain_id in (SELECT domain_id from user_domains where username='$username');";
        
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