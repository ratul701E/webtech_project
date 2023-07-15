<?php
    session_start();
    require_once('../model/discussion_postsModel.php');


    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }

    $user = $_SESSION['user'];

    if($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin'){
        header('location: profile.php?username='.$user['username']);
        exit();
    }

    if(isset($_POST['clear'])){

        header('location: manage_discussionPosts.php');
        exit();

    }

    if(isset($_POST['search'])){

        $posts = getAllPosts($_POST['search_value']);

    }
    else $posts = getAllPosts();



?>

<!DOCTYPE html>
<html>
<head>
  <title>Discussion Post Management</title>

</head>
<body>
    <?php require_once('top_navbar.php'); ?>

  <table align="center">
    <tr>
        <td>
            <fieldset>
                <legend align="center" ><h3>Discussion Post Management</h3></legend>
                <form action="../controller/manage_discussionPost_process.php" method="post">
                    <table align="center"  cellspacing="0" cellpadding="10">
                        <tr>
                            <td colspan="4" align="center">
                                <form action="" method="post">
                                    <input type="text" name="search_value" placeholder="Enter post id or author or date posted" <?php if(isset($_POST['search'])) echo"value='".$_POST['search_value']."'" ?> size=30> &nbsp;
                                    <input type="submit" name="search" value="Search">
                                    <input type="submit" name="clear" value="Clear">
                                </form>
                            </td>
                        </tr>

                        <tr align="center">
                        <th>Post ID <br> <hr> </th>
                        <th>Auhor <br> <hr> </th>
                        <th>Posted Date <br> <hr> </th>
                        <th>Action <br> <hr> </th>
                        </tr>
                        <?php
                            if(sizeof($posts) == 0){
                                ?>
                                    <tr>
                                        <td colspan="4" align="center"><b><i>No Post found</i></b></td>
                                    </tr>
                                <?php
                            }

                            else{
                                foreach ($posts as $post) {
                                    ?>
                                        <tr>
                                            <td><?=$post['post_id']?></td>
                                            <td><a href="profile_view.php?username=<?=$post['author']?>">@<?=$post['author']?></a></td>
                                            <td><?=date_format(new DateTime($post['date']), "Y-m-d")?></td>
                                            <td>
                                                
                                                <a href="view_single_post.php?post_id=<?=$post['post_id']?>"><input type="button" value="View"></a>
                                                
                                                <input type="submit" name="remove_post" value="Remove">

                                                <input type="hidden" name="post_id" value="<?=$post['post_id']?>">
                                                
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
</body>
</html>
