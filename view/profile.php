<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('location: signin.php');
    exit();
}

$user = $_SESSION['user'];
$username = $_GET['username'];

if ($user['status'] == 'invalid') {
    header('location: unverified_professional.php');
    exit();
} else if ($user['status'] == 'unverified') {
    header('location: unverified_user.php');
    exit();
}


if ($username != $_SESSION['username']) {
    header('location: profile_view.php');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Profile | <?= $user['username'] ?></title>
    <style>
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
        margin: 0 auto; /* Center the image horizontally */
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


        /* Add spacing between table cells */
     table {
        border-spacing: 5px;
    }

        /* Center align the table */
    table.align-center {
        margin: 0 auto;
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
            <td>
                <fieldset>
                  
                        <b align="center">Profile • @<?= $user['username'] ?> • <?= $user['role'] ?></b>
                  

                    <table align="center">
                        <tr>
                            <td colspan="2">
                                <img src="../vendor/profiles/<?= $user['profile_location'] ?>" alt="" width="250" height="250"> <br> <br> <br>
                                <fieldset>
                                    <table align="center">
                                        <?php
                                        if ($user['role'] == 'Professional') {
                                        ?>
                                            <tr>
                                                <td><a href="">Followers</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="">Communication</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="">My Paths</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="discussion.php">Discussion</a>
                                                    <hr>
                                                </td>
                                            </tr>

                                        <?php
                                        } else if ($user['role'] == 'Aspirant') {
                                        ?>
                                            <tr>
                                                <td><a href="">Following</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="">Communication</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="discussion.php">Discussion</a>
                                                    <hr>
                                                </td>
                                            </tr>

                                            <?php
                                        } else if ($user['role'] == 'Admin' || $user['role'] == 'SuperAdmin') {
                                            if ($user['role'] == 'SuperAdmin') {
                                            ?>
                                                <tr>
                                                    <td><a href="add_admin.php">Add Admin</a>
                                                        <hr>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <td><a href="manage_user.php">Manage Users</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="manage_discussionPosts.php">Manage Discussion Post</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="verify.php">Professional List [ For Verify]</a>
                                                    <hr>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="manage_query.php">Manage Query</a>
                                                    <hr>
                                                </td>
                                            </tr>

                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td><a href="update_profile.php">Update Profile</a>
                                                <hr>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="change_password.php">Change Password</a>
                                                <hr>
                                            </td>
                                        </tr>
                                    </table>

                                </fieldset>
                            </td>

                            <td width="20"> </td>

                            <td>
                                <h3>Account Informaion</h3>
                                <table>
                                    <tr>
                                        <td><b>Name:</b></td>
                                        <td><?= $user['first_name'] . " " . $user['last_name'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email:</b></td>
                                        <td><?= $user['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone:</b></td>
                                        <td><?= $user['phone'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address:</b></td>
                                        <td><?= $user['address'] ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Country:</b></td>
                                        <td><?= $user['country'] ?></td>
                                    </tr>
                                </table>

                                <?php
                                if ($user['role'] == 'Professional' or $user['role'] == 'Aspirant') {

                                ?>
                                    <table>
                                        <tr>
                                            <td>
                                                <?php if ($user['role'] == 'Professional') echo '<h3>Professional Domains</h3>';
                                                else echo '<h3>My Domains</h3>';
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
                                        require_once('../model/user_domainsModel.php');
                                        $domains = getUserDomains($user['username']);
                                        if (sizeof($domains) == 0) {
                                        ?>
                                            <tr>
                                                <td><i><b>No domains yet</b></i></td>
                                            </tr>
                                            <?php
                                        } else {
                                            foreach ($domains as $domain) {

                                            ?>
                                                <form action="../controller/user_domain_manage.php" method="post">
                                                    <tr>
                                                        <td><?= $domain['name'] ?></td>
                                                        <td><input type="submit" name="remove_domain" value="Remove"></td>
                                                        <td><input type="hidden" name="domain_id" value="<?= $domain['domain_id'] ?>"></td>
                                                    </tr>
                                                </form>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td>
                                                <h3>Add New Domain </h3>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php
                                                require_once('../model/domainsModel.php');
                                                $domains = getAllDomains($user['username']);
                                                ?>
                                                <form action="../controller/user_domain_manage.php" method="post">
                                                    <select name="domain_id" id="" required>
                                                        <option value="">-- Select a domain --</option>
                                                        <?php
                                                        foreach ($domains as $domain) {
                                                        ?>
                                                            <option value="<?= $domain['domain_id'] ?>"><?= $domain['name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="submit" name="add_new_domain" value="Add">
                                                    <br>
                                                    <?php if ($user['role'] == 'Professional') {
                                                    ?>
                                                        <i>
                                                            <font color="red">it will suspend you account until admin verify</font>
                                                        </i>
                                                        <br>
                                                        <i>
                                                            <font color="red" size=2>(Please upload nessery document so that admin can approve)</font>
                                                        </i>
                                                    <?php
                                                    }
                                                    ?>
                                                </form>
                                                <?php

                                                ?>
                                            </td>
                                        </tr>

                                    </table>
                                <?php

                                }
                                ?>


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