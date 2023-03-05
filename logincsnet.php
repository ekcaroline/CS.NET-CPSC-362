<?php
session_start();
include "db_connection.php";

// Define the validate function
function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if username and password are set
if(isset($_POST['username']) && isset($_POST['password'])) {

    $id = validate($_POST['username']);
    $pass = validate($_POST['password']);

    // If fields are empty
    if(empty($id)){
        header("Location: logincsnet.php?error=Username cannot be empty");
        exit();
    } else if(empty($pass)){
        header("Location: logincsnet.php?error=password cannot be empty");
        exit();
    }

    // SQL Query
    $sql = "SELECT * FROM users WHERE username = '$id' AND password= '$pass'";

    $result = mysqli_query($conn, $sql);

    // Login Part
    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if($row['username'] === $id && $row['password'] === $pass) {
            echo "Logged In!";
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];   
            header("Location: userpage.php");
            exit();
        } else {
            header("Location: logincsnet.php?error=Incorrect Username or password");
        }
    } else {
        // Relocate to Index.php if nothing is put in
        header("Location: logincsnet.php");
        exit();
    }
}

// HTML Portion
?>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <title>
      Welcome back to CS.NET!
  </title>
  <body>
    <form method="post" action="logincsnet.php">
      <center>
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username" placeholder="Username..."><br>
      <label for="password">PIN:</label><br>
      <input type="password" id="password" name="password" placeholder="PIN..."><br>
      <button type="submit">Login</button>
      </center>
    </form>
  </body>
</html>
