<?php
$msg = '';
if(isset($_GET['err'])){
    $err_msg = $_GET['err'];
    switch($err_msg){
        case 'userExist':{$msg = "Username or email is already registred."; break;}
        case 'shortPassword':{$msg = "Password length must be 8 or more long."; break;}
        case 'passwordMismatch':{$msg = "Password and confrim password does not match"; break;}
    }
        
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Professional Sage | Signup</title>
</head>
<body>

    <fieldset>
        <legend>Account Signup</legend>
        <table  cellspacing="0"  align="center">
            <form action="../controller/singup_process.php" method="POST" enctype="multipart/form-data">
                
                <?php if(strlen($msg) > 0){ ?>
                    <tr align="center">
                        <td colspan="2"><font color="red"><?=$msg?></font></td>
                    </tr>
                <?php } ?>

                
                <tr>
                    <td>Signup-As:</td>
                    <td>
                        <select id="status" name="role" required>
                            <option value="Professional">Professional</option>
                            <option value="Aspirant">Aspirant</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" id="EnterUsername" name="username" required></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" id="first-name" name="first_name" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" id="last-name" name="last_name" required></td>
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
                    <td>Country/Region:</td>
                    <td>
                        <select name="country" id="">
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="India">India</option> 
                            <option value="Afghanistan">Afghanistan</option>
                            <option value="Belarus">Belarus</option>
                            <option value="China">China</option>
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
                    <td>Profile</td>
                    <td>
                     &nbsp; <input type="file" name="profile" accept="image/*">
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="2" align="right">
                        <input type="submit" name="signup" value="Sign Up">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        Already have an account? <a href="signin.php">Signin</a>
                    </td>
                </tr>
            </form>
        </table>
    </fieldset>
</body>
</html>
