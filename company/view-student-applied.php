<?php
session_start();
include('../config.php');

if (!isset($_GET['studentID'])) {
    // Redirect if student ID is not provided
    header("Location: your_previous_page.php");
    exit();
}

$studentID = $_GET['studentID'];

// Retrieve student table from the database
$query = "SELECT * FROM student s
          JOIN skill sk ON s.studentID = sk.studentID
          WHERE s.studentID = '$studentID'";

$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

// Retrieve skills for the current student
$skillsQuery = "SELECT * FROM skill WHERE studentID = '$studentID'";
$skillsResult = mysqli_query($conn, $skillsQuery);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/studprofile.css">

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Add DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        #example_wrapper {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
        }
    </style>
</head>
<title>Internship Dashboard</title>
<body>

<?php require_once "../navbar/comp-header.php"; ?>

<h3>Hello, <?php echo $_SESSION['PICName']; ?></h3>

<div class="container">
    <h1>Student Profile</h1>
    <div class="profile-image">
        <?php if ($student['image']): ?>
            <img src="data:image/jpeg;base64,<?php echo $student['image']; ?>" alt="Profile Image">
        <?php else: ?>
            <img src="../img/dp.jpg" alt="Default Profile Image">
        <?php endif; ?>
        <!-- <form action="../student/upload-img.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload">
        </form> -->
    </div>
    <div class="information-section">
            <h2>Summary</h2>
            <?php if ($student['summary']): ?>
                <h5 style="text-align: justify;"><?php echo nl2br($student['summary']); ?></h5>
            <?php else: ?>
                <p>No summary available.</p>
            <?php endif; ?>
        </div>

    <div class="information-section">
        <h2>Student Information</h2>
        <p><strong>Full Name:</strong> <?php echo $student['fullname']; ?></p>
        <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
        <p><strong>Phone Number:</strong> <?php echo $student['phoneNum']; ?></p>
        <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
    </div>
    <div class="information-section">
        <h2>Education Information</h2>
        <p><strong>Programme:</strong> <?php echo $student['programme']; ?></p>
        <p><strong>Year of Study:</strong> <?php echo $student['YearOfStudy']; ?></p>
        <p><strong>CGPA:</strong> <?php echo $student['CGPA']; ?></p>
    </div>
    <div class="information-section">
        <h2>Skill Information</h2>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($skillsResult)) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['skill_name']; ?></h5>
                            <p class="card-text"><strong>Description:</strong> <?php echo $row['skill_description']; ?></p>
                            <p class="card-text"><strong>Skill Level:</strong> <?php echo $row['skill_level']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

</body>
</html>
