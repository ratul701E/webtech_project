<?php
include('../model/userModel.php');
include('../controller/validation.php');


if(isset($_POST['checkUser'])){
    $username = $_POST['username'];
    if(isExistUser($username,$username)) echo 'true';
    else echo 'false';
    
}

else if(isset($_POST['checkEmail'])){
    $email = $_POST['email'];
    if(isExistUser('',$email)) echo 'true';
    else echo 'false';
    
}
else if(isset($_POST['checkPassword'])){
    $username = $_POST['username']; 
    $password = $_POST['password']; 
    if(login($username,$password)) echo 'true';
    else echo 'false';
    
}

?>