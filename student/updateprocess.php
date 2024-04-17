<?php
session_start();
//established a database connection
include('../config.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve the form data
    $studentId = 3;
    // $studentId = $_SESSION['student-email'];
    $fullname = $_POST['fullname'];
    $phoneNum = $_POST['phoneNum'];
    $email = $_POST['email'];
    $programme = $_POST['programme'];
    $YearOfStudy = $_POST['YearOfStudy'];
    $CGPA = $_POST['CGPA'];

    // Validate the form data
    $errors = [];

    // Validate full name
    if (empty($fullname)) {
        $errors[] = "Full name is required.";
    }

    // Validate phone number
    if (empty($phoneNum)) {
        $errors[] = "Phone number is required.";
    } elseif (!preg_match('/^[0-9]{10}$/', $phoneNum)) {
        $errors[] = "Phone number must be a valid 10-digit number.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email address.";
    }

    // Validate programme
    $validProgrammes = ['BITD', 'BITI', 'BITZ', 'BITM', 'BITS'];
    if (empty($programme) || !in_array($programme, $validProgrammes)) {
        $errors[] = "Invalid programme selected.";
    }

    // Validate year of study
    $validYearsOfStudy = ['Year 1', 'Year 2', 'Year 3', 'Year 4'];
    if (empty($YearOfStudy) || !in_array($YearOfStudy, $validYearsOfStudy)) {
        $errors[] = "Invalid year of study selected.";
    }

    // Validate CGPA
    if (empty($CGPA)) {
        $errors[] = "CGPA is required.";
    } elseif (!is_numeric($CGPA) || $CGPA < 0 || $CGPA > 4) {
        $errors[] = "CGPA must be a number between 0 and 4.";
    }

    // Check if there are any validation errors
    if (!empty($errors)) {
        // Display the errors to the user
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit();
    }

    // Update the student details in the database
    $updateQuery = "UPDATE student SET fullname = '$fullname', phoneNum = '$phoneNum', email = '$email', programme = '$programme', YearOfStudy = '$YearOfStudy', CGPA = '$CGPA' WHERE studentID = '$studentId'";

    // Execute the update query
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect to the profile page after the update
        header('Location: ../student/studprofile.php');
        echo $updateQuery;
        exit();
    } else {
        echo "Error updating student details: " . mysqli_error($conn);
        exit();
    }
}

// Close the database connection
mysqli_close($conn);
?>
