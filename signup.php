
<!DOCTYPE html>
<html>
<head>
    <title>Educational Account Signup</title>
</head>
<body>

 
    <fieldset>
        <legend>Account Signup</legend>
        <table  cellspacing="0"  align="center">
            <form action="signupprocess.php" method="POST">
                
                
                <tr>
                    <td>Signup-As:</td>
                    <td>
                        <select id="status" name="role" required>
                            <option value="Professionals ">Professionals</option>
                            <option value="Asparints">Proteges</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="EnterUsername" name="username" required></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" id="firstname" name="firstname" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" id="lastname" name="lastname" required></td>
                </tr>
                
                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" id=""></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" id="phone" name="phone" required></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <select id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Country:</td>
                    <td>
                        <select name="Country" id="Country"  required>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="India">India</option> 
                            <option value="	Afghanistan">Afghanistan</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Chine">Chine</option>
                            <option value="Germany">Germany</option>
                            <option value="United States">United States</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td><textarea name="address" id="" cols="30" rows="3" required></textarea></td>
                </tr>

                <tr>
                    <td>Password</td>
                    <td><input type="text" name="password" id=""></td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td><input type="text" name="cpassword" id=""></td>
                </tr>
                
                <tr>
                    
                    <td colspan="2">
                        <input type="checkbox" value="agreement" name="agreement" required >
                       I have read and accepted the Account Agreement
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="signup">
                    </td>
                </tr>
            </form>
        </table>
    </fieldset>
</body>
</html>
