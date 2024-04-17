<?php
require_once "../config.php";
 
if (isset($_POST["submit"])) {
    // Retrieve the form data
    $compName = $_POST["company_name"];
    $emailCompany = $_POST["emailCompany"];
    $custServiceNum = $_POST["custServiceNum"];
    $address = $_POST["address"];
    $industry = $_POST["industry"];
    $website = $_POST["website"];
    $PICName = $_POST["PICName"];
    $PICphoneNum = $_POST["PICphoneNum"];
    $PICemail = $_POST["PICemail"];
    $PICpassword = $_POST["PICpassword"];

    // Validate custServiceNum to allow only numeric characters
    if (!preg_match("/^\d+$/", $custServiceNum)) {
        echo "<script>
                alert('Company Customer Service Number must contain only numeric characters.');
                window.location.href = '/psm/company/compsignup.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate PICphoneNum to allow only numeric characters
    if (!preg_match("/^\d+$/", $PICphoneNum)) {
        echo "<script>
                alert('PIC Phone Number must contain only numeric characters.');
                window.location.href = '/psm/company/compsignup.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate PICpassword to ensure it meets the requirements
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#\$%\^&\*\!])[A-Za-z\d@#\$%\^&\*\!]{8,}$/", $PICpassword)) {
        echo "<script>
                alert('PIC Password must contain at least one lowercase letter, one uppercase letter, one number, one special character, and be at least 8 characters long.');
                window.location.href = '/psm/company/compsignup.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Prepare the insert statement for the company table
    $companyQuery = "INSERT INTO company (company_name, emailCompany, custServiceNum, `address`, industry, website, PICName, PICphoneNum, PICemail, PICpassword)
    VALUES ('$compName', '$emailCompany', '$custServiceNum', '$address', '$industry', '$website', '$PICName', '$PICphoneNum', '$PICemail', '$PICpassword')";

    // Execute the insert statement for the company table
    if (mysqli_query($conn, $companyQuery)) {
        $companyID = mysqli_insert_id($conn);

        // Prepare the insert statement for the companystatus table
        $statusQuery = "INSERT INTO companystatus ( adminID, companyID, status_Company, reason_block) VALUES ('1','$companyID', 'Active', '')";

        // Execute the insert statement for the companystatus table
        if (mysqli_query($conn, $statusQuery)) {
            // Registration successful
            // Display a success message using JavaScript
            echo "<script>
                    alert('Registration successful!');
                    window.location.href = '/psm/company/piclogin.php';
                </script>";
        } else {
            // Error in executing the insert statement for the companystatus table
            // Handle the error as per your requirement (e.g., display an error message)
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Error in executing the insert statement for the company table
        // Handle the error as per your requirement (e.g., display an error message)
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
