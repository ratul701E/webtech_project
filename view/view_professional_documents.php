
<?php
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header('location: signin.php');
        exit();
    }

    $user = $_SESSION['user'];
    $current_user_role = $user['role'];

    if($current_user_role == 'Aspirant'){
        header('location: signin.php');
        exit();
    }

    if(!isset($_GET['prof'])){
        header('location: verify.php');
        exit();
    }
;

    require_once('../model/userModel.php');
    require_once('../model/professionalDocumentsModel.php');


    $prof= getUser($_GET['prof']);
    $docs = getDocuments($prof['username']);

    $emtpy = sizeof($docs);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Professional Sage | <?=$prof['username']?> Documents</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <h2 align='center'>View Documents</h2>
    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <table align="center">
                        <tr align="center">
                            <td colspan="2"><img src="../vendor/profiles/<?=$prof['profile_location']?>" alt="" width="150"></td>
                        </tr>
                        <tr>
                            <td><b>Full Name:</b></td>
                            <td><?=$prof['first_name'].' '.$prof['last_name']?></td>
                        </tr>
                        <tr>
                            <td><b>Email:</b></td>
                            <td><?=$prof['email']?></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <br>
                                <hr>
                            </td>
                        </tr>
                        <ul>
                            <?php
                                if($emtpy == 0){
                                    ?>
                                        <tr>
                                            <td colspan="2" align="center">
                                                <h3>No document(s) found</h3>
                                            </td>
                                        </tr>
                                    <?php
                                }
                                else{
                                    ?>
                                        <tr> <td colspan="2" align="center"><h3>Documents</h3></td> </tr>
                                    <?php
                                    foreach($docs as $doc){
                                        ?>
                                            <tr>
                                                <td colspan="2" align="center">
                                                    <img src="../vendor/documents/<?=$doc?>" width="150" height="200">
                                                    <br>
                                                    <form action="../controller/verify_process.php" method="post">
                                                        <a href="../vendor/documents/<?=$doc?>" download> <input type="button" value="Download"> </a> &nbsp;
                                                        <input type="submit" value="Remove" name="remove_doc"> 
                                                        <input type="hidden" name="file" value="<?=$doc?>">
                                                        <input type="hidden" name="targeted_user" value="<?=$prof['username']?>">
                                                    </form>
                                                    <hr><br>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>

                        <?php
                            if($current_user_role == 'Admin' or $current_user_role == 'SuperAdmin'){
                                ?>
                                    <tr>
                                        <form action="../controller/verify_process.php" method="post">
                                        <input type="hidden" name="targeted_user" value="<?=$prof['username']?>">
                                            <td colspan="2" align="center">
                                                <input type="submit" value="Verify User" Name="verify">
                                                &nbsp;
                                                <input type="submit" value="Delete User" Name="remove">
                                            </td>
                                        </form>
                                    </tr>
                                <?php
                            }

                        ?>
                    

                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
    
</body>
</html>