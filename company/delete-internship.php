<?php
// Check if the internshipID is provided via POST
if (isset($_POST['internshipID'])) {
    // Sanitize the input to prevent SQL injection
    $internshipID = intval($_POST['internshipID']);

    // Include your database connection configuration
    include('../config.php');

    // Prepare a DELETE statement
    $sql = "DELETE FROM internship WHERE internshipID = ?";

    // Use prepared statements to prevent SQL injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $internshipID);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // The internship record was successfully deleted
            echo "Internship deleted successfully!";
            header("Location: dashboard.php");
            // echo "<script>
            //     setTimeout(function() {
            //         alert('Internship deleted successfully!');
            //         window.location.href = '/psm/company/dashboard.php';
            //     }, 500);
            //   </script>";
        } else {
            // Error occurred while executing the statement
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing the statement
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // InternshipID not provided via POST
    echo "InternshipID not provided.";
}
?>
