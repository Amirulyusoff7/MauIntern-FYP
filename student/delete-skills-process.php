<?php
//established a database connection
include('../config.php');

// Check if the skillID is set and not empty
if (isset($_POST['skillID']) && !empty($_POST['skillID'])) {
    // Retrieve the skillID from the form submission
    $skillID = $_POST['skillID'];

    // Construct the delete query
    $sql = "DELETE FROM skill WHERE skillID = '$skillID'";

    // Execute the delete query
    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        mysqli_close($conn);
        header("Location: /psm/student/studskill.php?success=1");
        exit();
    } else {
        // Deletion failed
        mysqli_close($conn);
        header("Location: /psm/student/studskill.php?error=1");
        exit();
    }
} else {
    // Redirect back to the skills page if skillID is not provided
    header("Location: /psm/student/studskill.php");
    exit();
}

?>