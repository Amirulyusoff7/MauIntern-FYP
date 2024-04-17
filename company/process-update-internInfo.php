<?php
// Check if the form data is set
if (isset($_POST['submit'])) {
    // Retrieve form data
    $internshipID = $_POST['internshipID'];
    $title = $_POST['title'];
    $internDescription = $_POST['intern_description'];
    $EndDate = $_POST['EndDate'];

    include('../config.php'); // Include the database connection file

    // Update the responsibility record
    $query = "UPDATE internship SET title = '$title', intern_description = '$internDescription', EndDate = '$EndDate' WHERE internshipID = '$internshipID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // internship Information updated successfully
        // You can perform additional actions or redirect the user to a success page
        header("Location: /psm/company/view-intern.php?internID=" . $internshipID);
        exit();
    } else {
        // Error occurred while updating the internship Information
        // You can handle the error accordingly (e.g., display an error message)
        echo "Error updating internship Information: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Invalid request, redirect the user to an error page or homepage
// Failed to insert internship Information data
echo "Error inserting internship Information data: " . mysqli_error($conn);
}
?>
