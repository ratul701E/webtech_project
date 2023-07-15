<br>
<fieldset>
    <table align="center">
        <?php
            if(isset($_SESSION['logged_in'])){
                ?>
                    <tr align="center">
                        <td colspan="8"><a href="../controller/logout.php"><input type="submit" name="logout" value="Sign Out" id=""></a> <br><hr> </td>
                    </tr>
                <?php
            }
        ?>
        <tr align="center">
            <td>&nbsp;&nbsp;</td>
            <td><a href="about.php">About Us</a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="support.php">Support</a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href="faq.php">FAQ</a></td>
            <td>&nbsp;&nbsp;</td>
            <td><a href=""></a></td>
        </tr>
    </table>
    <footer>
        <p align="center">&copy; 2023 Professional Sage. All rights</p>
    </footer>

</fieldset>