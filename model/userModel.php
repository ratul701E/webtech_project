<?php
    require_once('db.php');

    function login($username, $password){
        $con = dbConnection();
        $sql = "select * from user where (username='{$username}' or email='{$username}') and password='{$password}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    function addUser($username, $first_name, $last_name, $email, $phone, $gender, $country, $address, $password, $role, $profile_location, $status, $isExist='true'){
        
        $con = dbConnection();
        $sql = "INSERT into user values(
                                        '{$username}',
                                        '{$first_name}',
                                        '{$last_name}',
                                        '{$email}',
                                        '{$phone}',
                                        '{$gender}',
                                        '{$country}',
                                        '{$address}',
                                        '{$password}',
                                        '{$role}',
                                        '{$profile_location}',
                                        '{$status}',
                                        '{$isExist}'
            
            )";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function deleteUser(){

    }

    function isExistUser($username, $email){
        $con = dbConnection();
        $sql = "SELECT * from user where username='{$username}' or email='{$email}'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    function getUser($email_or_username){
        $con = dbConnection();
        $sql = "SELECT * from user where email='{$email_or_username}' or username='{$email_or_username}';";
        
        if($result = mysqli_query($con, $sql)){
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    function updateUser($user, $username, $first_name, $last_name, $email, $phone, $gender, $country, $address, $password, $role, $profile_location, $status, $isExist){
        $con = dbConnection();
        $sql = "UPDATE user SET 
                                username='{$username}',
                                first_name='{$first_name}',
                                last_name='{$last_name}',
                                email='{$email}',
                                phone='{$phone}',
                                gender='{$gender}',
                                country='{$country}',
                                address='{$address}',
                                password='{$password}',
                                role='{$role}',
                                profile_location='{$profile_location}',
                                status='{$status}',
                                isExist='{$isExist}' WHERE email ='{$user}' or username='{$user}'";

        if(mysqli_query($con, $sql)){
            return true;
        }else {
            mysqli_error($con);
            return false;
        }
    }

    function getInvalidProfessionals(){
        $con = dbConnection();
        $sql = "SELECT * from user where role='Professional' and status='invalid' and isExist='true'";
        
        if($result = mysqli_query($con, $sql)){
            $users = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($users, $row);
            }
            return $users;
        }
        return false;
    }

    function getAllProfessionals($key=''){
        $con = dbConnection();
        $sql = "SELECT * from user where role='Professional' and isExist='true' and (username like '%{$key}%' or email like '%{$key}%')";
        
        if($result = mysqli_query($con, $sql)){
            $users = [];
            while($row=mysqli_fetch_assoc($result)){
                array_push($users, $row);
            }
            return $users;
        }
        return false;
    }


    function getAllUsers($email_or_username = '', $like = ''){
        $con = dbConnection();
        $sql = "SELECT * from user where (username like '%{$email_or_username}%' or email like '%{$email_or_username}%') and role like '%{$like}%';";
        
        if($result = mysqli_query($con, $sql)){
            $users = array();
            while($user = mysqli_fetch_assoc($result)){
                array_push($users, $user);
            }
            return $users;
        }
        return false;
    }

?>