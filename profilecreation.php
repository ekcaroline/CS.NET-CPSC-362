<?php
session_start();
include "db_connection.php";

// Define variables and set to empty values
$fname = $lname = $uname = $pwd = $age = $interest = $city = $socials = "";
$fnameErr = $lnameErr = $unameErr = $pwdErr = $ageErr = $interErr = $cityErr = $socErr = "";
$interests = array("Software Engineering", "Game Development", "Cybersecurity", "Systems and Networking", "Artificial Intelligence", "Web Development");
$selected_interests = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate first name
  if (empty($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
    $fname = htmlspecialchars(trim($_POST["fname"]));
    // Check if first name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }
  
  // Validate last name
  if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = htmlspecialchars(trim($_POST["lname"]));
    // Check if last name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = "Only letters and white space allowed";
    }
  }

  // Validate username
  if (empty($_POST["uname"])) {
    $unameErr = "Username is required";
  } else {
    $uname = htmlspecialchars(trim($_POST["uname"]));
    // Check if username only contains letters, numbers, and underscore
    if (!preg_match("/^[a-zA-Z0-9_]*$/",$uname)) {
      $unameErr = "Only letters, numbers, and underscore allowed";
    }
  }

  // Validate password
  if (empty($_POST["pwd"])) {
    $pwdErr = "Password is required";
  } else {
    $pwd = htmlspecialchars(trim($_POST["pwd"]));
    // Check if password only contains numbers and is 4 digits long
    if (!preg_match("/^[0-9]{4}$/",$pwd)) {
      $pwdErr = "Password must be 4 digits";
    }
  }

  // Validate age
  if (empty($_POST["age"])) {
    $ageErr = "Age is required";
  } else {
    $age = htmlspecialchars(trim($_POST["age"]));
    // Check if age is a number between 18 and 99
    if (!preg_match("/^(1[8-9]|[2-9][0-9])$/",$age)) {
      $ageErr = "Age must be a number between 18 and 99";
    }
  }

  // Validate interest
  // check if at least one interest is selected
  if (empty($_POST['int1']) && empty($_POST['int2']) && empty($_POST['int3']) && empty($_POST['int4']) && empty($_POST['int5']) && empty($_POST['int6'])) {
    $interErr = "Please select at least one interest";
  } else {
    // get selected interests
    $i = 0;
    foreach($interests as $interest) {
      if (!empty($_POST['int' . ($i+1)])) {
        $selected_interests[] = $_POST['int' . ($i+1)];
      }
      $i++;
    }
  }

  // Validate City
  if (empty($_POST["city"])) {
    $cityErr = "City is required";
  } else {
      $city = htmlspecialchars(trim($_POST["city"]));
      // Check if city only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$city)) {
          $cityErr = "Only letters and white space allowed for city name";
      }
  }

  // Validate Socials
  if(isset($_POST["socials"]) && !empty($_POST["socials"])) {
    $url = trim($_POST['socials']);
    if(filter_var($url, FILTER_VALIDATE_URL)){
        $socials = $url;
    } else {
        $socErr = "Invalid URL";
    }
  } else {
    // User didn't provide a value for the optional field, set $socials to NULL or empty string depending on your database schema
    $socials = null; // or $socials = '';
  }
  
  // If there are no errors, insert user information into database using prepared statement
  if (empty($fnameErr) && empty($lnameErr) && empty($unameErr) && empty($pwdErr) && empty($ageErr) && empty($interErr) && empty($cityErr) && empty($socErr)) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, age, interest, city, socials) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $selected_interest = implode(", ", $selected_interests);
    $stmt->bind_param("ssssisss", $uname, $pwd, $fname, $lname, $age, $selected_interest, $city, $socials); // Bind parameters to placeholders
  
    if ($stmt->execute()) { // Execute the prepared statement
      $_SESSION['username'] = $uname;
      $stmt->close();
      mysqli_close($conn);
      header("Location: userpage.php");
      exit();
    }
  }  
}
?>
<!---------Style--------->
<style>
  body {
    background-image: linear-gradient(to top, teal 0%, #5F9EA0 50%, #0E9A50 100%);
  }

  h {
    color: #BFEDAB;
    padding: 16px 32px;
    font-size: 30px;
    font-family: courier 'Courier New', Courier, monospace;
  }

  .a {
    color: white; 
    background-color: #54C880;
    text-align: center;
    padding: 16px 32px;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    font-family: 'Times New Roman', Times, serif;
    margin: 4px 2px;
    transition-duration: 0.4s;
    cursor: pointer;
    width:10%;
    height: auto;
    top:0;
    left:0;
  }

  .a:hover, .a:active {
    background-color: #7EC473;
  }

  label {
    font-family: 'Times New Roman', Times, serif;
    font-size: 20px;
    color: white;
  }
</style>
<!---------HTML--------->
<html>
  <h>
    <center>
      CS.NET Account Creation
    </center>
  </h>

  <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <center>
      <label for="fname">First name :</label><br>
      <input type="text" id="fname" name="fname" placeholder="First name..."><br>
      <span class="error"><?php echo $fnameErr; ?></span><br>
      
      <label for="lname">Last name :</label><br>
      <input type="text" id="lname" name="lname" placeholder="Last name..."><br>
      <span class="error"><?php echo $lnameErr; ?></span><br>
      
      <label for="uname">Username :</label><br>
      <input type="text" id="uname" name="uname" placeholder="Username..."><br>
      <span class="error"><?php echo $unameErr; ?></span><br>
    
      <label for="pwd">Password :</label><br>
      <input type="password" id="pwd" name="pwd" placeholder="Password..."><br>
      <span class="error"><?php echo $pwdErr; ?></span><br>
      
      <label for="age">Age :</label><br>
      <input type="text" id="age" name="age" placeholder="Age..."><br>
      <span class="error"><?php echo $ageErr; ?></span><br>

    <label for="interest">Interest :</label><br>
    <body>
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
      <input type="checkbox" id="int6" name="int6" value="Web Development">
      <label for="interest6"> Web Development</label><br>
      <span class="error"><?php echo $interErr; ?></span><br>
    
      <label for="city">Location :</label><br>
        <select name="city" id="city">
          <option value="">Select a city</option>
          <optgroup label="Southern California">
            <option value="San Diego">San Diego</option>
            <option value="Fullerton">Fullerton</option>
            <option value="Santa Ana">Santa Ana</option>
            <option value="Corona">Corona</option>
            <option value="Irvine">Irvine</option>
            <option value="Laguna Beach">Laguna Beach</option>
          </optgroup>
          <optgroup label="Central California">
            <option value="Fresno">Fresno</option>
            <option value="Santa Barbara">Santa Barbara</option>
            <option value="Stockton">Stockton</option>
          </optgroup>
          <optgroup label="Northern California">
            <option value="San Francisco">San Francisco</option>
            <option value="Santa Cruz">Santa Cruz</option>
            <option value="Napa">Napa</option>
          </optgroup>
          <optgroup label="Others">
            <option value="Out of State">Out-of-State</option>
          </optgroup>
        </select><br>
        <span class="error"><?php echo $cityErr; ?></span><br>

      <label for="Socials">Socials(Optional) :</label><br>
      <input type="text" id="socials" name="socials" placeholder="Linkedin..."><br>
      <span class="error"><?php echo $socErr; ?></span><br>

      <br><br>
      <button type="submit" class="a">Login</button>
    </center>
</form> 
</body>
</html>