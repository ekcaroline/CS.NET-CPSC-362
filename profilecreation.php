<?php
session_start();
include "db_connection.php";

// Define variables and set to empty values
$fname = $lname = $uname = $pwd = $age = "";
$fnameErr = $lnameErr = $unameErr = $pwdErr = $ageErr = "";

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
    if (!preg_match("/^[1-9][0-9]{1}$/",$age)) {
      $ageErr = "Age must be a number between 18 and 99";
    }
  }

  // If there are no errors, insert user information into database using prepared statement
  if (empty($fnameErr) && empty($lnameErr) && empty($unameErr) && empty($pwdErr) && empty($ageErr)) {
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, username, password, age) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $fname, $lname, $uname, $pwd, $age); // Bind parameters to placeholders

    if ($stmt->execute()) { // Execute the prepared statement
      $_SESSION['username'] = $uname;
      $stmt->close();
      mysqli_close($conn);
      header("Location: welcomepage.php");
      exit();
    }
  }
}
?>


<html>
  <head> 
    <link rel="stylesheet" href="style.css">
  </head>
    <title> 
      <center>
         CS.NET Account Creation
      </center>
      </title>
<body>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <center>
      <label for="fname">First name:</label><br>
      <input type="text" id="fname" name="fname" placeholder="First name..."><br>
      <span class="error"><?php echo $fnameErr; ?></span><br>
      
      <label for="lname">Last name:</label><br>
      <input type="text" id="lname" name="lname" placeholder="Last name..."><br>
      <span class="error"><?php echo $lnameErr; ?></span><br>
      
      <label for="uname">Username:</label><br>
      <input type="text" id="uname" name="uname" placeholder="Username..."><br>
      <span class="error"><?php echo $unameErr; ?></span><br>
    
      <label for="pwd">Password:</label><br>
      <input type="password" id="pwd" name="pwd" placeholder="Password..."><br>
      <span class="error"><?php echo $pwdErr; ?></span><br>
      
      <label for="age">Age:</label><br>
      <input type="text" id="age" name="age" placeholder="Age..."><br>
      <span class="error"><?php echo $ageErr; ?></span><br>
      <button type="submit">Submit</button>
    </center>
</form> 
</body>
</html>