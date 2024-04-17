<?php
  include('../config.php'); // Include the database connection file
// Check if the form data is set
if (isset($_POST['submit'])) {
    // Retrieve form data
    $internshipID = mysqli_real_escape_string($conn, $_POST['internshipID']);
    $b_duration = mysqli_real_escape_string($conn, $_POST['b_duration']);
    $b_allowance = mysqli_real_escape_string($conn, $_POST['b_allowance']);

    // Update the responsibility record
    $query = "UPDATE benefit SET b_duration = '$b_duration', b_allowance = '$b_allowance' WHERE internshipID = '$internshipID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Responsibility updated successfully
        // You can perform additional actions or redirect the user to a success page
        // Example: Redirecting the user to the internship details page
        header("Location: /psm/company/view-intern.php?internID=" . $internshipID);
        exit();
    } else {
        // Error occurred while updating the responsibility
        // You can handle the error accordingly (e.g., display an error message)
        echo "Error updating responsibility: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request, redirect the user to an error page or homepage
    // Failed to insert responsibility data
    echo "Error inserting responsibility data: " . mysqli_error($conn);
}

?>
