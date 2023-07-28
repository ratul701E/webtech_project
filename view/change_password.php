<?php
session_start();
if (!isset($_SESSION['logged_in'])) header('location: signin.php');

$user = $_SESSION['user'];

$msg = '';
if (isset($_GET['err'])) {
  $err_msg = $_GET['err'];
  switch ($err_msg) {
    case 'oldPasswordMismatch': {
        $msg = "Old password not matched.";
        break;
      }
    case 'newPasswordMismatch': {
        $msg = "New passwords not matched";
        break;
      }
    case 'shortPassword': {
        $msg = "Password length must be 8 or more long.";
        break;
      }
    case 'passwordMismatch': {
        $msg = "Password and confrim password does not match";
        break;
      }
    case 'empty': {
        $msg = "Filed(s) cannot be empty";
        break;
      }
  }
}


?>

<!DOCTYPE html>
<html>

<head>
  <title>Professional Sage | Change Password</title>
  <style>
    /* Reset some default styles for better consistency */
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #f9f9f9;
}

/* Top navigation bar styles */
.top-navbar {
  background-color: #333;
  color: #fff;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.top-navbar a {
  color: #fff;
  text-decoration: none;
  padding: 8px 16px;
}

.top-navbar a:hover {
  background-color: #555;
}

/* Centering elements */
.center {
  text-align: center;
}

/* Form container styles */
.form-container {
  max-width: 400px;
  margin: 50px auto;
  padding: 20px;
  background-color: #f1f1f1;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

/* Form header styles */
.form-header {
  text-align: center;
  font-size: 24px;
  color: #007bff;
  margin-bottom: 20px;
}

/* Form field styles */
.form-field {
  margin-bottom: 15px;
}

.form-label {
  display: block;
  font-size: 16px;
  color: #333;
  margin-bottom: 5px;
}

.form-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 14px;
}

/* Error message styles */
.error-msg {
  color: red;
  font-size: 14px;
  margin-top: 5px;
}

/* Button styles */
.form-buttons {
  text-align: right;
  margin-top: 20px;
}

.form-buttons button {
  background-color: #4CAF50;
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-left: 10px;
}

.form-buttons button:first-child {
  background-color: #ccc;
  color: #333;
}

/* Restyled navbar */
.navbar {
  background-color: #007bff;
  color: #fff;
  padding: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.navbar a {
  color: #fff;
  text-decoration: none;
  padding: 10px;
}

.navbar a:hover {
  background-color: #0056b3;
  border-radius: 5px;
}

.navbar img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.navbar span {
  font-size: 18px;
  margin-right: 10px;
}

.navbar button {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.navbar button:hover {
  background-color: #555;
}

  </style>
</head>

<body>
  <div class="navbar">
    <img src="../vendor/icons/main_logo.png" alt="" width="30">
    <div>
      <?php if (isset($_SESSION['logged_in'])) { ?>
        <a href="profile.php?username=user">Profile</a>
        <?php
      }
      if (isset($_SESSION['logged_in']) && ($user['role'] == 'Admin' || $user['role'] == 'SuperAdmin')) {
        ?>
        <a href="manage_user.php">Manage Users</a>
        <a href="manage_discussionPosts.php">Manage Posts</a>
        <a href="manage_query.php">Queries</a>
        <?php
      }
      ?>
      <a href="discussion.php">Discussion</a>
    </div>
    <div>
      <b>Today: </b> <?= date("l"); ?>
      <?php
      if (!isset($_SESSION['logged_in'])) {
        ?>
        <a href="signin.php"><button>Signin</button></a>
        <?php
      }
      if (isset($_SESSION['logged_in'])) {
        ?>
        <b>[<?= $user['role'] ?>]</b>
        <img src="../vendor/profiles/<?= $user['profile_location'] ?>" alt="" width="30">
        <span><?= $user['username'] ?></span>
        <a href="../controller/logout.php"><button>Sign Out</button></a>
      <?php
      }
      ?>
    </div>
  </div>

  <div class="form-container">
    <div class="form-header">
      <h3>Change Password @<?= $user['username'] ?></h3>
    </div>
    <form action="../controller/change_password_process.php" method="post">
      <?php if (strlen($msg) > 0) { ?>
        <p class="error-msg"><?= $msg ?></p>
      <?php } ?>
      <div class="form-field">
        <label class="form-label" for="oldPassword">Old Password</label>
        <input class="form-input" type="password" id="oldPassword" name="old_password">
      </div>
      <div class="form-field">
        <label class="form-label" for="newPassword">New Password</label>
        <input class="form-input" type="password" id="newPassword" name="new_password">
      </div>
      <div class="form-field">
        <label class="form-label" for="confirmNewPassword">Confirm New Password</label>
        <input class="form-input" type="password" id="confirmNewPassword" name="confirm_new_password">
      </div>
      <div class="form-buttons">
        <a href="profile.php?username=<?= $user['username'] ?>"><button type="button">Back</button></a>
        <button type="submit" name="change_password">Change Password</button>
      </div>
    </form>
  </div>
  <?php include_once('bottom_navbar.php'); ?>
</body>

</html>
