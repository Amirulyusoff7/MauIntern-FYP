<?php
require_once "../config.php";

if (isset($_POST["submit"])) {
    // Retrieve the form data
    $email = $_POST["email"];
    $password = $_POST["passwords"];
    $fullname = $_POST["fullname"];
    $phoneNum = $_POST["phoneNum"];
    $address = $_POST["address"];
    $programme = $_POST["programme"];
    $yearOfStudy = $_POST["YearOfStudy"];
    $cgpa = $_POST["CGPA"];

    // Perform validation for empty fields
    if (empty($email) || empty($password) || empty($fullname) || empty($phoneNum) || empty($address) || empty($programme) || empty($yearOfStudy) || empty($cgpa)) {
        echo "<script>
                alert('Please fill in all fields.');
                window.location.href = '/psm/student/signupstud.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate fullname to allow only letters (no numbers or symbols)
    if (!preg_match("/^[A-Za-z]+ $/", $fullname)) {
        echo "<script>
                alert('Fullname must contain only letters.');
                window.location.href = '/psm/student/signupstud.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate password to ensure it contains a mix of lowercase, uppercase, numbers, and special characters
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#\$%\^&\*\!])[A-Za-z\d@#\$%\^&\*\!]{8,}$/", $password)) {
        echo "<script>
                alert('Password must contain at least one lowercase letter, one uppercase letter, one number, one special character, and be at least 8 characters long.');
                window.location.href = '/psm/student/signupstud.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate phone number to allow only numeric characters and have a maximum length of 12 digits
    if (!preg_match("/^\d{1,12}$/", $phoneNum)) {
        echo "<script>
                alert('Phone number must contain only numeric characters and be at most 12 digits.');
                window.location.href = '/psm/student/signupstud.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Validate CGPA to ensure it is in a valid double format (e.g., 3.5 or 3.0)
    if (!preg_match("/^\d+(\.\d{1,2})?$/", $cgpa)) {
        echo "<script>
                alert('CGPA must be in a valid double format (e.g., 3.5 or 3.0).');
                window.location.href = '/psm/student/signupstud.php'; // Redirect back to registration page
              </script>";
        exit(); // Terminate the script
    }

    // Perform any additional validation and sanitization of the form data

    // Prepare the insert statement
    $query = "INSERT INTO student (email, passwords, fullname, phoneNum, `address`, programme, YearOfStudy, CGPA)
              VALUES ('$email', '$password', '$fullname', '$phoneNum', '$address', '$programme', '$yearOfStudy', '$cgpa')";

    // Execute the insert statement
    if (mysqli_query($conn, $query)) {
        // Registration successful
        // You can redirect to a success page or display a success message
        echo "<script>
                setTimeout(function() {
                    alert('Registration successful! Please Complete Your Profile and Skills Before Applying for Internships.');
                    window.location.href = '/psm/student/studentlogin.php';
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
