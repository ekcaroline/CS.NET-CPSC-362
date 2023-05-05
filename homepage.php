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
  <!--This is the navbar on large screens-->
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
    <a href="userpage.php" class="w3-bar-item w3-button w3-padding-large w3-">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>PROFILE</p>
      <a/>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding-large w3-">
    <i class="fa fa-arrow-left w3-xxlarge"></i>
    <p>SIGNOUT</p>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-green w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="userpage.php" class="w3-bar-item w3-button" style="width:25% !important">PROFILE</a>
    <a href="logout.php" class="w3-bar-item w3-button" style="width:25% !important">SIGN OUT</a>
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

   <!-- News Section -->

     <div class="w3-section">
     <iframe src="https://news.fullerton.edu/engineering-and-computer-science/" width="100%" height="500px"></iframe>
        <h2 class="w3-text-green">Student Social Life</h2>
      <p><i class="w3-text-green w3-xxlarge w3-margin-right"></i> Discover unique opportunities! </p> <br>
       <button style="color: white;
               background-color: #54C880;
               text-align: center;
               padding: 16px 32px;
               text-decoration: none;
               display: inline-block;
               font-size: 16px;
               font-family: 'Times New Roman', Times, serif;
               margin: 3px 2px;
               transition-duration: 0.4s;
               cursor: pointer;
               max-width: 200px;">
  <a href="https://fullerton.campuslabs.com/engage/" style="color: inherit; text-decoration: none;">Go to Engage</a>
</button>


    </div><br>
  
<!-- Footer. . -->
<a href="https://www.instagram.com"><i class="fa fa-instagram w3-hover-opacity"></i></a>
<a href="https://www.snapchat.com"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
<a href="https://www.pinterest.com"><i class="fa fa-pinterest-p w3-hover-opacity"></i></a>
<a href="https://www.twitter.com"><i class="fa fa-twitter w3-hover-opacity"></i></a>
<a href="https://www.linkedin.com"><i class="fa fa-linkedin w3-hover-opacity"></i></a>


<!-- END PAGE CONTENT -->
</div>

</body>
</html>

