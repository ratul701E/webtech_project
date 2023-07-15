<fieldset>
    <img src="../vendor/icons/main_logo.png" alt="" width="30"> &nbsp;&nbsp;&nbsp;
    <?php if(isset($_SESSION['logged_in'])) {
        ?>
            <a href="profile.php?username=user">Profile</a> &nbsp;&nbsp;&nbsp;
        <?php
    }
    ?>
    <a href="discussion.php">Discussion</a> &nbsp;&nbsp;&nbsp;

    <table align="right">
        <tr>
            
            <form action="../controller/logout.php" method="post">
                <?php
                    if(!isset($_SESSION['logged_in'])) {?> <td><a href="signin.php"><input type="button" value="Signin" id=""></a></td> <?php }
                    if(isset($_SESSION['logged_in'])) {
                        ?>
                            <td><img src="../vendor/profiles/<?=$user['profile_location']?>" alt="" width="30"></td>
                            <td><?=$user['username']?></td>
                            <td>&nbsp;&nbsp;</td>
                            <td><input type="submit" value="Logout" id=""></td> 
                        <?php
                    }
                ?>
            </form>
        </tr>
    </table>
</fieldset>