<?php
session_start();
require_once('../model/userModel.php');


if (!isset($_SESSION['logged_in'])) {
    header('location: signin.php');
    exit();
}

$user = $_SESSION['user'];

if ($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin') {
    header('location: profile.php?username=' . $user['username']);
    exit();
}

if (isset($_POST['clear'])) {

    header('location: manage_user.php');
    exit();
}

$view = '';
if (isset($_GET['view'])) {
    $view = $_GET['view'];
}

if (isset($_POST['search'])) {

    $users = getAllUsers($_POST['search_value'], $view);
} else $users = getAllUsers(like: $view);



?>


<!DOCTYPE html>
<html>

<head>
    <title>User Account Management</title>
    <script src="../controller/js/manage-user.js"></script>
    <style>
    table {
      margin: 0 auto;
    }

    /* Style for fieldset  */
    fieldset {
        background-color: #fff;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    td font[color="red"] {
        color: red;
        font-weight: bold; 
    }

    td font[color="orange"] {
        color: orange;
        font-weight: bold; 
     }

    td font[color="green"] {
        color: green;
        font-weight: bold; 
    }

    td font[color="#ff8080"] {
        color: #ff8080;
        font-weight: bold; 
    }

    td font[color="#ae7ef1"] {
        color: #ae7ef1;
        font-weight: bold; 
    }


    /* Style for buttons inside cells */
    td input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    td input[type="submit"]:hover {
    background-color: #0056b3;
    }

    input[type="text"][name="search_value"] {
        padding: 8px;
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"][name="search"],
    input[type="submit"][name="clear"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    input[type="submit"][name="search"]:hover,
    input[type="submit"][name="clear"]:hover {
    background-color: #0056b3;
    }

    select[name="filter"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    a {
        color: #1E90FF;
      
    }

    a:hover {
        text-decoration: underline;
        color:red;
    }
    .error-msg {
      color: red;
    }

</style>

</head>

<body>
    <?php require_once('top_navbar.php'); ?>

    <table align="center">
        <tr>
            <td>
                <fieldset>
                        <h3 align="center">User Account Management</h3>
                    <table cellspacing="0" cellpadding="10" align="center" id="user-table">
                        <tr>
                            <td colspan="5" align="center">
                                <form action="" method="post">
                                    <input type="text" name="search_value" id="search" onkeypress="setTimeout(update_list, 500)" placeholder="Enter username or email" <?php if (isset($_POST['search'])) echo "value='" . $_POST['search_value'] . "'" ?> size=30> &nbsp;
                                    <input type="submit" name="search" value="Search">
                                    <input type="submit" name="clear" value="Clear">

                                    <p align="center">
                                        <b>Filter</b> &nbsp;
                                        <select name="filter" id="" onchange="location = this.value">
                                            <option value="manage_user.php" <?php if (!isset($_GET['view'])) echo 'selected' ?>>All</option>
                                            <option value="manage_user.php?view=Aspirant" <?php if (isset($_GET['view']) and $_GET['view'] == 'Aspirant') echo 'selected' ?>>Aspirant</option>
                                            <option value="manage_user.php?view=Professional" <?php if (isset($_GET['view']) and $_GET['view'] == 'Professional') echo 'selected' ?>>Professional</option>
                                            <?php
                                            if ($user['role'] == 'SuperAdmin') {
                                            ?>
                                                <option value="manage_user.php?view=Admin" <?php if (isset($_GET['view']) and $_GET['view'] == 'Admin') echo 'selected' ?>>Admin</option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </p>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th>Username <br>
                                <hr>
                            </th>
                            <th>Email <br>
                                <hr>
                            </th>
                            <th>Role <br>
                                <hr>
                            </th>
                            <th>Action <br>
                                <hr>
                            </th>
                            <th>Status <br>
                                <hr>
                            </th>
                        </tr>
                        <?php
                        if (sizeof($users) == 0) {
                        ?>
                            <tr>
                                <td colspan="5" align="center"><b><i>No user found</i></b></td>
                            </tr>
                            <?php
                        } else {
                            foreach ($users as $temp_user) {
                                if ($temp_user['role'] == 'Admin' and $user['role'] != 'SuperAdmin') continue;
                                if ($temp_user['role'] == 'SuperAdmin') continue;
                            ?>
                                <form action="../controller/manage_user_process.php" method="post">
                                    <tr>
                                        <td>
                                            <img src="../vendor/profiles/<?= $temp_user['profile_location'] ?>" alt="" width="30">
                                            <br>
                                            <a href="profile_view.php?username=<?= $temp_user['username'] ?>"><?= $temp_user['username'] ?></a>
                                        </td>
                                        <td><?= $temp_user['email'] ?></td>
                                        <td><?= $temp_user['role'] ?></td>
                                        <td>
                                            <input type="hidden" name="username" value="<?= $temp_user['username'] ?>">
                                            <input type="hidden" name="view" value="<?= $view ?>">
                                            <input type="submit" name="update_user" value="Update">
                                            <?php if ($temp_user['isExist'] == 'false') {
                                            ?>
                                                <input type="submit" name="restore" value="Restore">
                                            <?php
                                            } else {
                                            ?>
                                                <input type="submit" name="remove" value="Remove">
                                                <?php
                                                if ($temp_user['status'] == 'banned') {
                                                ?>
                                                    <input type="submit" name="unban" value="Unban">
                                                <?php
                                                } else {
                                                ?>
                                                    <input type="submit" name="ban" value="Ban">
                                            <?php
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php
                                            if ($temp_user['isExist'] == 'false') echo '<font color = "red">Removed Users</font>';
                                            else if ($temp_user['status'] == 'invalid') echo '<font color = "orange">Invalid</font>';
                                            else if ($temp_user['status'] == 'valid') echo '<font color = "green">Valid</font>';
                                            else if ($temp_user['status'] == 'banned') echo '<font color = "#ff8080">Banned</font>';
                                            else if ($temp_user['status'] == 'unverified') echo '<font color = "#ae7ef1">Unverified</font>';
                                            ?>
                                        </td>

                                    </tr>
                                </form>
                            <?php
                            }
                            ?>
                            <form action="../controller/manage_user_process.php" method="post">
                                <tr align="center">
                                    <td colspan="5">
                                        <hr>
                                        <input type="submit" name="ban_all" value="Ban All User"> &nbsp;
                                        <input type="submit" name="unban_all" value="Unban All User"> &nbsp;
                                        <input type="submit" name="remove_all" value="Remove All User"> &nbsp;
                                        <input type="submit" name="restore_all" value="Restore All Deleted User">
                                        <hr>
                                    </td>
                                </tr>
                            </form>
                        <?php
                        }
                        ?>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>