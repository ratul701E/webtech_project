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
  <script src="../controller/js/signin.js"></script>
  <style>
    /* Reset some default styles for better consistency */
    body,
    h3,
    table,
    tr,
    td,
    fieldset {
      margin: 0;
      padding: 0;
      border: none;
    }

    /* Set a background color for the body */
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }

    /* Center align the h3 element */
    h3 {
      text-align: center;
      color: #007bff;
      /* Set the color for the heading */
      padding: 10px 0;
      font-size: 24px;
      /* Set the font size for the heading */
      font-weight: bold;
      /* Set the font weight for the heading */
      text-transform: uppercase;
      /* Convert the text to uppercase */
    }


    /* Center align the table */
    table {
      margin: 20px auto;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    /* Add some padding to table cells */
    td {
      padding: 10px;
    }

    /* Set the color for labels in the table */
    td[style="color: skyblue;"] {
      color: skyblue;
    }

    /* Set the color for the checkbox label */
    td[style="color: red;"] {
      color: red;
    }

 
    input[type="text"],
    input[type="password"] {
      width: 200px;
      padding: 6px 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    /* Style the "Sign In" button */
    input[type="submit"] {
      background-color: #007bff;
      color: #fff;
      padding: 6px 10px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      transition: background-color 0.3s;
      /* Add transition effect for smooth color change */
    }

    /* Add hover style for the "Sign In" button */
    input[type="submit"]:hover {
      background-color: #6eadf0;
      /* Change the background color on hover */
    }
  </style>

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

          <form action="../controller/signin_process.php" method="post" onsubmit="return validate()">
            <table align="center">
              <tr>
                <td align="center" colspan="2">
                  <div style="color:red">
                    <p id='err_msg'></p>
                  </div>
                </td>
              </tr>
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
                <td style="color: black;">Username/Email</td>
                <td><input type="text" name="username" id="username" onkeyup="checkUsername()"></td>
              </tr>
              <tr>
                <td style="color: black;">Password</td>
                <td><input type="password" name="password" id="password"></td>
              </tr>
              <tr>
                <td colspan="2" style="color: red;"><input type="checkbox" name="save" value="yes" checked>Save credentials</td>
              </tr>
              <tr>
              <tr>
                <td colspan="2" align="right"><input type="submit" name="signin" value="Sign In"></td>
              </tr>

              <tr>
                <td colspan="2" align="right">
                  <hr>
                </td>
              </tr>
              <tr>
                <td colspan="2">Not a member? <a href="signup.php">Signup here</a></td>
              </tr>

              <tr>
                <td colspan="2"> <a href="forget_password.php">Forget Password</a></td>
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