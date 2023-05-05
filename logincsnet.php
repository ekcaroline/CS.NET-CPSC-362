<?php
session_start();
include "db_connection.php";

$UnameErr = $PassErr = "";

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
        $UnameErr = "Username cannot be empty";
    } else if(empty($pass)){
        $PassErr = "Password cannot be empty";
    } else {
        // SQL Query
        $sql = "SELECT * FROM users WHERE username = '$id' AND password= '$pass'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['username'] === $id && $row['password'] === $pass) {
                echo "Logged In!";
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                if(isset($row['id'])) {
                  $_SESSION['user_id'] = $row['id'];
              }
                header("Location: userpage.php");
                exit;
            } else {
                echo "Incorrect Username or password";
            }
        } else {
            echo "Incorrect Username or password";
        }
    }
}
?>

<style>
body {
    background-image: linear-gradient(to top,teal 0%, #0E9A50 100%);
}
  label {
    font-family: 'Times New Roman', Times, serif;
    font-size: 20px;
    color: white;
  }
  h {
    color:#BFEDAB;
    padding: 16px 32px;
    font-size: 30px;
    font-family: courier 'Courier New', Courier, monospace;
  }
  input[type=login] {
  text-align: center;
  width: 20%;
  background-color: #8BED7C;
  color: white;
  padding: 16px 32px;
  margin: 4px 2px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  border: 2px solid #8BED7C;
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
    border: 2px solid #000000;
  }

  .a:hover, .a:active {
    background-color: #7EC473;
  }
</style>

<!DOCTYPE html>
<html>
  <h>
    <center>
    Welcome back to CS.NET!
    </center>
  </h>
  <body>
    <form method="post" action="logincsnet.php">
      <center>
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username" placeholder="Username..."><br>
      <label for="password">PIN:</label><br>
      <input type="password" id="password" name="password" placeholder="PIN..."><br>
      <button type="submit" class="a">Login</button>
      <a href="profilecreation.php" class="a">Signup</a>
      </center>
    </form>
  </body>
</html>
