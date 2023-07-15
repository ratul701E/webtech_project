<?php
    session_start();
    require_once('../model/discussion_postsModel.php');
    require_once('../model/domainsModel.php');

    if(!isset($_SESSION['logged_in'])){
        header('location: ../view/signin.php?');
        exit();
    }

    else if(isset($_POST['edit'])){
        $post_id = $_POST['post_id'];
        $post_data = getPost($post_id);
        $domain_name = getDomainName($post_data['domain']);
    }

    else header('location: ../view/signin.php?');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Post</title>
</head>
<body>
  <?php require_once('topnavigationbar.php'); ?>
  <fieldset>
    <legend align="center"><h2>Edit Post</h2></legend>
    <form action="../controller/edit_post_process.php" method="post">
    <input type="hidden" name="post_id" value="<?=$post_id?>">

      <table align="center">
        <tr>
          <td>Domain</td>
          <td>
            <?php
                    $domains = getAllDomains();
                ?>
                <br>
                <br>
                <select name="domain_id" id="" required>
                <option value="">-- Select a domain --</option>
                    <?php
                        foreach($domains as $domain){
                            ?>
                                <option value="<?=$domain['domain_id']?>" <?php if($domain['name'] === $domain_name) echo 'selected'?>> <?=$domain['name']?></option>
                            <?php
                        }
                    ?>
                </select>
          </td>
        </tr>
        <tr>
          <td><label for="title">Title</label></td>
          <td><input type="text" id="title" name="title" value="<?=$post_data['title']?>" required size=50></td>
        </tr>
        <tr>
          <td><label for="body">Body</label></td>
          <td><textarea id="body" name="body" rows="10" cols="50" required><?=$post_data['body']?></textarea>  </td>
        </tr>

        <tr align="center">
            <td colspan="2">
                <hr>
                <a href="discussion.php"><input type="button" name="back" value="Cancel"></a> &nbsp;
                <input type="submit" name="remove" value="Remove Post"> &nbsp;
                <input type="submit" name="save_changes" value="Save Changes">
            </td>
        </tr>
      </table>
    </form>
  </fieldset>
</body>
</html>
