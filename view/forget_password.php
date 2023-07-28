<?php
session_start();


$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'shortPassword': {
                $msg = "Password length must be 8 or more long.";
                break;
        }
        case 'passwordMismatch': {
                $msg = "Password and confrim password does not match";
                break;
        }
        case 'failed': {
                $msg = "Password failed to change.";
                break;
        }
        case 'wrongEmail': {
                $msg = "Email doesn't match to any user.";
                break;
        }
        case 'otpMismatch': {
                $msg = "Wrong OTP.";
                break;
        }
        case 'sendFailed': {
                $msg = "failed to send OTP.";
                break;
         }
        case 'invalidEmail': {
            $msg = "Invalid email. Please provide a proper email address";
            break;
        }
        case 'empty': {
            $msg = "Field(s) cannot be empty";
            break;
        }
    }
}

$success_msg = '';
if (isset($_GET['success'])) {
    $s_msg = $_GET['success'];
    switch ($s_msg) {
        case 'sent': {
                $success_msg = "OTP sent.";
                break;
            }
    }
}

if(isset($_SESSION['logged_in'])){
  header('location: profile.php');
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Professional Sage | Forgot Password</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <legend align="center">
                        <h3>Forgot Password</h3>
                    </legend>

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
                            <form action="../controller/get_verification_code.php" method="post">
                                <div>
                                    <td><label for="email">Email:</label></td>
                                    <td><input type="email" id="email" name="email" value="<?php if (isset($_SESSION['forget_password_email'])) echo $_SESSION['forget_password_email'] ?>"> &nbsp;</td>
                                    <td><input type="submit" value="Get OTP" /></td>

                                </div>
                            </form>
                        </tr>
                        <form action="../controller/forget_password_process.php" method="POST">
                            <tr>
                                <div>
                                    <td><label for="new-password">New Password:</label></td>
                                    <td><input type="password" id="new-password" name="new_password"></td>
                                </div>
                            </tr>
                            <tr>
                                <div>
                                    <td><label for="confirm-password">Confirm Password:</label></td>
                                    <td><input type="password" id="confirm-password" name="confirm_password"></td>
                                </div>
                            </tr>
                            <tr>
                                <div>
                                    <td>OTP:</td>
                                    <td><input type="text"  name="otp"></td>
                                </div>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="3">
                                    <a href="signin.php"><input type="button" name="" value="Sign In"></a> &nbsp;
                                    <input type="submit" name="reset" value="Reset Password">
                                </td>
                            </tr>
                        </form>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>