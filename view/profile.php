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
                                        <tr><td><a href="">Discussion</a><hr></td></tr>

                                    <?php
                                }
                                else if($user['role'] == 'Aspirant'){
                                    ?>
                                        <tr><td><a href="">Following</a><hr></td></tr>
                                        <tr><td><a href="">Communication</a><hr></td></tr>
                                        <tr><td><a href="">Discussion</a><hr></td></tr>

                                    <?php
                                }
                                else if($user['role'] == 'Admin' || $user['role'] == 'SuperAdmin'){
                                    if($user['role'] == 'SuperAdmin'){
                                        ?>
                                            <tr><td><a href="">Manage Admins</a><hr></td></tr>
                                        <?php
                                    }
                                    ?>
                                        <tr><td><a href="">Manage Users [ Aspirant, Professional ]</a><hr></td></tr>
                                        <tr><td><a href="">Manage Discussion Post</a><hr></td></tr>
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



                </td>
            </tr>
        </table>
    </fieldset>
    
    <?php include_once('bottom_nav.php'); ?>
</body>
</html>