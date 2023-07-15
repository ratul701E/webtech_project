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
                                    <td><input type="email" id="email" name="email" value="<?php if (isset($_SESSION['forget_password_email'])) echo $_SESSION['forget_password_email'] ?>" required> &nbsp;</td>
                                    <td><input type="submit" value="Get Verfication code" /></td>

                                </div>
                            </form>
                        </tr>
                        <form action="../controller/forget_password_process.php" method="POST">
                            <tr>
                                <div>
                                    <td><label for="new-password">New Password:</label></td>
                                    <td><input type="password" id="new-password" name="new_password" required></td>
                                </div>
                            </tr>
                            <tr>
                                <div>
                                    <td><label for="confirm-password">Confirm Password:</label></td>
                                    <td><input type="password" id="confirm-password" name="confirm_password" required></td>
                                </div>
                            </tr>
                            <tr>
                                <div>
                                    <td><label for="verification-code">Verification Code:</label></td>
                                    <td><input type="text" id="verification-code" name="otp" required></td>
                                </div>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2"><input type="submit" name="reset" value="Reset"></td>
                            </tr>
                        </form>


                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</body>

</html>