<?php
    session_start();
    if(!isset($_SESSION['logged_in'])){
        header('location: signin.php');
        exit();
    }

    $user = $_SESSION['user'];

    if($user['role'] != 'Admin' and $user['role'] != 'SuperAdmin' ){
        header('location: signin.php');
        exit();
    }

    require_once('../model/userModel.php');
    $invalid_professionals = getInvalidProfessionals();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Verify Professionals</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <table align="center">
        <tr>
            <td>
                <fieldset>
                    <legend align="center"><h3>Verify Professionals</h3></legend>

                    <table align="center"  cellspacing="0" cellpadding="15">
                        <tr>
                        <th>Professional Name <br><hr></th>
                        <th>Action <br><hr></th>
                        <th>View Documents <br><hr></th>
                        </tr>
                        <?php
                            if(count($invalid_professionals) == 0){
                                ?>
                                    <tr>
                                        <td colspan="3" align="center"><i><h4>Empty</h4></i></td>
                                    </tr>
                                <?php
                            }
                            else{
                                foreach($invalid_professionals as $prof){
                                    ?>
                                        <tr>
                                            <form action="../controller/verify_process.php" method="post">
                                            <input type="hidden" name="targeted_user" value="<?=$prof['username']?>">
                    
                                            <td>
                                                <img src="../vendor/profiles/<?=$prof['profile_location']?>" alt="" width="30">
                                                <?=$prof['first_name'].' '.$prof['last_name']?>
                                            </td>
                                            <td>
                                                <input type="submit" name="verify" value="Verify">
                                                <input type="submit" name="remove" value="Delete">
                                            </td>
                                            <td>
                                                <a href="view_professional_documents.php?prof=<?=$prof['username']?>"><input type="button" name="view_documents" value="View Documents"></a>
                                            </td>
                    
                                            </form>
                                        </tr>
                                    <?php
                                }
                            }

                        ?>
                    </table>

                </fieldset>
            </td>
        </tr>
    </table>

</body>
</html>
