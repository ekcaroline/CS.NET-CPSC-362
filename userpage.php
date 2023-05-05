<?php
session_start();
include "db_connection.php";

// Check if user is logged in
if(!isset($_SESSION['username'])){
  header("Location: logincsnet.php");
  exit();
}
?>

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
  <a href="https://my.fullerton.edu/Portal/Dashboard/" target=\"_blank\">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/California_State_University%2C_Fullerton_seal.svg/1200px-California_State_University%2C_Fullerton_seal.svg.png"; alt="fullertonportal"; style= "width: 100%;">
</a>
  <a href="homepage.php" class="w3-bar-item w3-button w3-padding-large w3-">
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
    <a href="#friends" class="w3-bar-item w3-button w3-padding-large w3-hover-teal">
    <i class="fa fa-heart w3-xxlarge"></i>
    <p>FRIENDS</p>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-">
    <i class="fa fa-arrow-left w3-xxlarge"></i>
    <p>SIGNOUT</p>
  </a>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-green w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
    <a href="#photos" class="w3-bar-item w3-button" style="width:25% !important">PHOTOS</a>
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
    <a href="#friends" class="w3-bar-item w3-button" style="width:25% !important">FRIENDS</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <div>
     <script async src="https://cse.google.com/cse.js?cx=66ccd603cbd2a43d8"></script>
    <style>
      /* Style the search box */
      .gcse-search {
        position: relative;
        z-index: 1;
        width: 200px;
        height: 24px;
      }
    </style>
  <body>
    <!-- Display the search box at the top of the page -->
    <div class="gcse-search"></div>
  </body>
  </div>
  <header class="w3-container w3-padding-32 w3-center w3-green" id="home">
    <!-- The HTML for the edit button with inline styles and hover effect -->
<div style="display: flex; align-items: center;">
 <button onclick="location.href='editpage.php';" style="display: inline-block; background-color: white; color:green; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;" onmouseover="this.style.backgroundColor='whitesmoke';" onmouseout="this.style.backgroundColor= 'white';">Edit</button>

</div>
  <?php
    // Fetch the name from the database based on the logged in user
    // Check if user is logged in
    if(isset($_SESSION['username'])){
      $uname = $_SESSION['username'];
      // Fetch the name from the database
      $stmt = $conn->prepare("SELECT first_name, last_name, age, interest, city, socials, pfp FROM users WHERE username = ?");
      $stmt->bind_param("s", $uname);
      $stmt->execute();
      $result = $stmt->get_result();
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $age = $row['age'];
        $interest = $row['interest'];
        $city = $row['city'];
        $socials = $row['socials'];
        $pfp = $row['pfp'];
        echo '<h1 class="w3-jumbo"><span class="w3-hide-small"></span> '.$fname.' '.$lname.'</h1>';
        echo '<p>CSUF Student</p>';
      }
      $stmt->close();
    } else {
      // If user is not logged in, display default name
      echo '<h1 class="w3-jumbo"><span class="w3-hide-small">_____</h1>';
      echo '<p>CSUF Student</p>';
    }
    ?>
    <!-- Profile Picture -->
    <?php
    if ($pfp) {
      $pfp_data_uri = "data:image/png;base64," . base64_encode($pfp);
      echo '<img src="'.$pfp_data_uri.'" alt="Profile Picture" width="550" height="550">';
    } else {
      // Output default image if no pfp is saved
      echo '<img src="https://wallpapers.com/images/hd/angel-default-pfp-a1ur2igijuw6g02n.jpg" alt="boy" class="w3-image" width="550" height="550">';
    }
    ?>
    
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-green w3-padding-64" id="about">
    <h2 class="w3-text-green">Information</h2>
    <p><i class="fa fa-user fa-fw w3-text-green w3-xxlarge w3-margin-right"></i> Age: 
      <?php
      echo ' '.$age.' '; 
      ?></p>
      <i class="fa fa-home fa-fw w3-text-green w3-xxlarge w3-margin-right"></i>City: 
      <?php
      echo ' '.$city.' '; 
      ?>
      <p><i class="fa fa-envelope fa-fw w3-text-green w3-xxlarge w3-margin-right"></i> Linkedin: 
      <?php
      echo "<a href='$socials' target=\"_blank\">$socials</a>";

      ?></p>
      <p><i class="fa fa-cog fa-fw w3-text-green w3-xxlarge w3-margin-right"></i> Interest: 
      <?php
      echo ' '.$interest.' '; 
      ?></p>
    <hr style="width:200px" class="w3-opacity">
  <!-- Portfolio Section -->
  <div class="w3-padding-64 w3-content" id="photos">
    <h2 class="w3-text-green">My Photos</h2>
    <hr style="width:200px" class="w3-opacity">

    <!-- Grid for photos -->
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="https://preview.redd.it/ad1k2gp47fs91.jpg?auto=webp&s=db94f3eeee0e2f8a259c2366666d632a8804ad56" style="width:100%">
        <img src="https://preview.redd.it/sc6hdq4whk741.png?width=640&crop=smart&auto=webp&v=enabled&s=8ce4734a533a551af458c1ecdf0eb7f7e6df7c48" style="width:100%">
        <img src="https://preview.redd.it/mq1tcn4swfj31.jpg?width=640&crop=smart&auto=webp&v=enabled&s=73dfb2eb78496aea4a1970af7e7ca4385f7551ef" style="width:100%">
      </div>

      <div class="w3-half">
        <img src="https://preview.redd.it/gjsl88k4ogq21.jpg?width=640&crop=smart&auto=webp&v=enabled&s=4ee9f7e83b207e004dd0c3e59cb0f0466b31a2b6" style="width:100%">
        <img src="https://www.w3schools.com/w3images/chef.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/wedding.jpg" style="width:100%">
        <img src="https://www.w3schools.com/w3images/p6.jpg" style="width:100%">
      </div>
    <!-- End photo grid -->
    </div>
  <!-- End Portfolio Section -->
  </div>
