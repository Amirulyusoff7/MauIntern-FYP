<?php
session_start();

include('../config.php');
// Retrieve student table from the database
// echo "Company ID:" . $_SESSION['companyID'];

$query = "SELECT * FROM company c
          JOIN internship i ON c.companyID = i.companyID
          WHERE c.companyID = '{$_SESSION['companyID']}'";

$result = mysqli_query($conn, $query);
// $internship = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../psm/css/intern.css">
    <!-- <link rel="stylesheet" type="text/css" href="../css/studprofile.css"> -->

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

        /* .container-list{
            width: auto !important;
            height: auto !important;
        } */

    </style>

    <title>Internship Details</title>

<body>
    <?php
    // require_once "./navbar/header.php";
    require_once "../navbar/comp-header.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- <div class="container" > -->
    <div class="container" id="intern-list">
        <div class="information-section">
            <h2>Internship Information <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Add internship details</button></h2>
            <div class="row">
                <?php
                while ($internship = mysqli_fetch_assoc($result)) :
                ?>
                    <div class="col-md-4" id="list">
                        <div class="skill-card">
                            <div class="container" id="intern-info">
                                <!-- <h2>Internship Information</h2> -->
                                <h2><strong><?php echo $internship['title']; ?></strong></h2>
                                <p><strong>Internship Description:</strong> <?php echo $internship['intern_description']; ?></p>
                                <p><strong>Duration:</strong> <?php echo $internship['duration']; ?></p>
                                <!-- <p><strong>Start Date:</strong> <?php echo $internship['StartDate']; ?></p> -->
                                <!-- <p><strong>End Date:</strong> <?php echo $internship['EndDate']; ?></p> -->
                                <p><strong>Status:</strong> <?php echo $internship['Status']; ?></p>
                                <button type="button" class="btn btn-sm btn-primary" onclick="window.location.href='../company/view-intern.php?internID=<?php echo $internship['internshipID']; ?>'">View More</button>
                                <input type="hidden" name="companyID" value="<?php echo $internship['companyID']; ?>">
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
    </div>

    <!-- Modal Add Intern Form -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Add Internship</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/psm/company/process-intern-details.php" method="POST">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title of Internship" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Internship Description:</label>
                            <input type="text" class="form-control" id="intern_description" name="intern_description" placeholder="Enter internship description" required>
                        </div>
                        <div class="form-group required">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="3-6 Months or 6 Months" required>
                        </div>
                        <div class="form-group required">
                            <label for="StartDate">Start Date</label>
                            <input type="date" class="form-control" id="StartDate" name="StartDate" required>
                        </div>
                        <div class="form-group required">
                            <label for="EndDate">End Date</label>
                            <input type="date" class="form-control" id="EndDate" name="EndDate" required>
                        </div>
                        <div class="form-group required">
                            <label for="Status">Status</label>
                            <select class="form-control" id="Status" name="Status" required>
                                <option value="Select Status" disabled selected>Select Status</option>
                                <option value="Offering">Offering</option>
                                <option value="Not Offering">Not Offering</option>
                            </select>
                        </div>
                        <input type="hidden" name="internshipID" value="<?php echo $internship; ?>">
                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
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