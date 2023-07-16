<?php
  session_start();
  if(isset($_SESSION['logged_in'])){
    $user = $_SESSION['user'];
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Progessional Sage | About</title>
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
                <img src="../vendor/icons/email.png" alt="Email Icon" width="10" height="10">
                asrafulalam@gmail.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/ratulratul88">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon" width="10" height="10">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">
              <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="10" height="10">
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
                <img src="../vendor/icons/email.png" alt="Email Icon" width="10" height="10">
                asiyaakter@example.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/asiya.akter.9674">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon" width="10" height="10">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">   
                <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="10" height="10">
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
                <img src="../vendor/icons/email.png" alt="Email Icon" width="10" height="10">
                ShafwanHaque@gmail.com
              </a>
            </p>
            <p>
              <a href="https://www.facebook.com/Shafwan.haq">
                <img src="../vendor/icons/fb.svg.png" alt="Facebook Icon" width="10" height="10">
                Facebook
              </a>
            </p>
            <p>
              <a href="support.php" class="button">
              <img src="../vendor/icons/contact.jpg" alt="Contact Icon" width="10" height="10">
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