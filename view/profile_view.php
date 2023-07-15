<?php
    session_start();
    require_once('../model/userModel.php');

    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }
    
    if(!isset($_GET['username'])){
        header('location: profile.php?username='.$_SESSION['username']);
        exit();
    }

    $user = getUser($_GET['username']);

    if($_SESSION['username'] == $user['username']){
        header('location: profile.php?username='.$_SESSION['username']);
        exit();
    }

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile | <?= $user['username']?></title>
</head>
<body>
    
    <?php require_once('topnavigationbar.php'); ?>

    <fieldset>
        <legend align="center">
            <b>Profile • @<?= $user['username']?> • <?=$user['role'] ?></b>
        </legend>

        <table align="center">
            <tr>
                <td colspan="2">
                    <img src="../vendor/profiles/<?=$user['profile_location']?>" alt="" width="200"> <br> <br> <br>
                </td>

                <td width="20"> </td>

                <td>
                    <h3>Account Informaion</h3>
                    <table>
                        <tr>
                            <td><b>Name:</b></td>
                            <td><?=$user['first_name']." ". $user['last_name']?></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><?=$user['email']?></td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td><?=$user['phone']?></td>
                        </tr>
                        <tr>
                            <td><b>Address:</b></td>
                            <td><?=$user['address']?></td>
                        </tr>
                        <tr>
                            <td><b>Country:</b></td>
                            <td><?=$user['country']?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </fieldset>
    
    <?php include_once('bottom_nav.php'); ?>
</body>
</html>