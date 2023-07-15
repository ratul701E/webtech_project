<?php
    session_start();
    if(!isset($_SESSION['logged_in']) ) header('location: signin.php');

    $user = $_SESSION['user'];

    $msg = '';
    if(isset($_GET['err'])){
        $err_msg = $_GET['err'];
        switch($err_msg){
            case 'oldPasswordMismatch':{$msg = "Old password not matched."; break;}
            case 'newPasswordMismatch':{$msg = "New passwords not matched"; break;}
            case 'shortPassword':{$msg = "Password length must be 8 or more long."; break;}
            case 'passwordMismatch':{$msg = "Password and confrim password does not match"; break;}
        }
            
    }
    

?>

<!DOCTYPE html>
<html>
<head>
  <title>Professional Sage | Change Password</title>
</head>
<body>
  <?php require_once('topnavigationbar.php'); ?>
  <fieldset>
    <legend align="center"><h3>Change Password @<?=$user['username']?></h3></legend>
    <form action="../controller/change_password_process.php" method="post">
      <table align="center">
        <?php if(strlen($msg) > 0){ ?>
            <tr align="center">
                <td colspan="2"><font color="red"><?=$msg?></font></td>
            </tr>
        <?php } ?>
        <tr>
          <td><label for="oldPassword">Old Password</label></td>
          <td><input type="password" id="oldPassword" name="old_password" required></td>
        </tr>
        <tr>
          <td><label for="newPassword">New Password</label></td>
          <td><input type="password" id="newPassword" name="new_password" required></td>
        </tr>
        <tr>
          <td><label for="confirmNewPassword">Confirm New Password</label></td>
          <td><input type="password" id="confirmNewPassword" name="confirm_new_password" required></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
              <a href="profile.php?username=<?=$user['username']?>"><input type="button"  value="Back"></a>
              <input type="submit" name="change_password" value="Change Password">
            </td>
        </tr>
      </table>

    </form>
  </fieldset>
</body>
</html>
