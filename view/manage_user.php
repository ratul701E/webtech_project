<?php
    session_start();
    require_once('../model/userModel.php');


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

        header('location: manage_user.php');
        exit();

    }

    $view = '';
    if(isset($_GET['view'])){
        $view = $_GET['view'];
    }

    if(isset($_POST['search'])){

        $users = getAllUsers($_POST['search_value'], $view);

    }
    else $users = getAllUsers(like:$view);



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
            <td colspan="5" align="center">
                <form action="" method="post">
                    <input type="text" name="search_value" placeholder="Enter username or email" <?php if(isset($_POST['search'])) echo"value='".$_POST['search_value']."'" ?> size=30> &nbsp;
                    <input type="submit" name="search" value="Search">
                    <input type="submit" name="clear" value="Clear">
                    
                        <p align="center">
                            <b>Filter</b> &nbsp;
                            <select name="filter" id="" onchange="location = this.value">
                            <option value="manage_user.php" <?php if(!isset($_GET['view'])) echo 'selected' ?>>All</option>
                            <option value="manage_user.php?view=Aspirant" <?php if(isset($_GET['view']) and $_GET['view'] == 'Aspirant') echo 'selected' ?>>Aspirant</option>
                            <option value="manage_user.php?view=Professional" <?php if(isset($_GET['view']) and $_GET['view'] == 'Professional') echo 'selected' ?>>Professional</option>
                            <?php
                                if($user['role'] == 'SuperAdmin'){
                                    ?>
                                        <option value="manage_user.php?view=Admin" <?php if(isset($_GET['view']) and $_GET['view'] == 'Admin') echo 'selected' ?>>Admin</option>
                                    <?php
                                }
                            ?>
                            </select>
                        </p>
                </form>
            </td>
        </tr>
        <tr>
            <th>Username  <br><hr> </th>
            <th>Email  <br><hr> </th>
            <th>Role  <br><hr> </th>
            <th>Action  <br><hr> </th>
            <th>Status  <br><hr> </th>
        </tr>
        <?php

            if(sizeof($users) == 0){
                ?>
                    <tr>
                        <td colspan="5" align="center"><b><i>No user found</i></b></td>
                    </tr>
                <?php
            }
            else{
                foreach($users as $temp_user){
                    if($temp_user['role'] == 'Admin' and $user['role'] != 'SuperAdmin') continue;
                    if($temp_user['role'] == 'SuperAdmin') continue;
                    ?> 
                        <tr>
                            <td>
                                <img src="../vendor/profiles/<?=$temp_user['profile_location']?>" alt="" width="30">
                                <br>
                                <?=$temp_user['username']?> &nbsp;
                            </td>
                            <td><?=$temp_user['email']?></td>
                            <td><?=$temp_user['role']?></td>
                            <td>
                                <form action="../controller/manage_user_process.php" method="post">
                                <input type="hidden" name="username" value="<?=$temp_user['username']?>">
                                <input type="hidden" name="view" value="<?=$view?>">
                                   <!-- <input ty pe="submit" name="update" value="Update"> -->
                                   <?php if($temp_user['isExist'] == 'false'){
                                            ?>
                                               <input type="submit" name="restore" value="Restore"> 
                                            <?php
                                        }
                                        else {
                                            ?>
                                               <input type="submit" name="remove" value="Remove">
                                            <?php
                                            if($temp_user['status'] == 'banned'){
                                                ?>
                                                   <input type="submit" name="unban" value="Unban"> 
                                                <?php
                                            }
                                            else{
                                                ?>
                                                   <input type="submit" name="ban" value="Ban">
                                                <?php
                                            }  
                                        }
                                    ?>
                                    
                                </form>
                            </td>
                            <td>
                                <?php
                                    if($temp_user['isExist'] == 'false') echo '<font color = "red">Removed Users</font>';
                                    else if($temp_user['status'] == 'invalid') echo '<font color = "orange">Invalid</font>';
                                    else if($temp_user['status'] == 'valid') echo '<font color = "green">Valid</font>';
                                    else if($temp_user['status'] == 'banned') echo '<font color = "#ff8080">Banned</font>';
                                    else if($temp_user['status'] == 'unvarified') echo '<font color = "#ae7ef1">Unvarified</font>';
                                ?>
                            </td>
                            
                        </tr>
                    <?php
                }
            }

        ?>
    </table>
  </fieldset>
</body>
</html>
