<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('location: ../view/signin.php');
}
require_once('../model/discussion_postsModel.php');
require_once('../model/domainsModel.php');
require_once('../model/userModel.php');
require_once('../model/discussion_commentsModel.php');

if (!isset($_GET['post_id'])) {
    header('location: manage_discussionPosts.php');
    exit();
}

$post_id = $_GET['post_id'];
$post = getPost($post_id);
$user = $_SESSION['user'];
$author_data = getUser($post['author']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>

    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <legend align="center">
                        <font size="5">Posted by <a href="profile_view.php?username=<?= $post['author'] ?>"> <?= $post['author'] ?> </a> &#x2022; <?= date_format(new DateTime($post['date']), "D h:i A") ?> </font>
                    </legend>

                    <img src="../vendor/profiles/<?= $author_data['profile_location'] ?>" alt="" width="40"> <br>
                    <b><?=  $author_data['first_name'].' '.$author_data['last_name'] ?></b>

                    <p><i>Last Modified: <?= date_format(new DateTime($post['last_edited']), "D h:i A") ?></i></p>
                    <hr>
                    <p><b>Domain:</b> <?= getDomainName($post['domain']) ?> </p>
                    <p><b><?= $post['title'] ?></b></p>
                    <p>
                        <?= $post['body'] ?>
                    </p>
                    <hr>
                    <br>

                    <?php
                    $comments = getAllComment($post['post_id']);
                    $total =  sizeof($comments);
                    echo "<b>Total Comment(s): {$total}</b>";
                    foreach ($comments as $comment) {
                    ?>
                        <table>
                            <tr>
                                <td><b><a href="profile_view.php?username=<?= $comment['username'] ?>"> <?php if (isset($_SESSION['logged_in']) and $comment['username'] == $user['username']) echo 'me';
                                                                                                        else echo '@' . $comment['username']; ?> </a></b></td>
                                <td> &nbsp;<?= $comment['comment'] ?></td>
                                <td> • <i><?= date_format(new DateTime($comment['date']), "D H:i a") ?></i></td>
                                </tr`>
                        </table>
                    <?php
                    }
                    ?>
                </fieldset>
            </td>
        </tr>
    </table>
    <p align="center"><a href="manage_discussionPosts.php"><input type="button" value="Back"></a></p>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>