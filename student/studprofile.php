<?php
session_start();

// Check if the student is logged in
if (!isset($_SESSION['studentID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include('../config.php');
// Retrieve student information from the database
$studentID = $_SESSION['studentID'];
$query = "SELECT * FROM student WHERE studentID = '$studentID'";
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../psm/css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/studprofile.css">

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
    // require_once "./navbar/header.php";
    require_once "../navbar/student-header.php";

    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- <h3> Name: <?php echo $_SESSION['fullname']; ?> </h3> -->

    <div class="container">
        <h1>Student Profile</h1>
        <div class="profile-image">
             <?php if ($student['image']): ?>
                <img src="data:image/jpeg;base64,<?php echo $student['image']; ?>" alt="Profile Image">
            <?php else: ?>
                <img src="../img/dp.jpg" alt="Default Profile Image">
            <?php endif; ?>
            <form action="../student/upload-img.php" method="POST" enctype="multipart/form-data">
                <!-- <input type="file" name="image"> -->
                <input type="file" name="image" accept=".jpg, .jpeg">
                <input type="submit" name="submit" value="Upload">
            </form>

        <div class="information-section">
        <h2>Summary</h2>
        <form action="update-summary.php" method="POST" id="confirmation-form">
            <textarea name="summary" rows="4" class="form-control" placeholder="Write a brief summary to sell yourself"></textarea>
            <button type="button" class="btn btn-primary " onclick="confirmUpdate()">Submit Summary</button>
            <input type="hidden" name="submit-summary" value="yes">
        </form>
        </div>

        <script>
            function confirmUpdate() {
                if (confirm('Are you sure you want to submit your summary?')) {
                    document.getElementById('confirmation-form').submit();
                }
            }
        </script>
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
