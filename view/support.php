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
    <script src="../controller/js/support.js"></script>
    <style>/* style.css */

/* General Styles */

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    color: black;
    text-align: center;
    font-weight: bold;
}

b {
    color: red;
    font-weight: bold;
}

i {
    font-style: italic;
    
}

a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}


form {
    background-color: #fff;
    padding: 20px;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 10px;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 12px;
    box-sizing: border-box;
}

form textarea {
    resize: vertical;
}

form button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
   
}

form button[type="submit"]:hover {
    background-color: #0056b3;
}


.msg {
    color: red;
    font-size: 16px;
   
}


</style>
</head>

<body>
    <?php require_once('top_navbar.php'); ?>
    <form action="../controller/supportprocess.php" method="POST" onsubmit="return validate()">
        <table align="center">
            <tr>
                <td align="center">
                    <h2>Support</h2>
                    <p align="center"><b><i>*Our admin will update you on the given email. It can take 2-3 days long.</i></b></p>
                    <table align="center">
                        <tr>
                            <td >Email:</td>
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
