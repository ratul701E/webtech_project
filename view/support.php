<?php
  session_start();
  if(isset($_SESSION['logged_in'])){
    $user = $_SESSION['user'];
  }

  $msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
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
                $success_msg = "Query sent to admins.";
                break;
            }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Professional sage | Support</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <form action="../controller/supportprocess.php" method="POST">
        <table align="center">
            <tr>
                <td>
                    <fieldset>
                        <legend align="center">
                            <h3>Support</h3>
                        </legend>
                        <p align="center"><b><i>*Our admin will update you on the given email. It can take 2-3 days long.</i></b></p>
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
                                <td>Email:</td>
                                <td><input type="text" name="email" id=""></td>
                            </tr>
                            <tr>
                                <td><label for="query">Query:</label></td>
                                <td><textarea name="query" id="" cols="25" rows="3" ></textarea></td>
                            </tr>
                            <tr>
                                <td align="right" colspan="2"><button type="submit" name="submit">Submit Query</button></td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </form>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>