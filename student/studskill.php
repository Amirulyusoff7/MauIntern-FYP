<?php
session_start();

// include('../config.php');
// // Retrieve student table from the database
// $query = "SELECT s.*, sk.* FROM student s
//           JOIN skill sk ON s.studentID = sk.studentID
//           WHERE s.studentID = '{$_SESSION['studentID']}'";

// $result = mysqli_query($conn, $query);
// $student = mysqli_fetch_assoc($result);
// $decodedImageData = base64_decode($student['image']);

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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- <h3> Name: <?php echo $_SESSION['fullname']; ?> </h3> -->

    <?php
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

    <div class="container">
        <!-- <h1>Student Profile</h1>
        <div class="profile-image">
             <?php if ($student['image']): ?>
                <img src="data:image/jpeg;base64,<?php echo $student['image']; ?>" alt="Profile Image">
            <?php else: ?>
                <img src="../img/dp.jpg" alt="Default Profile Image">
            <?php endif; ?>
            <form action="../student/upload-img.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="image">
                <input type="submit" name="submit" value="Upload">
            </form>
        </div> -->

        <div class="information-section">
            <h2>Skill Information <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add Skills</button></h2>
            <div class="row">
            <?php
        // Fetch skills separately
        $skillsQuery = "SELECT * FROM skill WHERE studentID = '$studentID'";
        $skillsResult = mysqli_query($conn, $skillsQuery);
        
        $count = 0;
        while ($row = mysqli_fetch_assoc($skillsResult)) :
            if ($count % 2 === 0 && $count !== 0) {
                echo '</div><div class="row">';
            }
                ?>
                    <div class="col-md-6">
                        <div class="skill-card">
                            <h4><?php echo $row['skill_name']; ?></h4>
                            <!-- <p><strong>Description:</strong> <?php echo $row['skill_description']; ?></p> -->
                            <p><strong>Skill Level:</strong> <?php echo $row['skill_level']; ?></p>
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateModal_<?php echo $row['skillID']; ?>">Update</button>
                            <form action="/psm/student/delete-skills-process.php" method="POST" style="display: inline-block;">
                                <input type="hidden" name="skillID" value="<?php echo $row['skillID']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this skill?')">Delete</button>
                            </form>
                        </div>
                    </div>

                    <!-- Update Modal for Skill -->
                    <div class="modal fade" id="updateModal_<?php echo $row['skillID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel_<?php echo $row['skillID']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel_<?php echo $row['skillID']; ?>">Update Skill</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/psm/student/update-skills-process.php" method="POST">
                                        <input type="hidden" name="skillID" value="<?php echo $row['skillID']; ?>">
                                        <div class="form-group">
                                            <label for="update_skill_name">Skill Name:</label>
                                            <input type="text" class="form-control" id="update_skill_name" name="update_skill_name" value="<?php echo $row['skill_name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="update_skill_description">Description:</label>
                                            <input type="text" class="form-control" id="update_skill_description" name="update_skill_description" value="<?php echo $row['skill_description']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="update_skill_level">Skill Level:</label>
                                            <select class="form-control" id="update_skill_level" name="update_skill_level" required>
                                                <option value="select" disabled selected>select</option>
                                                <option value="Novice" <?php if ($row['skill_level'] === 'Novice') echo 'selected'; ?>>Novice</option>
                                                <option value="Advance Beginner" <?php if ($row['skill_level'] === 'Advance Beginner') echo 'selected'; ?>>Advance Beginner</option>
                                                <option value="Competent" <?php if ($row['skill_level'] === 'Competent') echo 'selected'; ?>>Competent</option>
                                                <option value="Proficient" <?php if ($row['skill_level'] === 'Proficient') echo 'selected'; ?>>Proficient</option>
                                                <option value="Expert" <?php if ($row['skill_level'] === 'Expert') echo 'selected'; ?>>Expert</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Save Changes</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $count++;
                endwhile;
                ?>





                <!-- Modal Add Skills Form -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel">Add Student Skills</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="/psm/student/add-skills-process.php" method="POST">
                                    <div class="form-group">
                                        <label for="skill_name">Skill Name:</label>
                                        <input type="text" class="form-control" id="skill_name" name="skill_name" placeholder="Enter skill name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="skill_description">Description:</label>
                                        <input type="text" class="form-control" id="skill_description" name="skill_description" placeholder="Enter skill description" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="skill_level">Skill Level:</label>
                                        <select class="form-control" id="skill_level" name="skill_level" required>
                                            <option value="select" disabled selected>Select skill level</option>
                                            <option value="Novice">Novice</option>
                                            <option value="Advance Beginner">Advance Beginner</option>
                                            <option value="Competent">Competent</option>
                                            <option value="Proficient">Proficient</option>
                                            <option value="Expert">Expert</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal Update Skills Form -->
                <!-- <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="updateModalLabel">Update Student Skills</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="/psm/student/update-skills-process.php" method="POST">
                                <div class="form-group">
                                    <label for="skill_name">Skill Name:</label>
                                    <input type="text" class="form-control" id="skill_name" name="skill_name" placeholder="Enter skill name" required>
                                </div>
                                <div class="form-group">
                                    <label for="skill_description">Description:</label>
                                    <input type="text" class="form-control" id="skill_description" name="skill_description" placeholder="Enter skill description" required>
                                </div>
                                <div class="form-group">
                                    <label for="skill_level">Skill Level:</label>
                                    <select class="form-control" id="skill_level" name="skill_level" required>
                                        <option value="select" disabled selected>Select skill level</option>
                                        <option value="Novice">Novice</option>
                                        <option value="Advance Beginner">Advance Beginner</option>
                                        <option value="Competent">Competent</option>
                                        <option value="Proficient">Proficient</option>
                                        <option value="Expert">Expert</option>
                                    </select>
                                </div>
                                <input type="hidden" name="studentID" value="<?php echo $studentID; ?>">
                                <input type="hidden" name="skill_id" value="<?php echo $row['skill_id']; ?>">
                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Update</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> -->




</body>

</html>