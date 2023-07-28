<?php
session_start();

$msg = '';
if (isset($_GET['err'])) {
    $err_msg = $_GET['err'];
    switch ($err_msg) {
        case 'userExist': {
            $msg = "Username or email is already registred.";
            break;
        }
        case 'shortPassword': {
            $msg = "Password length must be 8 or more long.";
            break;
        }
        case 'passwordMismatch': {
            $msg = "Password and confrim password does not match";
            break;
        }

        case 'invalidUsername': {
            $msg = "The username is invalid. Note: Alpahbets and underscore only and at least 4 character long";
            break;
        }

        case 'invalidFirstName': {
            $msg = "First name is invalid. Note: Alphabet & space only and at least 3 character long";
            break;
        }

        case 'invalidLastName': {
            $msg = "Last name is invalid. Note: Alphabet space only and at least 3 character long";
            break;
        }

        case 'invalidEmail': {
            $msg = "Invalid email. Please provide a proper email address";
            break;
        }

        case 'invalidAddress': {
            $msg = "Are your address is ok?. Please provide a details address.";
            break;
        }

        case 'invalidRole': {
            $msg = "A role must be selected.";
            break;
        }

        case 'invalidGender': {
            $msg = "A gender must be selected.";
            break;
        }

        case 'invalidCountry': {
            $msg = "A country must be selected.";
            break;
        }

        case 'invalidPhone': {
            $msg = "Your phone is invalid. Note: DO NOT INCLUDE COUNTRY CODE";
            break;
        }
        case 'agreementErr': {
            $msg = "Please check our agreement. :)";
            break;
        }

        case 'invalidFileFormat': {
            $msg = "Invalid File format in profile. Only image are allowed.";
            break;
        }
    }
}

if(isset($_SESSION['logged_in'])){
    header('location: profile.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Professional Sage | Signup</title>
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>
    <?php require_once('top_navbar.php'); ?>

    <table align='center'>
        <tr>
            <td>
                <fieldset>
                    <legend align='center'>
                        <h3 style="color: cyan;">Account Signup</h3> <!-- Added text color cyan -->
                    </legend>
                    <table cellpadding="3" align="center">
                        <form action="../controller/singup_process.php" method="POST" enctype="multipart/form-data">

                            <?php if (strlen($msg) > 0) { ?>
                                <tr align="center">
                                    <td colspan="2">
                                        <font color="red"> <?= $msg ?></font>
                                    </td>
                                </tr>
                            <?php } ?>

                            <tr>
                                <td><label for="signup-as"><font color="red"><sup>*</sup></font>Signup As:</label></td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                <label for="professional">
                                                    <input type="radio" id="professional" name="role" value="Professional">
                                                    <img src="../vendor/icons/professional.jpg" alt="Professional Image" width="15">
                                                    Professional
                                                </label>
                                            </td>
                                            <td>
                                                <label for="protege">
                                                    <input type="radio" id="Aspirant" name="role" value="Aspirant">
                                                    <img src="../vendor/icons/protege.avif" alt="AspirantImage" width="17">
                                                    Aspirant
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>Username</td>
                                <td><input type="text" id="EnterUsername" name="username"></td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>First Name:</td>
                                <td><input type="text" id="first-name" name="first_name"></td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>Last Name:</td>
                                <td><input type="text" id="last-name" name="last_name"></td>
                            </tr>

                            <tr>
                                <td><font color="red"><sup>*</sup></font>Email</td>
                                <td><input type="email" name="email" id=""></td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>Phone Number:</td>
                                <td>
                                    <i> <font color="red" size="2">*without country code</font></i> <br>
                                    <input type="text" id="phone" name="phone">
                                </td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>Gender:</td>
                                <td>
                                    <select id="gender" name="gender">
                                        <option value="">-- Select Gender --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><font color="red"><sup>*</sup></font>Country/Region:</td>
                                <td>
                                    <select id="country" name="country">
                                        <option value="">-- Select a country --</option>
                                        <option value="USA">United States of America</option>
                                        <option value="UK">United Kingdom</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="India">India</option>
                                        <option value="China">China</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><font color="red"><sup>*</sup></font>Address</td>
                                <td><textarea name="address" id="" cols="30" rows="3"></textarea></td>
                            </tr>

                            <tr>
                                <td><font color="red"><sup>*</sup></font>Password</td>
                                <td><input type="password" name="password" id=""></td>
                            </tr>

                            <tr>
                                <td><font color="red"><sup>*</sup></font>Confirm Password</td>
                                <td><input type="password" name="cpassword" id=""></td>
                            </tr>

                            <tr>
                                <td>Profile</td>
                                <td>
                                    &nbsp; <input type="file" name="profile">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" value="agreement" name="agreement">
                                    I have read and accepted the Account Agreement
                                </td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
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
            </td>
        </tr>
    </table>
    <?php include_once('bottom_navbar.php'); ?>
</body>

</html>


