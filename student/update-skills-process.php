<?php
//established a database connection
include('../config.php');


if (isset($_POST['submit'])) {
    $skillID = $_POST['skillID'];
    $updateSkillName = $_POST['update_skill_name'];
    $updateSkillDescription = $_POST['update_skill_description'];
    $updateSkillLevel = $_POST['update_skill_level'];

    // Update the skill in the database
    $query = "UPDATE skill SET skill_name = '$updateSkillName', skill_description = '$updateSkillDescription', skill_level = '$updateSkillLevel' WHERE skillID = '$skillID'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Skill updated successfully
        // Redirect or display a success message
        header("Location: /psm/student/studskill.php");
        exit();
    } else {
        // Error updating the skill
        // Redirect or display an error message
        echo "Error updating skill: " . mysqli_error($connection);
        exit();
    }
}

// If the form was not submitted or the submit button was not set,
// redirect the user or display an error message
header("Location: /psm/student/skill-information.php");
exit();
?>
