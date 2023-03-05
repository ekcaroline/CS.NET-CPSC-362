<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn) {
    echo "Connection successful";
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    echo "Connection Failed";
}
?>
