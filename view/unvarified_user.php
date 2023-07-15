<?php
     session_start();

     if(!isset($_SESSION['logged_in']) ) {
         header('location: signin.php');
         exit();
     }
     
    
     $user = $_SESSION['user'];

     if($user['status'] != 'unvarified'){
        header('location: profile.php?username='.$user['username']);
        exit();
    }

    $msg = '';
    if(isset($_GET['err'])){
        $err_msg = $_GET['err'];
        switch($err_msg){
            case 'failed':{$msg = "Failed to varify."; break;}
            case 'otpMismatch':{$msg = "Wrong OTP."; break;}
        }   
    }

    $success_msg = '';
    if(isset($_GET['success'])){
        $s_msg = $_GET['success'];
        switch($s_msg){
            case 'sent':{$success_msg = "OTP sent."; break;}
            
        }   
    }



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Unvarified User</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <fieldset>
        <legend align="center"><h3>Unvarified Account</h3></legend>
        <table align="center">

            <tr>
                <td align="center" colspan="2"><img src="../vendor/profiles/<?=$user['profile_location']?>" alt="" width="200"></td>
            </tr>
            <tr>
                <td><b>Name:</b></td>
                <td><?=$user['first_name'].$user['last_name']?></td>
            </tr>
            <tr>
                <td><b>Email:</b></td>
                <td><?=$user['email']?></td>
            </tr>
            <form action="../controller/unvarified_user_process.php" method="post">
                <tr>
                    <td><b>Enter OTP</b></td>
                    <td><input type="number" name="otp" id=""></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        
                        <input type="submit" name="get_otp" value="Get OTP">
                        <input type="submit" name="verify" value="Verify">
                        
                    </td>
                </tr>
                <?php if(strlen($msg) > 0){ ?>
                    <tr align="center">
                        <td colspan="2"><font color="red"><?=$msg?></font></td>
                    </tr>
                <?php } ?>

                <?php if(strlen($success_msg) > 0){ ?>
                    <tr align="center">
                        <td colspan="2"><font color="green"><?=$success_msg?></font></td>
                    </tr>
                <?php } ?>

            </form>

            <tr>
                
                <td align="center" colspan="2"><a href="update_profile.php">Update Profile</a></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><a href="change_password.php">Change Password</a></td>
            </tr>
            
        </table>    
    </fieldset>
    <?php include('bottom_nav.php'); ?>
</body>
</html>