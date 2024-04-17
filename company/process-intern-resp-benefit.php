<?php
session_start();
include('../config.php');

if (isset($_POST['submit'])) {
    // Check if the form is submitted

    // Get the form data
    $internshipID = $_POST['internshipID'];
    $role = $_POST['Role'];
    $responsibilityDescription = $_POST['responsibility_description'];
    $skillRequired = $_POST['skill_required'];
    $requirementDescription = $_POST['req_description'];
    $benefitDuration = $_POST['b_duration'];
    $benefitAllowance = $_POST['b_allowance'];

    // TODO: Perform validation on the form data
 
    // Insert the responsibility data into the database using prepared statements
    $responsibilityQuery = "INSERT INTO responsibility (internshipID, Role, resp_description, skillRequired)
                            VALUES (?, ?, ?, ?)";

    $responsibilityStatement = mysqli_prepare($conn, $responsibilityQuery);
    mysqli_stmt_bind_param($responsibilityStatement, "isss", $internshipID, $role, $responsibilityDescription, $skillRequired);
    $responsibilityResult = mysqli_stmt_execute($responsibilityStatement);

    if ($responsibilityResult) {
        // Get the last inserted responsibilityID
        $responsibilityID = mysqli_insert_id($conn);

        // Insert the requirement data into the database using prepared statements
        $requirementQuery = "INSERT INTO requirement (internshipID, requirementID, req_description)
                             VALUES (?, ?, ?)";

        $requirementStatement = mysqli_prepare($conn, $requirementQuery);
        mysqli_stmt_bind_param($requirementStatement, "iss", $internshipID, $responsibilityID, $requirementDescription);
        $requirementResult = mysqli_stmt_execute($requirementStatement);

        // Insert the benefit data into the database using prepared statements
        $benefitQuery = "INSERT INTO benefit (internshipID, b_duration, b_allowance)
                         VALUES (?, ?, ?)";

        $benefitStatement = mysqli_prepare($conn, $benefitQuery);
        mysqli_stmt_bind_param($benefitStatement, "isd", $internshipID, $benefitDuration, $benefitAllowance);
        $benefitResult = mysqli_stmt_execute($benefitStatement);

        if ($requirementResult && $benefitResult) {
            // Data inserted successfully
            echo "Responsibility, requirement, and benefit data inserted successfully.";
            header("Location: ../company/view-intern.php?internID=" . $internshipID);
            exit();
        } else {
            // Failed to insert data
            echo "Error inserting data: " . mysqli_error($conn);
        }
    } else {
        // Failed to insert responsibility data
        echo "Error inserting responsibility data: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

?>
