<?php
// Establish connection to the database
  include('../config.php');

// Get the email from the Ajax request
$emailCompany = $_POST['email'];
$PICemail = $_POST['email'];

// Prepare the SQL statement for Email Company
$stmt = $conn->prepare("SELECT * FROM company WHERE emailCompany = ?");
$stmt->bind_param("s", $emailCompany);
$stmt->execute();

$result = $stmt->get_result();


// Prepare the SQL statement for PICemail
$stmtPIC = $conn->prepare("SELECT * FROM company WHERE PICemail = ?");
$stmtPIC->bind_param("s", $PICemail);

// Execute the query for PICemail
$stmtPIC->execute();

// Fetch the result for PICemail
$resultPIC = $stmtPIC->get_result();

// Check if either email exists
if ($result->num_rows > 0 || $resultPIC->num_rows > 0) {
  echo "<span class='error'>Email already exists</span>";
} else {
  echo "<span class='success'>Email is available</span>";
}

// if ($result->num_rows > 0) {
//   echo '<span class="error">Email already exists</span>';
// } else {
//   echo '<span class="success">Email is available</span>';
// }


$stmt->close();
$stmtPIC->close();
$conn->close();
?>

