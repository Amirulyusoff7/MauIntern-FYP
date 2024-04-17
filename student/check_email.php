<?php
// Establish connection to the database
include('../config.php');

// Get the email from the Ajax request
$email = $_POST['email'];

// Prepare the SQL statement
$stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo '<span class="error">Email already exists</span>';
} else {
  echo '<span class="success">Email is available</span>';
}


$stmt->close();
$conn->close();
?>

