<?php
include('../config.php');

$currentDate = date('Y-m-d'); // Get the current date

// Update internships whose end dates have passed
$updateQuery = "UPDATE internship SET Status = 'Not Offering' WHERE EndDate < '$currentDate'";
mysqli_query($conn, $updateQuery);

if (isset($_POST['internshipID']) && isset($_POST['newStatus'])) {
    $internshipID = $_POST['internshipID'];
    $newStatus = $_POST['newStatus'];

    // Update the internship record with the new status
    $updateQuery = "UPDATE internship SET Status = '$newStatus' WHERE internshipID = '$internshipID'";
    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