<!-- Friends Section -->
<div class="w3-padding-64 w3-content w3-text-green" id="friends">
  <h2 class="w3-text-green">My Friends</h2>
  <hr style="width:200px" class="w3-opacity"> 
  <!-- Friends PhP -->
  <?php
  // Fetch friends from the database
  $user_interests = array();
  $stmt = $conn->prepare("SELECT u.id, u.first_name, u.last_name, u.interest, u.pfp FROM users u INNER JOIN friendships f ON u.id = f.friend_id OR u.id = f.user1_id WHERE (f.user1_id = ? OR f.friend_id = ?) AND u.id != ?");

  $stmt->bind_param("iii", $user_id, $user_id, $user_id);
  $user_id = $_SESSION['user_id'];
  $stmt->execute();
  $result = $stmt->get_result();

  $friend_output = false; // Flag variable

  while ($row = $result->fetch_assoc()) {
    // Output each friend
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $pfp = $row['pfp'];
    $interests = explode(',', $row['interest']); // Split interests into an array
    $user_interests = explode(",", $interest);
    $common_interests = array_intersect($interests, $user_interests); // Find common interests
    echo '<li style="display: flex; align-items: center; margin-bottom: 10px;">';
    if (!empty($pfp)) {
      // Profile picture is not empty, display it
      $pfp_data_uri = "data:image/png;base64," . base64_encode($pfp);
      echo '<img src="'.$pfp_data_uri.'" alt="Friend avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">';
    } else {
      // Profile picture is empty, display default photo
      echo '<img src="https://static.vecteezy.com/system/resources/thumbnails/009/734/564/small/default-avatar-profile-icon-of-social-media-user-vector.jpg" alt="Default avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">';
    }
    echo '<p style="font-color: darkgreen; font-size: 18px; margin: 0;">'.$fname.' '.$lname."\n".' Common Interests: ';
    if (!empty($common_interests)) {
      echo rtrim(implode(', ', $common_interests), ', ');
    } else {
      echo 'None';
    }
    $friend_output = true;
  } if (!$friend_output) {
    echo 'No friends. 0 friends. Friendless...';
  }
  ?>
  </div>
  <div style="margin-bottom: 20px;">
    <h2 style="font-size: 24px; margin-bottom: 10px;">Follow Suggestions</h2>
    <ul style="list-style: none; margin: 0; padding: 0;">
    <?php
      // Fetch friend suggestions from the database
      $user_interests = array();
      $stmt = $conn->prepare("SELECT u.id, u.first_name, u.last_name, u.interest, u.pfp FROM users u LEFT JOIN friendships f ON (u.id = f.friend_id OR u.id = f.user1_id) AND (f.user1_id = ? OR f.friend_id = ?) WHERE u.id != ? AND f.user1_id IS NULL");

      $stmt->bind_param("iii", $user_id, $user_id, $user_id);
      $user_id = $_SESSION['user_id'];
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
        // Output each friend suggestion
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $pfp = $row['pfp'];
        $interests = explode(',', $row['interest']); // Split interests into an array
        $user_interests = explode(",", $interest);
        $common_interests = array_intersect($interests, $user_interests); // Find common interests
        echo '<li style="display: flex; align-items: center; margin-bottom: 10px;">';
        $pfp_data_uri = "data:image/png;base64," . base64_encode($pfp);
        echo '<img src="'.$pfp_data_uri.'" alt="Friend avatar" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px;">';
        echo '<p style="font-color: darkgreen; font-size: 18px; margin: 0;">'.$fname.' '.$lname."\n".' Common Interests: ';
        if (!empty($common_interests)) {
          echo rtrim(implode(', ', $common_interests), ', ');
        } else {
          echo 'None';
        }
        echo '</p>';
        echo '<form method="POST" action="send_friend_request.php">';
        echo '<input type="hidden" name="friend_id" value="'.$row['id'].'">';
        echo '<button id="add-friend-btn" style="padding: 10px; background-color: #8BED7C; border: none; border-radius: 3px; color: darkgreen; font-size: 16px; margin-left: auto; cursor: pointer;">Add friend</button>';
        echo '</form>';
        echo '</li>';
      }
      $stmt->close();
      mysqli_close($conn);
    ?>
    </ul>
  </div>
</div>

  
<!-- Footer. -->
<a href="https://www.instagram.com"><i class="fa fa-instagram w3-hover-opacity"></i></a>
<a href="https://www.snapchat.com"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
<a href="https://www.pinterest.com"><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>
<a href="https://www.twitter.com"><i class="fa fa-twitter w3-hover-opacity"></i></a>
<a href="https://www.linkedin.com"><i class="fa fa-linkedin w3-hover-opacity"></i></a>

<!-- END PAGE CONTENT -->
</div>

</body>
</html>