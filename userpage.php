<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif, backg}
    .w3-row-padding img {margin-bottom: 12px}
    /* Set the width of the sidebar to 120px */
    .w3-sidebar {width: 120px;background: #BFEDAB;}
    /* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
    #main {margin-left: 120px}
    /* Remove margins from "page content" on small screens */
    @media only screen and (max-width: 600px) {#main {margin-left: 0}}
    </style>
  </head>
<body style="color:#0E9A50">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/California_State_University%2C_Fullerton_seal.svg/1200px-California_State_University%2C_Fullerton_seal.svg.png" style="width:100%">
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-teal">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ABOUT</p>
  </a>
  <a href="#photos" class="w3-bar-item w3-button w3-padding-large w3-hover-teal">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>PHOTOS</p>
  </a>
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-teal">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>CONTACT</p>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-green w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
    <a href="#photos" class="w3-bar-item w3-button" style="width:25% !important">PHOTOS</a>
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-green" id="home">
    <?php
    // Fetch the name from the database based on the logged in user
    session_start();
    include "db_connection.php";
    // Check if user is logged in
    if(isset($_SESSION['username'])){
      $uname = $_SESSION['username'];
      // Fetch the name from the database
      $stmt = $conn->prepare("SELECT first_name FROM users WHERE username = ?");
      $stmt->bind_param("s", $uname);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row['first_name'];
        echo '<h1 class="w3-jumbo"><span class="w3-hide-small">I\'m</span> '.$fname.'</h1>';
        echo '<p>CSUF Student</p>';
      }
      $stmt->close();
      mysqli_close($conn);
    } else {
      // If user is not logged in, display default name
      echo '<h1 class="w3-jumbo"><span class="w3-hide-small">I\'m</span> Caroline Ek</h1>';
      echo '<p>CSUF Student</p>';
    }
    ?>
    <img src="https://img.mensxp.com/media/content/2018/Sep/powerlifters-who-can-beat-bodybuilders-in-aesthetics-740x500-1-1537273242.jpg" alt="boy" class="w3-image" width="992" height="1108">
  </header>
</div>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-green w3-padding-64" id="about">
    <h2 class="w3-text-green">Biography</h2>
      <p>Here's my linktree.</p>
    <hr style="width:200px" class="w3-opacity">
    <form>
      <textarea rows="5" cols="40" name="Description" spellcheck="false">
      </textarea>
    </form>
  <!-- Portfolio Section -->
  <div class="w3-padding-64 w3-content" id="photos">
    <h2 class="w3-text-green">My Photos</h2>
    <hr style="width:200px" class="w3-opacity">

    <!-- Grid for photos -->
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="https://www.w3schools.com/w3images/wedding.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/rocks.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/sailboat.jpg" style="width:100%">
      </div>

      <div class="w3-half">
        <img src="https://www.w3schools.com/w3images/underwater.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/chef.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/wedding.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/p6.jpg" style="width:100%">
      </div>
    <!-- End photo grid -->
    </div>
  <!-- End Portfolio Section -->
  </div>

  <!-- Contact Section -->
  <div class="w3-padding-64 w3-content w3-text-green" id="contact">
    <h2 class="w3-text-green">Contact Me</h2>
    <hr style="width:200px" class="w3-opacity">

    <div class="w3-section">
      <label for="city">City:</label>
      <p><i class="fa fa-phone fa-fw w3-text-green w3-xxlarge w3-margin-right"></i> Phone: 1800-588-2300 EMPIRE </p>
      <p><i class="fa fa-envelope fa-fw w3-text-green w3-xxlarge w3-margin-right"> </i> Email: Legend27@fullerton.edu</p>
    </div><br>
    
  </div>
  
<!-- Footer. This section contains an ad for W3Schools Spaces. You can leave it to support us. -->
  <i class="fa fa-facebook-official w3-hover-opacity"></i>
  <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i>

<!-- END PAGE CONTENT -->
</div>

</body>
</html>