<?php
    session_start();


    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }

    $user = $_SESSION['user'];

    if($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin'){
        header('location: profile.php?username='.$user['username']);
        exit();
    }






?>


<!DOCTYPE html>
<html>
<head>
  <title>User Account Management</title>

</head>
<body>
  <fieldset>
    <legend align="center"><h3>User Account Management</h3></legend>
    <table cellspacing="0" cellpadding="10" align="center">
        <tr>
          <th>Username  <br><hr> </th>
          <th>Email  <br><hr> </th>
          <th>Role  <br><hr> </th>
          <th>Action  <br><hr> </th>
        </tr>
        <tr>
          <td>johnDoe</td>
          <td>johndoe@example.com</td>
          <td>Admin</td>
          <td>
            <button>Edit</button>
            <button>Delete</button>
          </td>
        </tr>
    </table>
  </fieldset>
</body>
</html>
