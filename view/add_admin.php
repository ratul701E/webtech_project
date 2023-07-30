<?php
session_start();
require_once('../model/discussion_postsModel.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: ../view/signin.php?');
    exit();
}

$user = $_SESSION['user'];
if ($user['role'] != 'SuperAdmin') {
    header('location: profile.php?username=' . $user['username']);
    exit();
}

$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'userExist': {
                $msg = "Username or email is already registred.";
                break;
            }
        case 'shortPassword': {
                $msg = "Password length must be 8 or more long.";
                break;
            }
        case 'failed': {
                $msg = "Something went wrong. Please try agian";
                break;
            }
        case 'invalidUsername': {
                $msg = "The username is invalid. Note: Alpahbets and underscore only and at least 4 character long";
                break;
            }
        case 'invalidFirstName': {
                $msg = "First name is invalid. Note: Alphabet & space only and at least 3 character long";
                break;
            }

        case 'invalidLastName': {
                $msg = "Last name is invalid. Note: Alphabet space only and at least 3 character long";
                break;
            }

        case 'invalidEmail': {
                $msg = "Invalid email. Please provide a proper email address";
                break;
            }
        case 'invalidPhone': {
                $msg = "Your phone is invalid. Note: DO NOT INCLUDE COUNTRY CODE";
                break;
            }
        case 'invalidAddress': {
                $msg = "Are your address is ok?. Please provide a details address.";
                break;
            }
        case 'invalidPassword': {
                $msg = "Password at least 8 character long.";
                break;
            }
    }
}
$success_msg = '';
if (isset($_GET['success'])) {
    $s_msg = $_GET['success'];
    switch ($s_msg) {
        case 'created': {
                $success_msg = "Admin account created. Add MORE?";
                break;
            }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Admin</title>
    <script src="../controller/js/add-admin.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* Top navigation bar styles (assuming you have a top_navbar.php file) */
        /* Modify these styles according to your design */

        .top-navbar {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .top-navbar a {
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
        }

        .top-navbar a:hover {
            background-color: #555;
        }

        /* Centering elements */

        .center {
            text-align: center;
        }

        /* Form field styles */

        fieldset {
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        legend {
            font-weight: bold;
            font-size: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        select {
            height: 35px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"],
        input[type="button"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #45a049;
        }

        /* Error and success message styles */

        .error-msg {
            color: red;
            font-size: 14px;
        }

        .success-msg {
            color: green;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <center>
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

        <div>
            <span id="empty_err" color="red"></span>
        </div>

    </center>

    <table align="center" bgcolor="#f1f1f1">
        <tr>
            <td>
                <fieldset>
                    <legend>Add Admin</legend>
                    <form method="POST" action="../controller/add_admin_process.php" onsubmit="return validate()">
                        <table cellspacing="0" cellpadding="5">

                            <tr>
                                <td bgcolor="#AED6F1  "><strong>Username:</strong></td>
                                <td>
                                    <input type="text" id="username" name="username" onkeyup="checkUsernameExist()">
                                    <br>
                                    <div class="msg">
                                        <span id="username_msg"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>First Name:</strong></td>
                                <td><input type="text" id="first-name" name="first_name"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Last Name:</strong></td>
                                <td><input type="text" id="last-name" name="last_name"></td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Email Address:</strong></td>
                                <td>
                                    <input type="email" id="email" name="email" onkeyup="checkEmailExist()">
                                    <br>
                                    <div class="msg">
                                        <span id="email_msg"></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Gender:</strong></td>
                                <td>
                                    <select id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Country/Region:</strong></td>
                                <td>
                                    <select id="country" name="country">
                                        <option value="USA">United States of America</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="India">India</option>
                                        <option value="China">China</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>

                                <td bgcolor="#AED6F1 "><strong>Phone Number:</strong></td>
                                <td>
                                    <i>
                                        <font color="red" size="2">*without country code</font>
                                    </i> <br>
                                    <input type="tel" id="phone" name="phone">
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Address:</strong></td>
                                <td><textarea name="address" id="address" cols="20" rows="3"></textarea></td>
                            </tr>
                            <tr>
                                <td bgcolor="#AED6F1 "><strong>Password:</strong></td>
                                <td><input type="password" id="password" name="password"></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <a href="profile.php?username=" <?= $user['username'] ?>><input type="button" value="Back"></a>
                                    <input type="submit" value="Add as Admin" name="add_admin">
                                </td>
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