<?php
  session_start();
  if(!isset($_SESSION['logged_in'])) {
    header('location: ../view/signin.php');
  }

  $user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Professional Sage | Update Info</title>
</head>
<body>
  <?php require_once('topnavigationbar.php'); ?>

    <table align="center">
      <tr>
        <td>
          <fieldset>
            <legend align="center"><h3>Update Profile @<?=$user['username']?></h3></legend>
            <form action="../controller/update_profile_process.php" method="post" enctype="multipart/form-data">
              <table align="center">
                <tr align="center">
                  <td colspan="2"><img src="../vendor/profiles/<?=$user['profile_location']?>" alt="../vendor/profiles/deafult.jpg" width="200"></td>
                </tr>
                <tr align="center">
                  <td colspan="2"><h4><?=$user['first_name'].' '.$user['last_name']?></h4></td>
                </tr>
                <tr>
                  <td><label for="firstname">First Name</label></td>
                  <td><input type="text" id="firstname" name="first_name" value="<?=$user['first_name']?>" required></td>
                </tr>
                <tr>
                  <td><label for="lastname">Last Name</label></td>
                  <td><input type="text" id="lastname" name="last_name" value="<?=$user['last_name']?>" required></td>
                </tr>
                <tr>
                  <td><label for="email">Email</label></td>
                  <td><input type="email" id="email" name="email" value="<?=$user['email']?>" required></td>
                </tr>
                <tr>
                  <td><label for="mobile">Mobile</label></td>
                  <td><input type="tel" id="mobile" name="phone" value="<?=$user['phone']?>" required></td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td><textarea name="address" id="" cols="30" rows="3" required><?=$user['address']?></textarea></td>
                </tr>
                <tr>
                  <td>Country/Region:</td>
                  <td>
                      <select name="country" id="">
                          <option value="Bangladesh" <?php if($user['country'] == 'Bangladesh') echo 'selected' ?>>Bangladesh</option>
                          <option value="India" <?php if($user['country'] == 'India') echo 'selected' ?>>India</option> 
                          <option value="Afghanistan" <?php if($user['country'] == 'Afghanistan') echo 'selected' ?>>Afghanistan</option>
                          <option value="Belarus" <?php if($user['country'] == 'Belarus') echo 'selected' ?>>Belarus</option>
                          <option value="China" <?php if($user['country'] == 'China') echo 'selected' ?>>China</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><label>Gender</label></td>
                  <td>
                    <input type="radio" id="male" name="gender" value="male" <?php if($user['gender'] == 'male') echo 'checked' ?> required>
                    <label for="male">Male</label>
                    <input type="radio" id="female" name="gender" value="female" <?php if($user['gender'] == 'female') echo 'checked' ?> required>
                    <label for="female">Female</label>
                    <input type="radio" id="other" name="gender" value="other"<?php if($user['gender'] == 'other') echo 'checked' ?> required>
                    <label for="other">Other</label>
                  </td>
                </tr>
                <tr>
                  <td>Update profile Photo</td>
                  <td><input type="file" name="profile" accept="image/*"></td>
                </tr>
                <tr>
                  <td align="right" colspan="2">
                    <a href="profile.php?username=<?=$user['username']?>"><input type="button"  value="Back"></a>
                    <input type="submit" name="update" value="Update">
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
