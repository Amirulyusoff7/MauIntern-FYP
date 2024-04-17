<?php
// Check if the form data is set
if (isset($_POST['submit'])) {
    // Retrieve form data
    $internshipID = $_POST['internshipID'];
    $req_desc = $_POST['req_description'];

    // TODO: Update the responsibility in the database
    // You can perform the necessary database update operation here
    // Make sure to use prepared statements or sanitize the input to prevent SQL injection

    // Example: Updating the responsibility in the database
    include('../config.php'); // Include the database connection file

    // Update the responsibility record
    $query = "UPDATE requirement SET req_description = '$req_desc' WHERE internshipID = '$internshipID'";
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
        echo "Error updating requirement: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request, redirect the user to an error page or homepage
// Failed to insert responsibility data
echo "Error inserting responsibility data: " . mysqli_error($conn);
}
?>
