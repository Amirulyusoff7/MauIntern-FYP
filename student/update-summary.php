<?php
session_start();

if (!isset($_SESSION['studentID'])) {
    header("Location: login.php");
    exit();
}

include('../config.php');

if (isset($_POST['submit-summary'])) {
    $studentID = $_SESSION['studentID'];
    $summary = mysqli_real_escape_string($conn, $_POST['summary']);
    
    // Update the student's summary in the database
    $updateQuery = "UPDATE student SET summary = '$summary' WHERE studentID = '$studentID'";
    $result = mysqli_query($conn, $updateQuery);
    
    if ($result) {
        // Redirect back to the profile page with a success message
        header("Location: studprofile.php?message=summary_updated");
        exit();
    } else {
        // Handle an error if the update fails
        header("Location: studprofile.php?message=error");
        exit();
    }
}
?>
