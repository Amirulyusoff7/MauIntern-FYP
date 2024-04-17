<?php
session_start();

include('../config.php');

if (isset($_POST['submit'])) {
    $companyID = $_SESSION['companyID'];
    $companyName = $_POST['update_company_name'];
    $emailCompany = $_POST['update_emailCompany'];
    $website = $_POST['update_website'];
    $custServiceNum = $_POST['update_custServiceNum'];
    $address = $_POST['update_address'];
    $industry = $_POST['update_industry'];

    // Update company details
    $updateCompanyQuery = "UPDATE company SET 
                            company_name = '$companyName',
                            emailCompany = '$emailCompany',
                            website = '$website',
                            custServiceNum = '$custServiceNum',
                            address = '$address',
                            industry = '$industry'
                            WHERE companyID = '$companyID'";

    $resultCompany = mysqli_query($conn, $updateCompanyQuery);

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