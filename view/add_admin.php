<!DOCTYPE html>
<html>
<head>
    <title>Add Admin</title>
</head>
<body>
    <?php require_once('topnavigationbar.php'); ?>

    <table align="center"  bgcolor="#f1f1f1">
        <tr>
            <td>
                <fieldset>
                    <legend>Add Admin</legend>
                    <form method="POST" action="process_admin.php">
                    <table cellspacing="0" cellpadding="5">
                        <tr>
                            <td bgcolor="#AED6F1  "><strong>Username:</strong></td>
                            <td><input type="text" id="username" name="username" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>First Name:</strong></td>
                            <td><input type="text" id="first-name" name="first-name" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Last Name:</strong></td>
                            <td><input type="text" id="last-name" name="last-name" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Username/Email:</strong></td>
                            <td><input type="text" id="username-email" name="username-email" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Email Address:</strong></td>
                            <td><input type="email" id="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Phone Number:</strong></td>
                            <td><input type="tel" id="phone" name="phone" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Gender:</strong></td>
                            <td>
                                <select id="gender" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Country/Region:</strong></td>
                            <td><input type="text" id="country" name="country" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Address:</strong></td>
                            <td><input type="text" id="address" name="address" required></td>
                        </tr>
                        <tr>
                            <td bgcolor="#AED6F1 "><strong>Password:</strong></td>
                            <td><input type="password" id="password" name="password" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input type="submit" value="Add as Admin">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>

</body>
</html>
