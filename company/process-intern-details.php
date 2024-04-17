<?php
session_start();
// If the form data is valid, proceed with database insertion
include('../config.php');

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $intern_title = $_POST['title'];
    $intern_description = mysqli_real_escape_string($conn, $_POST['intern_description']);
    $intern_StartDate = $_POST['StartDate'];
    $intern_EndDate = $_POST['EndDate'];
    $intern_Status = $_POST['Status'];
    $companyID = $_SESSION['companyID'];

    
    
    // Prepare the insert statement
    $query = "INSERT INTO internship (title, intern_description, StartDate, EndDate, `Status`, companyID)
              VALUES ('$intern_title', '$intern_description', '$intern_StartDate', '$intern_EndDate', '$intern_Status', '$companyID')";

    // Execute the insert statement
    if (mysqli_query($conn, $query)) {
        // Internship inserted successfully
        // Redirect back to the profile page or display a success message
        mysqli_close($conn);
        echo "<script>alert('Data inserted successfully!');</script>";
        header("Location: intern-list.php");
        exit();
    } else {
        // Error in executing the insert statement
        // Handle the error as per your requirement (e.g., display an error message)
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}

?>
 