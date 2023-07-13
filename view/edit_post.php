<?php
    if(!isset($_SESSION['logged_in'])){
        header('location: ../view/signin.php');
        exit();
    }

    if(isset($_POST['edit'])){
        $post_id = $_POST['post_id'];
    }

    header('location: ../view/signin.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Post</title>
</head>
<body>
  <fieldset>
    <legend>Edit Post</legend>
    <form action="../controller/edit_post_process.php" method="post">
    <input type="hidden" name="post_id" value="<?=$post_id?>">

      <table align="center">
        <tr>
          <td><label for="domain">Domain</label></td>
          <td><input type="text" id="domain" name="domain" required></td>
        </tr>
        <tr>
          <td><label for="title">Title</label></td>
          <td><input type="text" id="title" name="title" required></td>
        </tr>
        <tr>
          <td><label for="body">Body</label></td>
          <td><textarea id="body" name="body" rows="10" required></textarea></td>
        </tr>

        <tr align="center">
            <td colspan="2">
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
