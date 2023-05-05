<?php
session_start();
include('db_connection.php');

// Get the friend's ID from the form submission
$friend_id = $_POST['friend_id'];

// Get the user_id values for the current user and the friend they are trying to add
$stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR id = ?");
$stmt->bind_param("si", $_SESSION['username'], $friend_id);
$stmt->execute();
$result = $stmt->get_result();
$user_ids = array();
while ($row = $result->fetch_assoc()) {
  $user_ids[] = $row['id'];
}

// Insert the friend request into the database
$stmt = $conn->prepare("INSERT INTO friendships (user1_id, friend_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_ids[0], $user_ids[1]);
$stmt->execute();
$stmt->close();


// Redirect the user back to the friends page
header('Location: userpage.php');
exit();
?>

