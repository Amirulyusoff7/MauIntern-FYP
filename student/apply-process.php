<?php
session_start(); // Start the session
include('../config.php'); // Include the database connection file

// Check if the student is logged in
if (!isset($_SESSION['studentID'])) {
    // If the student is not logged in, redirect to the login page or display an error message
    header("Location: studentlogin.php");
    exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $internshipID = $_POST['internshipID'];
    $studentID = $_SESSION['studentID']; // Get the student ID from the session
    $dateApplied = date('Y-m-d'); // Get the current date
    $status = '1';

    // Check if the student has already applied for this internship
    $checkQuery = "SELECT * FROM application WHERE studentID = '$studentID' AND internshipID = '$internshipID'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Student has already applied
        echo "<script>
                setTimeout(function() {
                    alert('You have already applied for this internship.');
                    window.location.href = '../student/apply-intern.php?internshipID=$internshipID';
                }, 500);
              </script>";
        exit();
    } else {
        // Student has not applied yet, insert the application
        $insertQuery = "INSERT INTO application (studentID, internshipID, DateApplied, Status)
                      VALUES ('$studentID', '$internshipID', '$dateApplied', '$status')";

        // Execute the insert statement
        if (mysqli_query($conn, $insertQuery)) {
            // Application inserted successfully
            echo "<script>
                    setTimeout(function() {
                        alert('Internship Applied Successfully');
                        window.location.href = '../student/apply-intern.php?internshipID=$internshipID';
                    }, 500);
                  </script>";
            exit();
        } else {
            // If the application insertion fails, display an error message or handle the error appropriately
            echo "Error: " . mysqli_error($conn);
        }
    }
} else {
    // If the form is not submitted, redirect back to the previous page or display an error message
    header("Location: apply-intern.php");
    exit();
}
?>
