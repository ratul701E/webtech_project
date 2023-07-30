<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
  header('location: ../view/signin.php');
}

require_once('../model/userModel.php');

$msg = '';
if (isset($_GET['err'])) {
  $err_msg = $_GET['err'];
  switch ($err_msg) {
    case 'invalidFirstName': {
        $msg = "First name is invalid. Note: Alphabet & space only and at least 3 character long";
        break;
      }

    case 'invalidLastName': {
        $msg = "Last name is invalid. Note: Alphabet space only and at least 3 character long";
        break;
      }

    case 'invalidEmail': {
        $msg = "Invalid email. Please provide a proper email address";
        break;
      }

    case 'invalidAddress': {
        $msg = "Are your address is ok?. Please provide a details address.";
        break;
      }

    case 'invalidGender': {
        $msg = "A gender must be selected.";
        break;
      }

    case 'invalidCountry': {
        $msg = "A country must be selected.";
        break;
      }

    case 'invalidPhone': {
        $msg = "Your phone is invalid. Note: DO NOT INCLUDE COUNTRY CODE";
        break;
      }
    case 'invalidFileFormat': {
        $msg = "Invalid File format in profile. Only image are allowed.";
        break;
      }
  }
}

$user = $_SESSION['user'];

if (isset($_GET['username']) and ($user['role'] == 'Admin' or $User['role' == 'SuperAdmin'])) {
  $current_user = getUser($_GET['username']);
} 
else $current_user = $_SESSION['user'];

?>

<!DOCTYPE html>
<html>

<head>
  <title>Professional Sage | Update Info</title>
  <style>
   table {
      margin: 0 auto;
    }

    /* Style for fieldset  */
    fieldset {
        background-color: #fff;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }


    /* Style for table rows and cells */
    tr {
      vertical-align: top;
    }

    td {
      padding: 5px;
    }

    /* Style for the profile image */
    img {
      border: 1px solid #ccc;
      border-radius: 50%;
    }


    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea,
    select {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    /* Style for the radio buttons */
    input[type="radio"] {
      margin-right: 5px;
    }

    /* Style for the buttons */
    input[type="submit"],
    input[type="button"] {
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      margin-right: 10px;
    }

    /* Style for the submit button on hover */
    input[type="submit"]:hover,
    input[type="button"]:hover {
      background-color: #0056b3;
    }

    a {
        color: #1E90FF;
      
    }

    a:hover {
        text-decoration: underline;
        color:red;
    }


    /* Style for error messages */
    .error-msg {
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
            <h3  align="center">Update Profile @<?= $current_user['username'] ?></h3>
          <form action="../controller/update_profile_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="username" value=<?=$current_user['username']?>>
            <!-- for admin update user -->
            <?php 
              if(isset($_GET['username'])){
                ?>
                  <input type="hidden" name="admin_updating">
                <?php
              } 
            ?>
            <table align="center">
              <tr align="center">
                <td colspan="2"><img src="../vendor/profiles/<?= $current_user['profile_location'] ?>" alt="../vendor/profiles/deafult.jpg" width="250" height="250"></td>
              </tr>
              <tr align="center">
                <td colspan="2">
                  <h4><?= $current_user['first_name'] . ' ' . $current_user['last_name'] ?></h4>
                </td>
              </tr>
              <?php if (strlen($msg) > 0) { ?>
                <tr align="center">
                  <td colspan="2">
                    <font color="red"> <?= $msg ?></font>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td><label for="firstname">First Name</label></td>
                <td><input type="text" id="firstname" name="first_name" value="<?= $current_user['first_name'] ?>" required></td>
              </tr>
              <tr>
                <td><label for="lastname">Last Name</label></td>
                <td><input type="text" id="lastname" name="last_name" value="<?= $current_user['last_name'] ?>" required></td>
              </tr>
              <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" id="email" name="email" value="<?= $current_user['email'] ?>" required></td>
              </tr>
              <tr>
                <td><label for="mobile">Mobile</label></td>
                <td><input type="tel" id="mobile" name="phone" value="<?= $current_user['phone'] ?>" required></td>
              </tr>
              <tr>
                <td>Address</td>
                <td><textarea name="address" id="" cols="30" rows="3" required><?= $current_user['address'] ?></textarea></td>
              </tr>
              <tr>
                <td>Country/Region:</td>
                <td>
                  <select name="country" id="">
                    <option value="Bangladesh" <?php if ($current_user['country'] == 'Bangladesh') echo 'selected' ?>>Bangladesh</option>
                    <option value="India" <?php if ($current_user['country'] == 'India') echo 'selected' ?>>India</option>
                    <option value="UK" <?php if ($current_user['country'] == 'UK') echo 'selected' ?>>United Kingdom</option>
                    <option value="USA" <?php if ($current_user['country'] == 'USA') echo 'selected' ?>>United States of America</option>
                    <option value="China" <?php if ($current_user['country'] == 'China') echo 'selected' ?>>China</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label>Gender</label></td>
                <td>
                  <input type="radio" id="male" name="gender" value="male" <?php if ($current_user['gender'] == 'male') echo 'checked' ?> required>
                  <label for="male">Male</label>
                  <input type="radio" id="female" name="gender" value="female" <?php if ($current_user['gender'] == 'female') echo 'checked' ?> required>
                  <label for="female">Female</label>
                  <input type="radio" id="other" name="gender" value="other" <?php if ($current_user['gender'] == 'other') echo 'checked' ?> required>
                  <label for="other">Other</label>
                </td>
              </tr>
              <tr>
                <td>Update profile Photo</td>
                <td><input type="file" name="profile"></td>
              </tr>
              <tr>
                <td align="right" colspan="2">
                  <a href="profile.php?username=<?= $current_user['username'] ?>"><input type="button" value="Back"></a>
                  <input type="submit" name="update" value="Update">
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