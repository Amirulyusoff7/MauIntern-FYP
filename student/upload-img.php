<?php
session_start();

include('../config.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Check if a file is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Retrieve the temporary file path
        $tmpFilePath = $_FILES['image']['tmp_name'];

        // Read the contents of the file
        $imageData = file_get_contents($tmpFilePath);

        // Encode the image data as a Base64 string
        $base64Image = base64_encode($imageData);

        // Retrieve the student ID from the session
        $studentID = $_SESSION['studentID'];

        // Prepare and execute the query to update the profile image
        $query = "UPDATE student SET image = '$base64Image' WHERE studentID = '$studentID'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Image upload and update successful
            echo "<script>
            setTimeout(function() {
                alert('Profile Picture Successfully Uploaded');
                window.location.href = '../student/studprofile.php';
            }, 500);
          </script>";
            exit();

        } else {
            // Image upload and update failed
            echo "Error uploading profile image: " . mysqli_error($conn);
        }
    } else {
        // No file selected or error in file upload
        echo "Please select a valid image file.";
    }
} else {
    // Form was not submitted
    echo "Invalid request.";
}
?>
