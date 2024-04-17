<?php
$studentId = 3;

// Assuming you have established a database connection
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "psm1";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Retrieve student information from the database
$query = "SELECT * FROM student WHERE studentID = '$studentId'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

// Retrieve and display the image
$query = "SELECT imagename FROM student WHERE studentID = '$studentId'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$imageData = $row['imagename'];

// Check if the image data exists
if ($imageData) {
    $decodedImageData = base64_decode($imageData);
    $imageSrc = 'data:image/jpeg;base64,' . base64_encode($decodedImageData);
} else {
    // Default image source when image data is not available
    $imageSrc = 'path/to/default/image.jpg';
}

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
    <title>Student Profile</title>

<body>
    <?php
    // require_once "./navbar/header.php";
    require_once "../navbar/header.php  ";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <div class="container">
        <h1>Student Profile</h1>
        <div class="profile-image">
            <img src="<?php echo $imageSrc; ?>" alt="Profile Image">
        </div>

        <div class="information-section">
            <h2>Student Information</h2>
            <p><strong>Full Name:</strong> <?php echo $student['fullname']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $student['phoneNum']; ?></p>
            <p><strong>Email:</strong> <?php echo $student['email']; ?></p>
        </div>
        <div class="information-section">
            <h2>Education Information</h2>
            <p><strong>Programme:</strong> <?php echo $student['programme']; ?></p>
            <p><strong>Year of Study:</strong> <?php echo $student['YearOfStudy']; ?></p>
        </div>
        <div class="information-section">
            <h2>Skill Information</h2>
            <p><strong>GPA:</strong> <?php echo $student['CGPA']; ?></p>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal">Update</button>
    </div>

    <!-- Modal Update Form -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Student Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/psm/student/updateprocess.php" method="POST">
                        <div class="form-group">
                            <label for="fullname">Full Name:</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo $student['fullname']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="phoneNum">Phone Number:</label>
                            <input type="text" class="form-control" id="phoneNum" name="phoneNum" value="<?php echo $student['phoneNum']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $student['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="programme">Programme:</label>
                            <select class="form-control" id="programme" name="programme" required>
                                <option value="select" disabled selected>select</option>
                                <option value="BITD" <?php if ($student['programme'] === 'BITD') echo 'selected'; ?>>BITD</option>
                                <option value="BITI" <?php if ($student['programme'] === 'BITI') echo 'selected'; ?>>BITI</option>
                                <option value="BITZ" <?php if ($student['programme'] === 'BITZ') echo 'selected'; ?>>BITZ</option>
                                <option value="BITM" <?php if ($student['programme'] === 'BITM') echo 'selected'; ?>>BITM</option>
                                <option value="BITS" <?php if ($student['programme'] === 'BITS') echo 'selected'; ?>>BITS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="YearOfStudy">Year Of Study:</label>
                            <select class="form-control" id="YearOfStudy" name="YearOfStudy" required>
                                <option value="select" disabled selected>select</option>
                                <option value="Year 1" <?php if ($student['YearOfStudy'] === 'Year 1') echo 'selected'; ?>>Year 1</option>
                                <option value="Year 2" <?php if ($student['YearOfStudy'] === 'Year 2') echo 'selected'; ?>>Year 2</option>
                                <option value="Year 3" <?php if ($student['YearOfStudy'] === 'Year 3') echo 'selected'; ?>>Year 3</option>
                                <option value="Year 4" <?php if ($student['YearOfStudy'] === 'Year 4') echo 'selected'; ?>>Year 4</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="CGPA">CGPA:</label>
                            <input type="text" class="form-control" id="CGPA" name="CGPA" value="<?php echo $student['CGPA']; ?>">
                        </div>
                        <input type="hidden" name="studentId" value="3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>