<?php
session_start();
include "users.php"

// Validate data entered
if(isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

// If fields are empty %%%%Fill in #filename
if(empty($uname)){
    header("Location: #filename?erro=Username cannot be empty");
    exit();
}else if(empty($pass)){
    header("Location: #filename?erro=Password cannot be empty");
    exit();
}

// SQL Query
$sql = "SELECT * FROM users WHERE username = '$uname' AND password= '$pass'";

$result = mysqli_query($conn, $sql);

if(mysql_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['username'] === $uname && $row['password'] === $pass){
        echo "Logged In!";
        $_SESSION['username'] = $row['username'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];   
        header("Location: home")
        exit();
    }else{
        header("Location: index.php?erro=Incorrect Username or Password")
    }
}
else{
    header("Location: index.php");
    exit();
}