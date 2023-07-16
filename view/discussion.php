<?php
session_start();
require_once('../model/domainsModel.php');
require_once('../model/userModel.php');
require_once('../model/discussion_postsModel.php');
require_once('../model/discussion_commentsModel.php');

if (isset($_SESSION['logged_in'])) $user = $_SESSION['user'];


$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'failed': {
                $msg = "Failed to post.";
                break;
            }
        case 'postFieldEmpty': {
                $msg = "All fields must be filled when post.";
                break;
            }
        case 'commentFieldEmpty': {
                $msg = "Cannot comment empty.";
                break;
            }
        case 'editFailed': {
                $msg = "Look like youre trying to edit with empty value. Process terminated.";
                break;
            }
    }
}

$success_msg = '';
if (isset($_GET['success'])) {
    $s_msg = $_GET['success'];
    switch ($s_msg) {
        case 'posted': {
                $success_msg = "Posted.";
                break;
            }
        case 'updated': {
                $success_msg = "Your post was updated Successfully.";
                break;
            }
        case 'commentDeleted': {
                $success_msg = "Your comment was deleted Successfully.";
                break;
            }
        case 'deleted': {
                $success_msg = "Your post was deleted Successfully.";
                break;
            }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Professional Sage | Discussion</title>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <font face="courier">
        <h1 align="center">Discussion</h1>
    </font>

    <table align="center">
        <tr>
            <td>
                <center>
                <?php if (strlen($msg) > 0) { ?>
                    <h4 align="center">
                        <font color="red"><?= $msg ?></font>
                    </h4>
                <?php } ?>

                <?php if (strlen($success_msg) > 0) { ?>
                    <h4 align="center">
                        <font color="green"><?= $success_msg ?></font>
                    </h4>
                <?php } ?>
                </center>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                if (isset($_SESSION['logged_in']) and $user['role'] != 'Admin' and $user['role'] != 'SuperAdmin' and $user['status'] != 'unverified') {
                ?>
                    <fieldset>
                        <legend align="center">
                            <font size="6">Create Post</font>
                        </legend>

                        <form action="../controller/discussion_process.php" method="post">
                            Title: <input type="text" name="title" id=""> <br> <br>
                            Body: <br>
                            <textarea name="body" rows="7" cols="70" placeholder="Write your post here..."></textarea>

                            <?php
                            $domains = getAllDomains();
                            ?>
                            <br>
                            <br>
                            <select name="domain_id" id="">
                                <option value="">-- Select a domain --</option>
                                <?php
                                foreach ($domains as $domain) {
                                ?>
                                    <option value="<?= $domain['domain_id'] ?>"><?= $domain['name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>

                            <br>
                            <br>

                            <input type="submit" name="post" value="Post">
                            <br>

                        </form>
                    </fieldset>
                    <?php
                    if (isset($_SESSION['logged_in'])) {
                    ?>
                        <p align="center">
                            <b>Filter</b> &nbsp;
                            <select name="filter" id="" onchange="location = this.value">
                                <option value="discussion.php" <?php if (!isset($_GET['view'])) echo 'selected' ?>>All Posts</option>
                                <option value="discussion.php?view=my_posts" <?php if (isset($_GET['view']) and $_GET['view'] == 'my_posts') echo 'selected' ?>>My Posts</option>
                                <option value="discussion.php?view=commented_posts" <?php if (isset($_GET['view']) and $_GET['view'] == 'commented_posts') echo 'selected' ?>>Commented Posts</option>
                            </select>
                        </p>
                <?php
                    }
                }
                ?>

                <br>

                <?php
                // fetching posts
                if (isset($_SESSION['logged_in']) and isset($_GET['view'])) {
                    if ($_GET['view'] == 'my_posts') {
                        $posts = getUserAllPosts($user['username']);
                    }
                    if ($_GET['view'] == 'commented_posts') {
                        $posts = getCommentedAllPosts($user['username']);
                    }
                } else $posts = getAllPosts();
                
                foreach ($posts as $post) {
                    $author_data = getUser($post['author']);
                ?>
                    <fieldset>

                        <legend align="center">
                            <font size="5">Posted by <a href="profile_view.php?username=<?= $post['author'] ?>"> 
                                <?php 
                                    if (isset($_SESSION['logged_in']) and $post['author'] == $user['username']) echo 'you';
                                    else echo '@' . $post['author']; ?> </a> &#x2022; <?= date_format(new DateTime($post['date']), "D h:i A") 
                                ?> 
                            </font>
                        </legend>

                        <img src="../vendor/profiles/<?= $author_data['profile_location'] ?>" alt="" width="40"> <br>
                        <b><?=  $author_data['first_name'].' '.$author_data['last_name'] ?></b>

                        <?php
                        if (isset($_SESSION['logged_in']) and $user['username'] == $post['author']) {
                        ?>
                            <form action="edit_post.php" method="post">
                                <br>
                                <input type="submit" name="edit" value="Edit Post">
                                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                            </form>
                        <?php
                        }
                        ?>
                        
                        <p><i><b>Last Modified:</b> <?= date_format(new DateTime($post['last_edited']), "D h:i A") ?></i></p>
                        <hr>
                        <p><b>Domain:</b> <?= getDomainName($post['domain']) ?> </p>
                        <p><b>Title: <?= $post['title'] ?></b></p>
                        <p>
                            <?= $post['body'] ?>
                        </p>
                        <hr>

                        <?php
                        if (isset($_SESSION['logged_in']) and $user['role'] != 'Admin' and $user['role'] != 'SuperAdmin' and $user['status'] != 'unverified') {
                        ?>
                            <form action="../controller/discussion_process.php" method="post">
                                Write a comment <br> <textarea name="msg" id="" cols="30" rows="3"></textarea>
                                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                                &nbsp; <input type="submit" name="comment" value="Comment" id="">
                            </form>
                        <?php
                        }
                        ?>

                        <br>
                        <br>

                        <?php
                        $comments = getAllComment($post['post_id']);
                        $total =  sizeof($comments);
                        echo "<b>Total Comment(s): {$total}</b>";
                        foreach ($comments as $comment) {
                        ?>
                            <table>
                                <tr>
                                    <td>
                                        <b><a href="profile_view.php?username=<?= $comment['username'] ?>"> 
                                        <?php 
                                            if ( isset($_SESSION['logged_in']) and $comment['username'] == $user['username']) echo 'me';
                                            else echo '@' . $comment['username']; 
                                        ?> 
                                        </a></b>
                                    </td>
                                    <td> &nbsp;<?= $comment['comment'] ?></td>
                                    <td> • <i><?= date_format(new DateTime($comment['date']), "D h:i a") ?></i></td>
                                    <?php
                                        if($comment['username'] == $user['username']){
                                            ?>
                                                <td>
                                                    &nbsp;&nbsp; &nbsp;&nbsp;
                                                    <form action="../controller/discussion_process.php" method="post">
                                                        <input type="submit" name="delete_comment" value="Delete">
                                                        <input type="hidden" name="comment_id" value="<?=$comment['comment_id']?>">
                                                    </form>
                                                </td>
                                            <?php
                                        }
                                    ?>
                                </tr`>
                            </table>
                        <?php
                        }
                        ?>



                    </fieldset>

                    <br>

                <?php
                }
                ?>
            </td>
        </tr>
    </table>
    <?php include 'bottom_navbar.php' ?>

    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>