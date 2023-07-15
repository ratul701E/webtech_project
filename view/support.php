<!DOCTYPE html>
<html>
    <head>
        <title>Professional sage | Support</title>
    </head>
    <body>
        <?php require_once('topnavigationbar.php'); ?>
        <form action="../controller/supportprocess.php" method="POST">
            <table align="center">
                <tr>
                    <td>
                        <fieldset>
                            <legend align="center"><h3>Support</h3></legend>
                            <p align="center"><b><i>*Our admin will update you on the given email. It can take 2-3 days long.</i></b></p>
                            <table align="center">
                                <tr>
                                    <td>Email:</td>
                                    <td><input type="text" name="email" id=""></td>
                                </tr>
                                <tr>
                                    <td><label for="query">Query:</label></td>
                                    <td><textarea name="query" id="" cols="25" rows="3" required></textarea></td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="2"><button type="submit" name="submit">Submit Query</button></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>
        
    
             
                 
                

 
