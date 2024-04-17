<?php
session_start();
include('../config.php');

if (isset($_POST['applicationID']) && isset($_POST['newStatus'])) {
    $applicationID = $_POST['applicationID'];
    $newStatus = $_POST['newStatus'];

    // Update the status in the database
    $updateQuery = "UPDATE application SET Status = '$newStatus' WHERE applicationID = '$applicationID'";
    
    if (mysqli_query($conn, $updateQuery)) {
        // Status updated successfully
        $response = array('message' => 'Status updated successfully');
    } else {
        // Error updating status
        $response = array('message' => 'Error updating status: ' . mysqli_error($conn));
    }
} else {
    // Invalid parameters
    $response = array('message' => 'Invalid parameters');
}

// Send the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
