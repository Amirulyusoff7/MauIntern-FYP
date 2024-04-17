<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['internshipID'], $_POST['newStatus'])) {
    $internshipID = $_POST['internshipID'];
    $newStatus = $_POST['newStatus'];

    // Check if the new status is "Offering"
    if ($newStatus === 'Offering') {
        // Add a condition to update the status based on the EndDate
        $currentDate = date('Y-m-d');
        $updateQuery = "
            UPDATE internship
            SET Status = CASE
                WHEN EndDate < '$currentDate' THEN 'Not Offering'
                ELSE 'Offering'
            END
            WHERE internshipID = '$internshipID'
        ";

        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        // If the new status is not "Offering," update it directly
        $updateQuery = "UPDATE internship SET Status = '$newStatus' WHERE internshipID = '$internshipID'";
        $result = mysqli_query($conn, $updateQuery);

        if ($result) {
            echo "Status updated successfully.";
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    }
}


?>

