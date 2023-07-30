<fieldset>
    <img src="../vendor/icons/main_logo.png" alt="" width="30"> &nbsp;&nbsp;&nbsp;
    <?php if (isset($_SESSION['logged_in'])) {
    ?>
        <a href="profile.php?username=user">Profile</a> &nbsp;&nbsp;&nbsp;
    <?php
    }
    if(isset($_SESSION['logged_in']) and ($user['role'] == 'Admin' or $user['role'] == 'SuperAdmin')){
        ?>
            <a href="manage_user.php">Manage Users</a> &nbsp;&nbsp;&nbsp;
            <a href="manage_discussionPosts.php">Manage Posts</a> &nbsp;&nbsp;&nbsp;
            <a href="manage_query.php">Queries</a> &nbsp;&nbsp;&nbsp;
        <?php
    }
    ?>
    <a href="discussion.php">Discussion</a> &nbsp;&nbsp;&nbsp;

    <table align="right">
        <tr>
            <td>
                <b>Today: </b>
                <?= date("l"); ?>
                <td>&nbsp;&nbsp;</td>
            </td>
            <?php
            if (!isset($_SESSION['logged_in'])) { ?>
                <td><a href="signin.php"><input type="button" value="Signin" id=""></a></td>
            <?php
            }

            if (isset($_SESSION['logged_in'])) {                                                                                                                    ?>
                <td><b>[<?= $user['role'] ?>]</b></td>
                <td>&nbsp;&nbsp;</td>
                <td><img src="../vendor/profiles/<?= $user['profile_location'] ?>" alt="" width="25" height="25"></td>
                <td><?= $user['username'] ?></td>
                <td>&nbsp;&nbsp;</td>
                <td><a href="../controller/logout.php"><input type="submit" name="logout" value="Sign Out" id=""></a> </td>
            <?php
            }
            ?>
        </tr>
    </table>
</fieldset>