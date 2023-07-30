<?php
  session_start();
  if(isset($_SESSION['logged_in'])){
    $user = $_SESSION['user'];
  }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Professional sage | Support</title>
    <link rel="stylesheet" type="text/css" href="support.css">
    <script src="../controller/js/support.js"></script>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <form action="../controller/supportprocess.php" method="POST" onsubmit="return validate()">
        <table align="center">
            <tr>
                <td align="center">
                    <h3>Support</h3>
                    <p align="center"><b><i>*Our admin will update you on the given email. It can take 2-3 days long.</i></b></p>
                    <table align="center">
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" name="email" id="email" onkeyup="validEmail()">
                                <div class="msg">
                                    <span id="email_status"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="query">Query:</label></td>
                            <td>
                                <textarea name="query" id="query" cols="20" rows="2" onkeyup="validQuery()"></textarea>
                                <div class="msg">
                                    <span id="query_status"></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><button type="submit" name="submit">Submit Query</button></td>
                            
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>
