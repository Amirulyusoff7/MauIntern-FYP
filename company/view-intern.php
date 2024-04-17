<?php
session_start();

include('../config.php');

// Retrieve student table from the database
// echo "Company ID: " . $_SESSION['companyID'];

$query = "SELECT * FROM company c
          JOIN internship i ON c.companyID = i.companyID
          WHERE c.companyID = '{$_SESSION['companyID']}'";

$result = mysqli_query($conn, $query);
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
    
    <title>Internship Details</title>
</head>
<body>
    <?php
    // require_once "./navbar/header.php";
    require_once "../navbar/comp-header.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php
    // Check if the 'internID' parameter exists in the URL
if (isset($_GET['internID'])) {
    // Get the internID from the URL parameter
    $internID = $_GET['internID'];

    // TODO: Fetch additional information for the specified internship using the internID
    // You can perform a database query or retrieve the information from any other source

    // Example: Fetching additional information from a database
    include('../config.php'); // Include the database connection file

    // Query to fetch additional information for the specified internship
    // $query = "SELECT * FROM internship WHERE internshipID = $internID";
    // $query = "SELECT * FROM internship i JOIN responsibility r ON i.internshipID = r.internshipID 
    // JOIN benefit b ON i.internshipID = b.internshipID JOIN requirement req ON i.internshipID = req.internshipID 
    // WHERE i.internshipID = $internID";


    $query = "SELECT *
              FROM internship i
              JOIN responsibility r ON i.internshipID = r.internshipID
              JOIN benefit b ON i.internshipID = b.internshipID
              JOIN requirement req ON i.internshipID = req.internshipID
              WHERE i.internshipID = $internID";

    $result = mysqli_query($conn, $query);
    $internship = mysqli_fetch_assoc($result);

    // Display the additional information or ask the user to insert data
    if ($internship) {
        echo '<div class="container" id="intern-info">';
        echo '<h2>Internship Information</h2>';
        echo '<div class="d-flex justify-content-end">';
        // echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addModal">Add Data</button>';
        echo '<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModalInternInfo">Edit Data</button>';
        echo '</div>';
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
        echo '<div class="d-flex justify-content-end">';
        // echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addModalResponsibility">Add Data</button>';
        echo '<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModalResponsibility">Edit Data</button>';
        // echo '<button type="button" class="btn btn-danger mr-2">Delete Data</button>';
        echo '</div>';
        echo '<div class="responsibility-details">';
        echo '<p><strong>Role:</strong> ' . $internship['Role'] . '</p>';
        echo '<p><strong>Responsibility Description:</strong> ' . $internship['resp_description'] . '</p>';
        echo '<p><strong>Skill Required:</strong> ' . $internship['skillRequired'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<br>';

        echo '<div class="container" id="intern-info">';
        echo '<h2>Requirement Information</h2>';
        echo '<div class="d-flex justify-content-end">';
        // echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addModalResponsibility">Add Data</button>';
        echo '<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModalRequirement">Edit Data</button>';
        // echo '<button type="button" class="btn btn-danger mr-2">Delete Data</button>';
        echo '</div>';
        echo '<div class="requirement-details">';
        echo '<p><strong>Requirement Description:</strong> ' . $internship['req_description'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<br>';

        echo '<div class="container" id="intern-info">';
        echo '<h2>Benefit Information</h2>';
        echo '<div class="d-flex justify-content-end">';
        // echo '<button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#addModalResponsibility">Add Data</button>';
        echo '<button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#editModalBenefit">Edit Data</button>';
        // echo '<button type="button" class="btn btn-danger mr-2">Delete Data</button>';
        echo '</div>';
        echo '<div class="benefit-details">';
        echo '<p><strong>Internship Duration:</strong> ' . $internship['b_duration'] . '</p>';
        echo '<p><strong>Allowance: RM</strong> ' . $internship['b_allowance'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<br>';
    } else {
        echo '<div class="container" id="intern-info">';
        echo '<h2>No Data Found</h2>';
        echo '<p>No Data found with the provided ID.</p>';
        echo '<p>Please insert the internship data.</p>';
        echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModalResponsibility">Insert Internship Data</button>';
        echo '</div>';
    }
} else {
    echo "Invalid internship ID.";
}
?>



<!-- Modal Add Responsibility Form -->
<div class="modal fade" id="addModalResponsibility" tabindex="-1" role="dialog" aria-labelledby="addModalResponsibilityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalResponsibilityLabel">Add Responsibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/psm/company/process-intern-resp-benefit.php" method="POST">
                <input type="hidden" name="responsibilityID" value="<?php echo $internship['responsibilityID']; ?>">
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" class="form-control" id="Role" name="Role" placeholder="IT Technician, Programmer and etc" required>
                    </div>
                    <div class="form-group">
                        <label for="responsibility_description">Responsibility Description:</label>
                        <input type="text" class="form-control" id="responsibility_description" name="responsibility_description" placeholder="Assist Team related to IT" required>
                    </div>
                    <div class="form-group">
                        <label for="skill_required">Skill Required:</label>
                        <input type="text" class="form-control" id="skill_required" name="skill_required" placeholder="PHP, MySQL, Oracle and ETC" required>
                    </div>
                    <div class="form-group">
                        <label for="b_duration">Requirement Description:</label>
                        <input type="text" class="form-control" id="req_description" name="req_description" placeholder="Have good communication skills" required>
                    </div>
                    <div class="form-group">
                        <label for="b_duration">Benefit Duration:</label>
                        <input type="text" class="form-control" id="b_duration" name="b_duration" placeholder="6 Months" required>
                    </div>
                    <div class="form-group">
                        <label for="b_allowance">Benefit Allowance(RM):</label>
                        <input type="text" class="form-control" id="b_allowance" name="b_allowance" placeholder="600"  required>
                    </div>
                    <input type="hidden" name="internshipID" value="<?php echo $internID; ?>">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Internship Information Form -->
<div class="modal fade" id="editModalInternInfo" tabindex="-1" role="dialog" aria-labelledby="editModalInternInfoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalInternInfoLabel">Edit Responsibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

<?php $row = mysqli_fetch_assoc($result);

?>

            <div class="modal-body">
                <form action="/psm/company/process-update-internInfo.php" method="POST">
                    <div class="form-group">
                        <label for="role">Title:</label>
                        <input type="text" class="form-control" id="edit_title" name="title" value="<?php echo $internship['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="internship_description">Internship Description:</label>
                        <input type="text" class="form-control" id="edit_internship_description" name="intern_description" value="<?php echo $internship['intern_description']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="EndDate">Date Application End:</label>
                        <input type="text" class="form-control" id="edit_EndDate" name="EndDate" value="<?php echo $internship['EndDate']; ?>" required>
                    </div>
                    <input type="hidden" name="internshipID" value="<?php echo $internID; ?>">
                    <input type="hidden" id="edit_responsibility_id" name="responsibility_id">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Responsibility Form -->
<div class="modal fade" id="editModalResponsibility" tabindex="-1" role="dialog" aria-labelledby="editModalResponsibilityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalResponsibilityLabel">Edit Responsibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

<?php $row = mysqli_fetch_assoc($result);

?>

            <div class="modal-body">
                <form action="/psm/company/process-update-resp.php" method="POST">
                    <div class="form-group">
                        <label for="role">Role:</label>
                        <input type="text" class="form-control" id="edit_role" name="role" value="<?php echo $internship['Role']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="responsibility_description">Responsibility Description:</label>
                        <input type="text" class="form-control" id="edit_responsibility_description" name="responsibility_description" value="<?php echo $internship['resp_description']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="skill_required">Skill Required:</label>
                        <input type="text" class="form-control" id="edit_skill_required" name="skill_required" value="<?php echo $internship['skillRequired']; ?>" required>
                    </div>
                    <input type="hidden" name="internshipID" value="<?php echo $internID; ?>">
                    <input type="hidden" id="edit_responsibility_id" name="responsibility_id">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Requirement Form -->
<div class="modal fade" id="editModalRequirement" tabindex="-1" role="dialog" aria-labelledby="editModalRequirementLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalRequirementLabel">Edit Requirement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

<?php $row = mysqli_fetch_assoc($result);

?>

            <div class="modal-body">
                <form action="/psm/company/process-update-req.php" method="POST">
                     <div class="form-group">
                        <label for="req_description">Requirement Description:</label>
                        <input type="text" class="form-control" id="edit_req_description" name="req_description" value="<?php echo $internship['req_description']; ?>" required>
                    </div>
                    <input type="hidden" name="internshipID" value="<?php echo $internID; ?>">
                    <input type="hidden" id="edit_requirement_id" name="requirement_id">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Edit Benefit Form -->
<div class="modal fade" id="editModalBenefit" tabindex="-1" role="dialog" aria-labelledby="editModalBenefitLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalBenefitLabel">Edit Benefit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

<?php $row = mysqli_fetch_assoc($result);

?>

            <div class="modal-body">
                <form action="/psm/company/process-update-benefit.php" method="POST">
                    <div class="form-group">
                        <label for="b_duration">Benefit Duration:</label>
                        <input type="text" class="form-control" id="edit_b_duration" name="b_duration" value="<?php echo $internship['b_duration']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="b_allowance">Benefit Allowance:</label>
                        <input type="text" class="form-control" id="edit_b_allowance" name="b_allowance" value="<?php echo $internship['b_allowance']; ?>" required>
                    </div>
                    <input type="hidden" name="internshipID" value="<?php echo $internID; ?>">
                    <input type="hidden" id="edit_benefit_id" name="benefit_id">
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
