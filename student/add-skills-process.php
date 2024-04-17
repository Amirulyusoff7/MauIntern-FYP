<?php
session_start();

if (isset($_POST['submit'])) {
    // Retrieve the form data
    $skillName = $_POST['skill_name'];
    $description = $_POST['skill_description'];
    $skillLevel = $_POST['skill_level'];
    $studentId = $_SESSION['studentID'];

    // If the form data is valid, proceed with database insertion
    include('../config.php');
    
    // Check if the skill already exists for the student
    $checkQuery = "SELECT * FROM skill WHERE studentID = '$studentId' AND skill_name = '$skillName'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // Skill already exists for the student
        // Handle the error (e.g., display an error message)
        // echo "Error: Skill already exists for the student";
        echo "<script>
        setTimeout(function() {
            alert('Error: Skill already exists for the student');
            window.location.href = 'studskill.php';
        }, 1000);
      </script>";
        // header("Location: studskill.php");
        exit();
    } else {
        // Prepare the insert statement
        $query = "INSERT INTO skill (studentID, skill_name, skill_description, skill_level)
                  VALUES ('$studentId', '$skillName', '$description', '$skillLevel')";

        // Execute the insert statement
        if (mysqli_query($conn, $query)) {
            // Skill inserted successfully
            // Redirect back to the profile page or display a success message
            header("Location: studskill.php");
            exit();
        } else {
            // Error in executing the insert statement
            // Handle the error as per your requirement (e.g., display an error message)
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
