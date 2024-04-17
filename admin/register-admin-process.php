<?php
require_once "../config.php";

if (isset($_POST["submit"])) {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["passwords"];

    // Perform any additional validation and sanitization of the form data

    // Prepare the insert statement
    $query = "INSERT INTO administrator (email, passwords)
              VALUES ('$email', '$password')";

    // Execute the insert statement
    if (mysqli_query($conn, $query)) {
        // Registration successful
        // You can redirect to a success page or display a success message
        echo "<script>
                setTimeout(function() {
                    alert('Registration successful!');
                    window.location.href = '/psm/admin/adminlogin.php';
                }, 1000);
              </script>";
    } else {
        // Error in executing the insert statement
        // Handle the error as per your requirement (e.g., display an error message)
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
