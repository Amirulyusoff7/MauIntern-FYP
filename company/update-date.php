<?php
session_start();
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['internshipID'], $_POST['fieldName'], $_POST['newDate'])) {
    $internshipID = $_POST['internshipID'];
    $fieldName = $_POST['fieldName']; // Should be either 'StartDate' or 'EndDate'
    $newDate = $_POST['newDate'];

    // Validate the field name to prevent SQL injection
    if ($fieldName !== 'StartDate' && $fieldName !== 'EndDate') {
        echo "Invalid field name.";
        exit();
    }

    // Update the date field for the specified internship
    $updateQuery = "UPDATE internship SET $fieldName = ? WHERE internshipID = ?";
    $statement = mysqli_prepare($conn, $updateQuery);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "si", $newDate, $internshipID);
        $result = mysqli_stmt_execute($statement);

        if ($result) {
            echo "Date updated successfully.";
        } else {
            echo "Error updating date: " . mysqli_error($conn);
        }

        mysqli_stmt_close($statement);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
