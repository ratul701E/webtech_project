<?php
    session_start();
    require_once('../model/domainsModel.php');
    require_once('../model/userModel.php');
    require_once('../model/discussion_postsModel.php');
    require_once('../model/discussion_commentsModel.php');

    $post_com_previllage = '';
    if(!isset($_SESSION['logged_in'])) $post_com_previllage = 'disabled';

    else $user = $_SESSION['user'];

    $msg = '';
    if(isset($_GET['err'])){
        $err_msg = $_GET['err'];
        switch($err_msg){
            case 'failed':{$msg = "Failed to post."; break;}
        }
            
    }

    $success_msg = '';
    if(isset($_GET['success'])){
        $s_msg = $_GET['success'];
        switch($s_msg){
            case 'posted':{$success_msg = "Posted."; break;}            
        }   
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Professional Sage | Discussion</title>
</head>
<body>
    <font face="courier"><h1 align="center">Discussion</h1></font>
    <fieldset>
        <legend><font size="6">Create Post</font></legend>

        <form action="../controller/discussion_process.php" method="post">
            Title: <input type="text" name="title" id="" required> <br> <br>
            Body: <br> 
            <textarea name="body" rows="7" cols="70" placeholder="Write your post here..." required></textarea>
            
            <?php
                $domains = getAllDomains();
            ?>
            <br>
            <select name="domain_id" id="" required>
            <option value="">-- Select a domain --</option>
                <?php
                    foreach($domains as $domain){
                        ?>
                            <option value="<?=$domain['domain_id']?>"><?=$domain['name']?></option>
                        <?php
                    }
                ?>
            </select>

            <br>
            <br>

            <input type="submit" name="post" value="Post">
            <br>
            <?php if(strlen($msg) > 0){ ?>
                <h3 align="center"><font color="red"><?=$msg?></font></h3>
            <?php } ?>

            <?php if(strlen($success_msg) > 0){ ?>
                <h3 align="center"><font color="green"><?=$success_msg?></font></h3>
            <?php } ?>

        </form>
    </fieldset>

    <br>

    

    <?php
        // fetching posts
        $posts = getAllPosts();

        foreach($posts as $post){
            ?>
                <fieldset>

                    <legend><font size="6">Posted by <a href="profile.php?username=<?=$post['author']?>">@<?=$post['author']?></a> &#x2022; <?=date_format(new DateTime($post['date']), "D H:i A")?> </font></legend>
                    

                    <form action="edit_post.php" method="post">
                        <p align="right"><input type="submit" name="edit" value="Edit" ></p>
                        <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                    </form>

                    <p><b>Domain:</b> <?=getDomainName($post['domain'])?> </p>
                    <p><b>title</b> <?=$post['title']?> </p>
                    <p>
                        <?=$post['body']?>
                    </p>
                    <hr>

                    <form action="../controller/discussion_process.php" method="post">
                        Write a comment <br> <textarea name="msg" id="" cols="30" rows="3" required></textarea>
                        <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                        &nbsp; <input type="submit" name="comment" value="Comment" id="" <?=$post_com_previllage?>>
                    </form>

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
                                        <td><b><a href="profile.php?username=<?=$comment['username']?>">@<?=$comment['username']?> </a></b></td>
                                        <td> &nbsp;<?=$comment['comment']?></td>
                                        <td> • <i><?=date_format(new DateTime($comment['date']), "D H:i a")?></i></td>
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


</body>
</html>