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
    if(isExistUser($email,$email)) echo 'true';
    else echo 'false';
    
}

?>