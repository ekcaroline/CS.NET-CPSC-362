<?php
session_start();
include "db_connection.php";

// Initialize variables
$fnameErr = $lnameErr = $unameErr = $pwdErr = $ageErr = $interErr = $cityErr = $socErr = "";
$interests = array("Software Engineering", "Game Development", "Cybersecurity", "Systems and Networking", "Artificial Intelligence", "Web Development");
$selected_interests = array();
  
// Get current user information from database
  if(isset($_SESSION['username'])){
    $stmt = $conn->prepare("SELECT first_name, last_name, age, city, socials, username FROM users WHERE username = ?");
    $user_id = $_SESSION['username'];
    $stmt->bind_param("i", $user_id); // bind the parameter $user_id
    $stmt->execute();
    $stmt->bind_result($original_fname, $original_lname, $original_age, $original_city, $original_socials, $original_uname);
    $stmt->fetch();
    $stmt->close();
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if first name is being updated
  if (isset($_POST["fname"])) {
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
  } else {
    $fname = $original_fname;
  }
  
  // Check if last name is being updated
  if (isset($_POST["lname"])) {
    // Validate last name
    if (empty($_POST["lname"])) {
      $lnameErr = "Last name is required";
    } else {
      $lname = htmlspecialchars(trim($_POST["lname"]));
      // Check if last name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
        $lnameErr = "Last name is required";
      }
    }
  } else {
    $lname = $original_lname;
  }
  

  // Check if age is being updated
  if (isset($_POST["age"])) {
    // Validate age
    if (empty($_POST["age"])) {
      $ageErr = "Only letters and white space allowed for city name";
    } else {
        $age = htmlspecialchars(trim($_POST["age"]));
        // Check if age is a number between 18 and 99
        if (!preg_match("/^(1[8-9]|[2-9][0-9])$/",$age)) {
          $ageErr = "Age must be a number between 18 and 99";
        }
    }
  } else {
    $age = $original_age;
  }

  // Check if interest is being updated
  // Check if at least one interest is selected
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


  // Check if city is being updated
  if (isset($_POST["city"])) {
      // Validate City
      if (empty($_POST["city"])) {
        $cityErr = "City is required";
      } else {
          $city = htmlspecialchars(trim($_POST["city"]));
          // Check if city only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/", $city)) {
              $cityErr = "Only letters and white space allowed for city name";
          }
      }
  }

  // Check if socials is being updated or if it's empty
if (isset($_POST["socials"])) {
  if ($_POST["socials"] === '') {
      // Socials field is empty, so keep the original value
      $socials = $original_socials;
  } else if ($_POST["socials"] !== $original_socials) {
      // Socials is being updated, so validate the URL
      $url = trim($_POST['socials']);
      if (filter_var($url, FILTER_VALIDATE_URL)) {
          $socials = $url;
      } else {
          $socErr = "Invalid URL";
      }
  } else {
      // Socials is not being updated, so keep the original value
      $socials = $original_socials;
  }
} else {
  // Socials is not being updated, so keep the original value
  $socials = $original_socials;
}
  // Check if an image file was uploaded
  if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {

    // Open the image file and read its contents
    $image_file = $_FILES['image_file']['tmp_name'];
    $image_data = file_get_contents($image_file);

    // Prepare an SQL statement to update the user information and image data in the database
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, age = ?, interest = ?, city = ?, socials = ?, pfp = ? WHERE username = ?");
    $selected_interest = implode(", ", $selected_interests);
    $stmt->bind_param("ssisssss", $fname, $lname, $age, $selected_interest, $city, $socials, $image_data, $_SESSION['username']);
    $stmt->send_long_data(6, $image_data); // Send the image data as a BLOB
    $stmt->execute();
    $stmt->close();
  } else {
    // Prepare an SQL statement to update the user information (without image data) in the database
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, age = ?, interest = ?, city = ?, socials = ? WHERE username = ?");
    $selected_interest = implode(", ", $selected_interests);
    $stmt->bind_param("ssissss", $fname, $lname, $age, $selected_interest, $city, $socials, $_SESSION['username']);
    $stmt->execute();
    $stmt->close();
  }
  header("Location: userpage.php");
  exit();
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
      CS.NET Edit Account
    </center>
    <center>
    <label for="fname">Please fill out all the parts</label>
    </center>
  </h>

  <body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
      <center>
      <input type="file" name="image_file"><br>

      <label for="fname">First name :</label><br>
      <input type="text" id="fname" name="fname" placeholder="First name..."><br>
      <span class="error"><?php echo $fnameErr; ?></span><br>
      
      <label for="lname">Last name :</label><br>
      <input type="text" id="lname" name="lname" placeholder="Last name..."><br>
      <span class="error"><?php echo $lnameErr; ?></span><br>
      
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

      <label for="Socials">Socials :</label><br>
      <input type="text" id="socials" name="socials" placeholder="Linkedin..."><br>
      <span class="error"><?php echo $socErr; ?></span><br>

      <br><br>
      <button type="submit" class="a">Update</button>
      <button type="button" class="a" onclick="window.location.href='userpage.php'">Cancel</button>
    </center>
</form> 
</body>
</html>
