<?php

session_start();

include('./config.php'); // Include the database connection file

// $query = "SELECT i.title AS title, i.intern_description AS description, i.Status AS Status, 
// c.company_name AS CompanyName, c.address AS Address, c.industry AS Industry
// FROM internship i 
// INNER JOIN company c ON i.companyID = c.companyID
// WHERE i.Status = 'Offering'
// ORDER BY i.internshipID DESC;";

// $result = mysqli_query($conn, $query);
// $internships = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">

    <style>
        .intern-apply {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, 2fr) 1fr;
            grid-column-gap: 50px;
            grid-row-gap: 5px;
            padding-top: 20px;
        }

        .intern-info {
            grid-area: 1 / 2 / 2 / 3;
            border-style: solid;
        }

    </style>

</head>
<title>Internship Application</title>

<body>
    <?php
    // require_once "./navbar/header.php";
    // require_once "../navbar/student-header.php";
    require_once "./navbar/sidebar.php";
    // require_once "../navbar/index-header.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <?php
    if (isset($_GET['internshipID'])) {
        // Get the internID from the URL parameter
        $internship = $_GET['internshipID'];

        // Example: Fetching additional information from a database
        // include('../config.php'); // Include the database connection file

        $query = "SELECT *
                  FROM internship i
                  JOIN responsibility r ON i.internshipID = r.internshipID
                  JOIN benefit b ON i.internshipID = b.internshipID
                  JOIN requirement req ON i.internshipID = req.internshipID
                  WHERE i.internshipID = $internship";

        $result = mysqli_query($conn, $query);
        $internship = mysqli_fetch_assoc($result);

        // Display the additional information or ask the user to insert data
        if ($internship) {
        echo '<div class="intern-apply">';
        echo '<div class="intern-info">';
            echo '<div class="container" style="padding: 10px">';
            echo '<h2>Internship Information</h2>';
            echo '<div class="internship-details">';
            echo '<p><strong>Title:</strong> ' . $internship['title'] . '</p>';
            echo '<p><strong>Internship Description:</strong> ' . $internship['intern_description'] . '</p>';
            echo '<p><strong>Start Date:</strong> ' . $internship['StartDate'] . '</p>';
            echo '<p><strong>End Date:</strong> ' . $internship['EndDate'] . '</p>';
            echo '<p><strong>Status:</strong> ' . $internship['Status'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<br>';

            echo '<div class="container" id="intern-info">';
            echo '<h2>Responsibility Information</h2>';
            echo '<div class="responsibility-details">';
            echo '<p><strong>Role:</strong> ' . $internship['Role'] . '</p>';
            echo '<p><strong>Responsibility Description:</strong> ' . $internship['resp_description'] . '</p>';
            echo '<p><strong>Skill Required:</strong> ' . $internship['skillRequired'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<br>';

            echo '<div class="container" id="intern-info">';
            echo '<h2>Requirement Information</h2>';
            echo '<div class="requirement-details">';
            echo '<p><strong>Requirement Description:</strong> ' . $internship['req_description'] . '</p>';
            echo '</div>';
            echo '</div>';
            echo '<br>';

            echo '<div class="container" id="intern-info">';
            echo '<h2>Benefit Information</h2>';
            echo '<div class="benefit-details">';
            echo '<p><strong>Internship Duration:</strong> ' . $internship['b_duration'] . '</p>';
            echo '<p><strong>Allowance:</strong> ' . $internship['b_allowance'] . '</p>';

            // Button Apply
            echo '<div class="text-right" style="margin: 10px">';
            echo '<form action="./student/apply-process.php" method="POST">';
            echo '<input type="hidden" name="internshipID" value="' . $internship['internshipID'] . '">';
            echo '<button type="submit" name="submit" class="btn btn-primary btn-lg">Apply</button>';
            echo '</form>';
            echo '</div>';


        echo '</div>';
        echo '</div>';
        }
    } else {
        echo "Invalid internship ID.";
    }
    ?>

</body>

</html>
