<?php
session_start();
include('../config.php');

// Check if the internshipID is provided in the URL
if (isset($_GET['internshipID'])) {
    $internshipID = $_GET['internshipID'];

    // Fetch the internship data based on the provided internshipID
    $query = "SELECT * FROM internship WHERE internshipID = '$internshipID' AND companyID = '{$_SESSION['companyID']}'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $startDate = $row['StartDate'];
        $endDate = $row['EndDate'];
    } else {
        // Internship not found, handle the error or redirect
        // For example: header("Location: internship-list.php");
    }
} else {
    // internshipID is not provided in the URL, handle the error or redirect
    // For example: header("Location: internship-list.php");
}

// Handle form submission to update the start and end dates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStartDate = $_POST['editStartDate'];
    $newEndDate = $_POST['editEndDate'];

    // Perform the database update here
    $updateQuery = "UPDATE internship SET StartDate = '$newStartDate', EndDate = '$newEndDate' WHERE internshipID = '$internshipID'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Update successful, you can redirect or display a success message
        echo "Internship dates updated successfully.";
        header("Location: dashboard.php");
    } else {
        // Update failed, handle the error
        echo "Error updating internship dates: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    body{
        margin-left: 375px;
    }
</style>

    <title>Edit Internship</title>
    <!-- Add Bootstrap CSS link here -->
</head>
<body>
    <?php require_once "../navbar/comp-header.php"; ?>

    <div class="container">
        <h2>Edit Internship</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="editStartDate">Start Date</label>
                <input type="date" class="form-control" id="editStartDate" name="editStartDate" value="<?php echo $startDate; ?>">
            </div>
            <div class="form-group">
                <label for="editEndDate">End Date</label>
                <input type="date" class="form-control" id="editEndDate" name="editEndDate" value="<?php echo $endDate; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Add Bootstrap JS and other scripts here -->

</body>
</html>
