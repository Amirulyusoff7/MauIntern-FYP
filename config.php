<?php

    //connect to database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "psm";

    //create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //check connection
    // if(mysqli_connect_errno()) {
    //     echo "Failed to connect to MySQL: " . mysqli_connect_error();
    // }

    // //sanitize user input
    // $email = mysqli_real_escape_string($conn, $_POST['email']);
    // $password = mysqli_real_escape_string($conn, $_POST['password']);
    // $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    // $phoneNum = mysqli_real_escape_string($conn, $_POST['phoneNum']);
    // $programme = mysqli_real_escape_string($conn, $_POST['programme']);
    // $yearOfStudy = mysqli_real_escape_string($conn, $_POST['YearOfStudy']);
    // $gpa = mysqli_real_escape_string($conn, $_POST['GPA']);

    // //check if email already exists
    // $email_query = "SELECT * FROM student WHERE email='$email'";
    // $result = mysqli_query($conn, $email_query);
    // if(mysqli_num_rows($result) > 0) {
    //     echo "Email already exists!";
    // } else {
    //     //insert data into database
    //     $insert_query = "INSERT INTO student (email, password, fullname, phoneNum, programme, yearOfStudy, gpa) VALUES ('$email', '$password', '$fullname', '$phoneNum', '$programme', '$yearOfStudy', '$gpa')";
    //     if(mysqli_query($conn, $insert_query)) {
    //         echo "Registration successful!";
    //     } else {
    //         echo "Error: " . mysqli_error($conn);
    //     }
    // }

    //close connection
    //mysqli_close($conn);

?>
