<?php
    session_start();
    require_once('../model/discussion_postsModel.php');

    if(!isset($_SESSION['logged_in'])){
        header('location: ../view/signin.php?');
        exit();
    }

    $user = $_SESSION['user'];
    if($user['role'] != 'SuperAdmin'){
        header('location: profile.php?username='.$user['username']);
        exit();
    }

    $msg = '';
    if(isset($_GET['err'])){
        $err_msg = $_GET['err'];
        switch($err_msg){
            case 'userExist':{$msg = "Username or email is already registred."; break;}
            case 'shortPassword':{$msg = "Password length must be 8 or more long."; break;}
            case 'failed':{$msg = "Something went wrong. Please try agian"; break;}
        }
    }
    $success_msg = '';
    if(isset($_GET['success'])){
        $s_msg = $_GET['success'];
        switch($s_msg){
            case 'created':{$success_msg = "Admin account created. Add MORE?"; break;}
            
        }   
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <table align="center"  bgcolor="#f1f1f1">
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
        <tr>
            <td>
                <fieldset>
                    <legend>Add Admin</legend>
                    <form method="POST" action="../controller/add_admin_process.php">
                    <table cellspacing="0" cellpadding="5">
                        <tr>
                            <td bgcolor="#AED6F1  "><strong>Username:</strong></td>
                            <td><input type="text" id="username" name="username" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>First Name:</strong></td>
                            <td><input type="text" id="first-name" name="first_name" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Last Name:</strong></td>
                            <td><input type="text" id="last-name" name="last_name" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Email Address:</strong></td>
                            <td><input type="email" id="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Phone Number:</strong></td>
                            <td><input type="tel" id="phone" name="phone" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Gender:</strong></td>
                            <td>
                                <select id="gender" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Country/Region:</strong></td>
                            <td><input type="text" id="country" name="country" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Address:</strong></td>
                            <td><input type="text" id="address" name="address" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Password:</strong></td>
                            <td><input type="password" id="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <a href="profile.php?username="<?=$user['username']?>><input type="button" value="Back" ></a>
                                <input type="submit" value="Add as Admin" name="add_admin">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>

</body>
</html>
