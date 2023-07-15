<?php
    session_start();

    if(!isset($_SESSION['logged_in'])) {header('location: ../view/signin.php');}
    require_once('../model/discussion_postsModel.php');
    require_once('../model/domainsModel.php');
    require_once('../model/discussion_commentsModel.php');

    if(!isset($_GET['post_id'])){
        header('location: manage_discussionPosts.php');
        exit();
    }

    $post_id = $_GET['post_id'];
    $post = getPost($post_id);
    $user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <legend align="center"><font size="5">Posted by <a href="profile.php?username="<?=$post['author']?>> <?=$post['author']?> </a> &#x2022; <?=date_format(new DateTime($post['date']), "D H:i A")?> </font></legend>
                    <p><i>Last Modified: <?=date_format(new DateTime($post['last_edited']), "D H:i A")?></i></p>
                    <p><b>Domain:</b> <?=getDomainName($post['domain'])?> </p>
                    <p><b><?=$post['title']?></b></p>
                    <p>
                        <?=$post['body']?>
                    </p>
                    <hr>
                    <br>
                    <br>

                    <?php
                        $comments = getAllComment($post['post_id']);
                        $total =  sizeof($comments);
                        echo "<b>Total Comment(s): {$total}</b>";
                        foreach($comments as $comment){
                            ?>
                                <table>
                                    <tr>
                                        <td><b><a href="profile.php?username=<?=$comment['username']?>"> <?php if(isset($_SESSION['logged_in']) and $comment['username'] == $user['username']) echo 'me'; else echo '@'.$comment['username']; ?> </a></b></td>
                                        <td> &nbsp;<?=$comment['comment']?></td>
                                        <td> • <i><?=date_format(new DateTime($comment['date']), "D H:i a")?></i></td>
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
    
</body>
</html>