<?php
  session_start();
  if(isset($_SESSION['logged_in'])){
    $user = $_SESSION['user'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Professional Sage | About</title>
  <!-- Add your CSS link or style tag here -->
  <style>
    /* Add the CSS code from the previous response here */
    /* Reset some default styles for better consistency */
    body, h1, h2, p, img, table, tr, td {
      margin: 0;
      padding: 0;
      border: none;
    }

    /* Set a background color for the body */
    body {
      background-color: #f0f0f0;
      font-family: Arial, sans-serif;
      line-height: 1.6;
    }

    /* Center align the h1 element */
    h1 {
      text-align: center;
    }

    /* Center align the h2 elements */
    h2 {
      text-align: center;
    }

    /* Center align the paragraphs (p elements) */
    p {
      text-align: center;
      margin-bottom: 10px;
    }

    /* Add some margin to the card elements */
    .card {
      margin: 20px;
    }

    /* Style the container within the card */
    .container {
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    /* Center align the text within the container */
    .container h2, .container p {
      text-align: center;
    }

    /* Style the images within the card */
    .card img {
      display: block;
      margin: 0 auto;
      border-radius: 80%;
    }

    /* Style the links within the container */
    .container a {
      display: inline-block;
      margin: 5px;
      color: #007bff;
      text-decoration: none;
    }

    /* Add hover effect to links */
    .container a:hover {
      text-decoration: underline;
      background-color: #f0f0f0;
      color: #007bff; /* Set the text color for the link on hover */
    }
      /* Style the "Contact" link */
    .container a.contact-link {
      color: #fff;
      padding: 6px 10px;
      border-radius: 5px;
      background-color: #007bff; /* Set the background color for the link */
      text-decoration: none;
    }

    /* Add a background color on hover for the "Contact" link */
    .container a.contact-link:hover {
      background-color: #0056b3; /* Change the background color on hover */
    }

    /* Add some spacing between card elements in the table */
    table {
      border-spacing: 20px;
    }

    /* Center align the table within its parent element */
    table {
      margin: 0 auto;
    }
  </style>
</head>

<body>
  <?php require_once('top_navbar.php'); ?>
  <div class="about-section">
    <h1 align="center">About Us Page</h1>
    <p align="center">Some text about who we are and what we do.</p>
    <p align="center">Resize the browser window to see that this page is responsive, by the way.</p>

    <h2 align="center">Project Summary</h2>
    <p align="center">Create a learning website that connects professionals with aspiring individuals.</p>
    <p align="center">Provide a platform for professionals to share their experiences, insights, and strategies.</p>
    <p align="center">Offer guidance and resources to help aspiring individuals develop skills and excel in their professions.</p>
  </div>

  <h2 style="text-align:center">Our Team</h2>
  <table style="width:100%;">
    <tr>
      <td align="center">
        <div class="card">
          <img src="../vendor/icons/21-44588-1.jpg" width="90" height="80">
          <div class="container">
            <h2>Asraful Alam</h2>
            <p class="title">CEO & Founder</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>
              <a href="mailto:asrafulalam@gmail.com">
                <img src="../vendor/icons/email.png" alt="Email Icon"width="30" height="30">
                asrafulalam@gmail.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/ratulratul88">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon" width="30" height="30">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">
              <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="30" height="30">
              Contact</a>
            </p>
          </div>
        </div>
      </td>
      <td align="center">
        <div class="card">
          <img src="../vendor/icons/pic.png" width="90" height="80">
          <div class="container">
            <h2>Asiya Akter</h2>
            <p class="title">Designer</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>
              <a href="mailto:asiyaakter@example.com">
                <img src="../vendor/icons/email.png" alt="Email Icon" width="30" height="30">
                asiyaakter@example.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/asiya.akter.9674">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon" width="30" height="30">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">   
                <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="30" height="30">
              Contact</a>
            </p>
          </div>
        </div>
      </td>
      <td align="center">
        <div class="card">
          <img src="3.jpg" width="90" height="80">
          <div class="container">
            <h2>Shafwan Haque</h2>
            <p class="title">Director</p>
            <p>Some text that describes me lorem ipsum ipsum lorem.</p>
            <p>
              <a href="mailto:ShafwanHaque@gmail.com">
                <img src="../vendor/icons/email.png" alt="Email Icon" width="30" height="30">
                ShafwanHaque@gmail.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/Shafwan.haq">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon"width="30" height="30">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">
              <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="30" height="30">
              Contact</a>
            </p>
          </div>
        </div>
      </td>
    </tr>
  </table>
  <?php include_once('bottom_navbar.php'); ?>
</body>

</html>
