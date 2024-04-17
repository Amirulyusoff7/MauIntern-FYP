<?php
session_start();

include('../config.php');
// Retrieve student table from the database

// $query = "SELECT s.*, sk.* FROM student s
//           JOIN skill sk ON s.studentID = sk.studentID
//           WHERE s.studentID = '{$_SESSION['studentID']}'";

$query = "SELECT c.*, i.* FROM company c
          JOIN internship i ON c.companyID = i.companyID
          WHERE c.companyID = '{$_SESSION['companyID']}'";

// $query = "SELECT * FROM company where companyID = '{$_SESSION['companyID']}'";

$result = mysqli_query($conn, $query);
$company = mysqli_fetch_assoc($result);
// $decodedImageData = base64_decode($student['image']);

?>

<!DOCTYPE html>
<html>

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- BOOTSTRAP & MY OWN CSS -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- <link rel="stylesheet" type="text/css" href="../psm/css/indexstyle.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/studprofile.css"> -->
  <link rel="stylesheet" type="text/css" href="../css/companystyle.css">

  <style>
    .row {
      margin-bottom: 20px;
    }

    .col-md-4 {
      padding: 10px;
    }

    .skill-card {
      background-color: #f8f9fa;
      border: 1px solid #ced4da;
      border-radius: 5px;
      padding: 10px;
      height: 100%;
    }

    .skill-card h4 {
      margin-top: 0;
    }

    .skill-card p {
      margin-bottom: 5px;
    }
  </style>
  <title>Student Profile</title>

<body>
  <?php
  require_once "../navbar/comp-header.php";
  ?>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


  <h1>Internship Posting</h1>
  <div class="container" id="company-info">
    <h2>Company Information</h2>
    <p><strong>Company Name:</strong> <?php echo $company['company_name']; ?></p>
    <p><strong>Company Email:</strong> <?php echo $company['emailCompany']; ?></p>
    <p><strong>Company Website:</strong> <?php echo $company['website']; ?></p>
    <p><strong>Customer Service Number:</strong> <?php echo $company['custServiceNum']; ?></p>
    <p><strong>Industry:</strong> <?php echo $company['industry']; ?></p>
  </div>
  <br>
  <div class="container" id="PIC-info">
    <h2>Person In Charge Information</h2>
    <p><strong>Name:</strong> <?php echo $company['PICName']; ?></p>
    <p><strong>Contact Number:</strong> <?php echo $company['PICphoneNum']; ?></p>
    <p><strong>Email:</strong> <?php echo $company['PICemail']; ?></p>
  </div>
  <br>
  <div class="container" id="intern-info">
    <h2>Internship Information</h2>
    <p><strong>Title:</strong> <?php echo $company['title']; ?></p>
    <p><strong>Internship Description:</strong> <?php echo $company['description']; ?></p>
    <p><strong>Start Date:</strong> <?php echo $company['StartDate']; ?></p>
    <p><strong>End Date:</strong> <?php echo $company['EndDate']; ?></p>
    <p><strong>Status:</strong> <?php echo $company['Status']; ?></p>
  </div>


</body>

</html>