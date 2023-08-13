<?php

session_start();
require_once('../model/queryModel.php');


if (!isset($_SESSION['logged_in'])) {
    header('location: signin.php');
    exit();
}

$user = $_SESSION['user'];

if ($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin') {
    header('location: profile.php?username=' . $user['username']);
    exit();
}

if (!isset($_GET['qid'])) {
    header('location: manage_query.php');
    exit();
}

$query = getQuery($_GET['qid']);

if ($query == null) {
    header('location: manage_query.php');
}

$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'empty': {
                $msg = "Cannot send a empty reply.";
                break;
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>View - Reply query</title>
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
    

    b {
        font-weight: bold;
    }

    textarea {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 2px;
        resize: vertical;
    }

    input[type="submit"], input[type="button"] {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        background-color: #007bff;
        color: white;
        margin-right: 10px;
    }

    input[type="submit"]:hover, input[type="button"]:hover {
        background-color: #0056b3;
    }

    font[color="red"] {
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
                    <legend align="center">
                        <h3>View/Reply Query</h3>
                    </legend>
                    <table>
                        <tr>
                            <td><b>Email: </b></td>
                            <td><?= $query['sender_email'] ?></td>
                        </tr>
                        <tr>
                            <td><b>Query: </b></td>
                            <td><?= $query['query'] ?></td>
                        </tr>
                        <tr>
                            <td><br></td>
                        </tr>
                        <?php if (strlen($msg) > 0) { ?>
                            <tr align="center">
                                <td colspan="2">
                                    <font color="red"><?= $msg ?></font>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td><b>Reply</b></td>
                            <td>
                                <form action="../controller/manage_query_process.php" method="post">
                                    <textarea name="reply_msg" id="" cols="30" rows="10" placeholder="Write a reply ..."></textarea>
                                    <br>
                                    <a href="manage_query.php"><input type="button" value="Back"></a>
                                    <input type="submit" name="reply" value="Send">
                                    <input type="hidden" name="query_id" value="<?= $query['query_id'] ?>">
                                </form>
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