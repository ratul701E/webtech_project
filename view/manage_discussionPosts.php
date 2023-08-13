<?php
session_start();
require_once('../model/discussion_postsModel.php');


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

    header('location: manage_discussionPosts.php');
    exit();
}

if (isset($_POST['search'])) {

    $posts = getAllPosts($_POST['search_value']);
} else $posts = getAllPosts();



?>

<!DOCTYPE html>
<html>

<head>
    <title>Discussion Post Management</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }


    fieldset {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form table {
            width: 100%;
        }

        form td {
            padding: 10px;
        }
    

    th {
        background-color: #f2f2f2;
    }

    th hr {
        margin: 5px 0;
    }

    td a {
        text-decoration: none;
        color: #007bff;
    }

    input[type="text"], input[type="submit"], input[type="button"] {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="text"] {
        width: 100%;
        max-width: 300px;
    }

    input[type="submit"], input[type="button"] {
        background-color: #007bff;
        color: white;
        margin-right: 10px;
    }

    input[type="submit"]:hover, input[type="button"]:hover {
        background-color: #0056b3;
    }

    hr {
        margin: 10px 0;
        border: none;
        border-top: 1px solid #ccc;
    }
</style>


</head>

<body>
    <?php require_once('top_navbar.php'); ?>

    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <legend align="center">
                        <h3>Discussion Post Management</h3>
                    </legend>
                    <form action="../controller/manage_discussionPost_process.php" method="post">
                        <table align="center" cellspacing="0" cellpadding="10" id="post-table">
                            <tr>
                                <td colspan="4" align="center">
                                    <form action="" method="post">
                                        <input type="text" id="search" onkeyup="update_list()" name="search_value" placeholder="Enter post id or author or date posted" <?php if (isset($_POST['search'])) echo "value='" . $_POST['search_value'] . "'" ?> size=30> &nbsp;
                                        <input type="submit" name="search" value="Search">
                                        <input type="submit" name="clear" value="Clear">
                                    </form>
                                </td>
                            </tr>

                            <tr align="center">
                                <th>Post ID <br>
                                    <hr>
                                </th>
                                <th>Auhor <br>
                                    <hr>
                                </th>
                                <th>Posted Date <br>
                                    <hr>
                                </th>
                                <th>Action <br>
                                    <hr>
                                </th>
                            </tr>
                            <?php
                            if (sizeof($posts) == 0) {
                            ?>
                                <tr>
                                    <td colspan="4" align="center"><b><i>No Post found</i></b></td>
                                </tr>
                                <?php
                            } else {
                                foreach ($posts as $post) {
                                ?>
                                    <tr>
                                        <td><?= $post['post_id'] ?></td>
                                        <td><a href="profile_view.php?username=<?= $post['author'] ?>">@<?= $post['author'] ?></a></td>
                                        <td><?= date_format(new DateTime($post['date']), "Y-m-d") ?></td>
                                        <td>

                                            <a href="view_single_post.php?post_id=<?= $post['post_id'] ?>"><input type="button" value="View"></a>

                                            <input type="submit" name="remove_post" value="Remove">

                                            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">

                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                            <tr>
                                <td align="center" colspan="4">
                                    <hr>
                                    <input type="submit" name="remove_all" value="Remove all">
                                    <hr>
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