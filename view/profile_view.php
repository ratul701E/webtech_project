<?php
    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }

    

?>