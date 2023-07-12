<?php
    $msg = '';
    if(isset($_GET['err'])){
        $err_msg = $_GET['err'];
        switch($err_msg){
            case 'uploadFailed':{$msg = "Failed to upload your document."; break;}
        }
            
    }

    $success_msg = '';
    if(isset($_GET['success'])){
        $s_msg = $_GET['success'];
        switch($s_msg){
            case 'uploaded':{$success_msg = "Document uploaded successfully."; break;}
            
        }   
    }

    session_start();
    $user = $_SESSION['user'];


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Please Verfiy</title>
</head>
<body>
    <fieldset>
        <legend align="center"><h3>Please Upload Document and Wait For Varify</h3></legend>
        <table  align="center" cellpadding="5">
            <tr align="center">
                <td colspan="2"><img src="../vendor/profiles/<?=$user['profile_location']?>" alt="" width="200"></td>
            </tr>

            <?php if(strlen($msg) > 0){ ?>
                <tr align="center">
                    <td colspan="2"><font color="red"><?=$msg?></font></td>
                </tr>
            <?php } ?>

            <?php if(strlen($success_msg) > 0){ ?>
                <tr align="center">
                    <td colspan="2"><font color="green"><?=$success_msg?></font></td>
                </tr>
            <?php } ?>

            <form action="../controller/submit_professional_file.php" method="post" enctype="multipart/form-data">
                <tr>
                    <td>Add New Document (image) &nbsp;</td>
                    <td><input type="file" name="document" accept="image/*" required></td>
                </tr>

                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Submit Document" name="submit_document">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <a href="view_professional_documents.php?prof=<?=$user['username']?>"> View Uploaded Documents</a>
                    </td>
                </tr>
                
            </form>
            <tr>
                
                <td align="center" colspan="2"><a href="update_profile.php">Update Profile</a></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><a href="change_password.php">Change Password</a></td>
            </tr>

        </table>
    </fieldset>

    <?php include_once('bottom_nav.php'); ?>
</body>
</html>