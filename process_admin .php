<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $username = $_POST["username"];
    $firstName = $_POST["first-name"];
    $lastName = $_POST["last-name"];
    $usernameEmail = $_POST["username-email"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    echo "Username: " . $username . "<br>";
    echo "First Name: " . $firstName . "<br>";
    echo "Last Name: " . $lastName . "<br>";
    echo "Username/Email: " . $usernameEmail . "<br>";
    echo "Email Address: " . $email . "<br>";
    echo "Phone Number: " . $phoneNumber . "<br>";
    echo "Gender: " . $gender . "<br>";
    echo "Country/Region: " . $country . "<br>";
    echo "Address: " . $address . "<br>";
    echo "Password: " . $password . "<br>";
}
?>
