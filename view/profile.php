<?php
    session_start();

    if(!isset($_SESSION['logged_in']) ) {
        header('location: signin.php');
        exit();
    }
    
    $user = $_SESSION['user'];
    $username = $_GET['username'];


    if($username != $_SESSION['username']) {
        header('location: profile_view.php');
        exit();
    }

    if($user['status'] == 'invalid'){
        header('location: unvarified_professional.php');
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile | <?= $user['username']?></title>
</head>
<body>

    <fieldset>
        <legend align="center">
            <b>Profile • @<?= $user['username']?> • <?=$user['role'] ?></b>
        </legend>

        <table align="center">
            <tr>
                <td colspan="2">
                    <img src="../vendor/profiles/<?=$user['profile_location']?>" alt="" width="200"> <br> <br> <br>
                    <fieldset>
                        <table align="center">
                            <?php
                                if($user['role'] == 'Professional'){
                                    ?>
                                        <tr><td><a href="">Followers</a><hr></td></tr>
                                        <tr><td><a href="">Communication</a><hr></td></tr>
                                        <tr><td><a href="">My Paths</a><hr></td></tr>
                                        <tr><td><a href="discussion.php">Discussion</a><hr></td></tr>

                                    <?php
                                }
                                else if($user['role'] == 'Aspirant'){
                                    ?>
                                        <tr><td><a href="">Following</a><hr></td></tr>
                                        <tr><td><a href="">Communication</a><hr></td></tr>
                                        <tr><td><a href="discussion.php">Discussion</a><hr></td></tr>

                                    <?php
                                }
                                else if($user['role'] == 'Admin' || $user['role'] == 'SuperAdmin'){
                                    ?>
                                        <tr><td><a href="manage_user.php">Manage Users</a><hr></td></tr>
                                        <tr><td><a href="manage_discussionPosts.php">Manage Discussion Post</a><hr></td></tr>
                                        <tr><td><a href="verify.php">Professional List [ For Verify]</a><hr></td></tr>

                                    <?php
                                }
                            ?>
                            <tr><td><a href="update_profile.php">Update Profile</a><hr></td></tr>
                            <tr><td><a href="change_password.php">Change Password</a><hr></td></tr>
                        </table>
                            
                    </fieldset>
                </td>

                <td width="20"> </td>

                <td>
                    <h3>Account Informaion</h3>
                    <table>
                        <tr>
                            <td><b>Name:</b></td>
                            <td><?=$user['first_name']." ". $user['last_name']?></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><?=$user['email']?></td>
                        </tr>
                        <tr>
                            <td><b>Phone:</b></td>
                            <td><?=$user['phone']?></td>
                        </tr>
                        <tr>
                            <td><b>Address:</b></td>
                            <td><?=$user['address']?></td>
                        </tr>
                        <tr>
                            <td><b>Country:</b></td>
                            <td><?=$user['country']?></td>
                        </tr>
                    </table>

                    <?php
                        if($user['role'] == 'Professional' or $user['role'] == 'Aspirant'){

                            ?>
                                <table>
                                    <tr>
                                        <td>
                                            <?php if($user['role'] == 'Professional') echo '<h3>Professional Domains</h3>' ; 
                                                else echo '<h3>My Domains</h3>';
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <?php
                                        require_once('../model/user_domainsModel.php');
                                        $domains = getUserDomains($user['username']);
                                        if(sizeof($domains) == 0){
                                            ?>
                                                <tr>
                                                    <td><i><b>No domains yet</b></i></td>
                                                </tr>
                                            <?php
                                        }
                                        else{
                                            foreach($domains as $domain){

                                                ?>
                                                    <form action="../controller/user_domain_manage.php" method="post">
                                                        <tr>
                                                            <td><?=$domain['name']?></td>
                                                            <td><input type="submit" name="remove_domain" value="Remove"></td>
                                                            <td><input type="hidden" name="domain_id" value="<?=$domain['domain_id']?>"></td>
                                                        </tr>
                                                    </form>
                                                <?php
                                            }
                                        }
                                    ?>
                                    <tr>
                                        <td><h3>Add New Domain </h3></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php
                                                require_once('../model/domainsModel.php');
                                                $domains = getAllDomains($user['username']);
                                                ?>
                                                    <form action="../controller/user_domain_manage.php" method="post">
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
                                                        <input type="submit" name="add_new_domain" value="Add">
                                                        <br>
                                                        <?php if($user['role'] == 'Professional'){
                                                                ?>
                                                                    <i><font color="red">it will suspend you account until admin verify</font></i>
                                                                    <br>
                                                                    <i><font color="red" size=2>(Please upload nessery document so that admin can approve)</font></i>
                                                                <?php
                                                            }
                                                        ?>
                                                    </form>
                                                <?php

                                            ?>
                                        </td>
                                    </tr>
                                    
                                </table>
                            <?php

                        }
                    ?>


                </td>
            </tr>
        </table>
    </fieldset>
    
    <?php include_once('bottom_nav.php'); ?>
</body>
</html>