<?php
session_start();

include('../config.php');

if (isset($_POST['submit'])) {
    $companyID = $_SESSION['companyID'];
    $picName = $_POST['update_PICName'];
    $picPhoneNum = $_POST['update_PICphoneNum'];
    $picEmail = $_POST['update_PICemail'];
    // Update PIC details
    $updatePICQuery = "UPDATE company SET 
                        PICName = '$picName',
                        PICphoneNum = '$picPhoneNum',
                        PICemail = '$picEmail'
                        WHERE companyID = '$companyID'";

    $resultPIC = mysqli_query($conn, $updatePICQuery);

    if ($resultPIC) {
        // updated successfully
        // Redirect or display a success message
        header("Location: company-profile.php");
        exit();
    } else {
        // Error updating
        // Redirect or display an error message
        echo "Error updating skill: " . mysqli_error($connection);
        exit();
    }
}
