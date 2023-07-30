<?php
session_start();
require_once('../model/userModel.php');

if (!isset($_SESSION['logged_in'])) {
    header('location: signin.php');
    exit();
}

if (!isset($_GET['username'])) {
    header('location: profile.php?username=' . $_SESSION['username']);
    exit();
}

$visited_user = getUser($_GET['username']);

if ($_SESSION['username'] == $visited_user['username']) {
    header('location: profile.php?username=' . $_SESSION['username']);
    exit();
}

$user = $_SESSION['user'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile | <?= $visited_user['username'] ?></title>
    <style>/* Style for the outer fieldset */
        fieldset {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Center the profile heading */
        fieldset b[align="center"] {
        text-align: center;
        }

        /* Style for the profile image */
        fieldset img {
            display: block;
            margin: 0 auto; 
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
        }

        /* Style for the profile heading */
        fieldset h3 {
            margin-bottom: 10px;
            color: #007bff;
        }

        /* Style for the profile role */
        fieldset b {
            color: #444;
            font-size: 16px;
        }

        /* Style for the table cell containing bold text */
        fieldset td b {
        font-weight: bold;
        }

        /* Style for hyperlinks */
        a {
        color: #1E90FF;
        text-decoration: none;
        }

        a:hover {
        text-decoration: underline;
        color: red;
        }
        
        input[type="radio"] {
      margin-right: 5px;
    }

    /* Style for the buttons */
    input[type="submit"],
    input[type="button"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 10px;
      cursor: pointer;
      margin-right: 10px;
    }

    /* Style for the submit button on hover */
    input[type="submit"]:hover,
    input[type="button"]:hover {
      background-color: #0056b3;
    }



    </style>
    </head>

<body>

    <?php require_once('top_navbar.php'); ?>

    <table align="center">
        <tr>
            <td align="center">
                <fieldset>
                        <b >Profile • @<?= $visited_user['username'] ?> • <?= $visited_user['role'] ?></b>
                    </legend>

                    <table align="center">
                        <tr>
                            <td colspan="2">
                                <img src="../vendor/profiles/<?= $visited_user['profile_location'] ?>" alt="" width="200"> <br> <br> <br>
                            </td>

                            <td width="20"> </td>

                            <td>
                                <h3>Account Informaion</h3>
                                <table>
                                    <tr>
                                        <td><b>Name:</b></td>
                                        <td><?= $visited_user['first_name'] . " " . $visited_user['last_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td><?= $visited_user['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone:</b></td>
                                        <td><?= $visited_user['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b></td>
                                        <td><?= $visited_user['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Country:</b></td>
                                        <td><?= $visited_user['country'] ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>

    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>