<?php
session_start();

if (isset($_SESSION['logged_in'])) {
    header('location: profile.php?username=' . $_SESSION['username']);
    exit();
}

require_once('../model/userModel.php');
if (isset($_COOKIE['logged_in'])) {
    $user = getUser($_COOKIE['username']);

    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $user['username'];
    $_SESSION['user'] = $user;
}

$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'mismatch': {
                $msg = "Wrong username or password.";
                break;
        }
        case 'falseUser': {
                $msg = "Your account has been deleted. Support";
                break;
        }
        case 'bannedUser': {
                $msg = "Your account is currently banned by admin. Support";
                break;
         }
        case 'empty': {
                $msg = "Field(s) cannot be empty.";
                break;
         }
    }
}

$success_msg = '';
if (isset($_GET['success'])) {
    $s_msg = $_GET['success'];
    switch ($s_msg) {
        case 'changed': {
                $success_msg = "Password Changed successfully.";
                break;
            }
        case 'created': {
                $success_msg = "Account successfully created. Please sign in.";
                break;
            }
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Professional Sage | Signin</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>

    <table align='center'>
        <tr>
            <td>
                <fieldset>
                    <legend align="center">
                        <h3>Signin</h3>
                    </legend>
                    <form action="../controller/signin_process.php" method="post">
                        <table align="center">

                            <?php if (strlen($msg) > 0) { ?>
                                <tr align="center">
                                    <td colspan="2">
                                        <font color="red"><?= $msg ?></font>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if (strlen($success_msg) > 0) { ?>
                                <tr align="center">
                                    <td colspan="2">
                                        <font color="green"><?= $success_msg ?></font>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td>Username/Email</td>
                                <td><input type="text" name="username"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="checkbox" name="save" value="yes" checked>Save credentials</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right"><input type="submit" name="signin" value="Sign In" id=""></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="right">
                                    <hr>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">Not a member? <a href="signup.php">Singup here</a> </td>
                            </tr>
                            <tr>
                                <td colspan="2"> <a href="forget_password.php">Forget Password</a> </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </td>
        </tr>
    </table>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>