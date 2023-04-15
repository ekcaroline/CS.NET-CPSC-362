<?php
// Connect to your MySQL database
$mysqli = new mysqli("localhost", "username", "password", "database_name");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle file upload
$photo = $_FILES['photo'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($photo["name"]);
move_uploaded_file($photo["tmp_name"], $target_file);

// Retrieve other form data
$selectAllOption = $_POST['selectAllOption'];
$dropdownOption = $_POST['dropdownOption'];

// Insert form data into database
$sql = "INSERT INTO data (selectAllOption, dropdownOption) VALUES (?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $selectAllOption, $dropdownOption);
$stmt->execute();
$stmt->close();

// Insert uploaded photo data into database
$sql = "INSERT INTO uploads (filename, filepath) VALUES (?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $photo["name"], $target_file);

// Execute the prepared statement
if ($stmt->execute()) {
    // Set session variable
    $_SESSION['username'] = $uname;

    // Close the statement and database connection
    $stmt->close();
    mysqli_close($conn);

    // Redirect to welcomepage.php
    header("Location: welcomepage.php");
    exit();
}

$mysqli->close();
?>


<style>
  h {
    color:#BFEDAB;
    font-family: Helvetica;
    font-size: 300%;
    position: static;
    text-align: center;
  }
    body {
    background-image: linear-gradient(to top,teal 0%, #0E9A50 100%);
}
  label {
    color: white; 
    font-family: helvetica; 
  }
a {
  background-color: #54C880;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
a:hover, a:active {
    background-color: #7EC473;
}
</style>

<html>
<h>
    Add more stuff about yourself!
</h>
  <br>
  <script src = "script.js"> </script>
<div class="profile-pic">
  <label class="-label" for="file">
    <span class="glyphicon glyphicon-camera"></span>
    <br><br>
    <span>Add profile picture</span>
  </label>
  <input id="file" type="file" onchange="loadFile(event)"/>
  <br><br>
  <img style= "text-align: left;"src="https://img.mensxp.com/media/content/2018/Sep/powerlifters-who-can-beat-bodybuilders-in-aesthetics-740x500-1-1537273242.jpg" id="output" width="200" />
</div>
  
  <p style="color:#BFEDAB;font-size:20px;">
    What are you interested in?
  </p>
<body>
  <form>
  <input type="checkbox" id="int1" name="int1" value="Software Engineering">
  <label for="interest1"> Software Engineering</label><br>
  <input type="checkbox" id="int2" name="int2" value="Game Development">
  <label for="interest2"> Game Development</label><br>
  <input type="checkbox" id="int3" name="int3" value="Cybersecurity">
  <label for="interest3"> Cybersecurity</label><br> 
  <input type="checkbox" id="int4" name="int4" value="Systems and Networking">
  <label for="interest4"> Systems and Networking</label><br>
  <input type="checkbox" id="int5" name="int5" value="Artificial Intelligence">
  <label for="interest5"> Artificial Intelligence</label><br>
</form>

  <p1 style="color:#BFEDAB;font-size:20px;">
    Where are you located?
  </p1>

  <br><br>
  <form>
  <label style= "color: white; font-size: 15px; font-family: Helvetica;" for="city">City:</label>
  <select name="city" id="city">
    <optgroup label="Southern California">
      <option value="SD">San Diego</option>
      <option value="FUL">Fullerton</option>
      <option value="SA">Santa Ana</option>
      <option value="CO">Corona</option>
      <option value="IRV">Irvine</option>
      <option value="LAGB">Laguna Beach</option>
    </optgroup>
    <optgroup label="Central California">
      <option value="FRE">Fresno</option>
      <option value="SANBAR">Santa Barbara</option>
      <option value="Stockton">Stockton</option>
    </optgroup>
     <optgroup label="Northern California">
      <option value="SANF">San Francisco</option>
      <option value="SANCR">Santa Cruz</option>
      <option value="NAPA">Napa</option>
    </optgroup>
  </select>
  <br><br>
    <label style= "color: white; font-size: 15px; font-family: Helvetica;" for="linktree">Linktree:</label><br>
     <input style= "font-family: 'Times New Roman', Times, serif;
    font-size: 20px;color: black;" type="linktree" id="social" name="social" placeholder="Linktree link..."><br>

  <br><br>
  <a  href="userpage.php"> Submit</a>
</body>
</html>