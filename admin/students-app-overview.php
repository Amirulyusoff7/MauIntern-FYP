<?php
session_start();
include('../config.php');
require_once "../navbar/admin-header.php"; 

// Get details of students who have applied
$appliedStudentQuery = "
    SELECT DISTINCT s.fullname, s.email, s.programme, s.phoneNum
    FROM student s
    JOIN application a ON s.studentID = a.studentID
";
$appliedStudentResult = mysqli_query($conn, $appliedStudentQuery);

// Get details of students who have not applied
$notAppliedStudentQuery = "
    SELECT s.fullname, s.email, s.programme, s.phoneNum
    FROM student s
    WHERE s.studentID NOT IN (
        SELECT DISTINCT studentID
        FROM application
    )
";
$notAppliedStudentResult = mysqli_query($conn, $notAppliedStudentQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Information</title>
</head>
<body>

<div class="container">
    <h2>Students' Internship Participation Overview</h2>

    <!-- Filter Buttons -->
    <div>
        <button class="filter-button" data-filter="all">All Students</button>
        <button class="filter-button" data-filter="applied">Applied Students</button>
        <button class="filter-button" data-filter="notapplied">Not Applied Students</button>
    </div>

    <!-- Students Table -->
    <table class="table table-striped table-bordered" style="width:100%" id="studentsTable">
        <!-- Table headers -->
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Programme</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;

        while ($row = mysqli_fetch_assoc($appliedStudentResult)) {
            echo "<tr class='applied'>";
            echo "<td>" . $counter . "</td>";
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phoneNum'] . "</td>";
            echo "<td>" . $row['programme'] . "</td>";
            echo "<td>Applied</td>";
            echo "</tr>";
            $counter++;
        }

        while ($row = mysqli_fetch_assoc($notAppliedStudentResult)) {
            echo "<tr class='notapplied'>";
            echo "<td>" . $counter . "</td>";
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phoneNum'] . "</td>";
            echo "<td>" . $row['programme'] . "</td>";
            echo "<td>Not Applied</td>";
            echo "</tr>";
            $counter++;
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Hide rows initially
    $('#studentsTable tbody tr').hide();

    // Show all students initially
    $('.filter-button[data-filter="all"]').addClass('active');
    $('#studentsTable tbody tr').show();

    // Handle filter button click event
    $('.filter-button').on('click', function() {
        var filter = $(this).data('filter');
        $('.filter-button').removeClass('active');
        $(this).addClass('active');

        // Hide all rows
        $('#studentsTable tbody tr').hide();

        if (filter === 'all') {
            // Show all students
            $('#studentsTable tbody tr').show();
        } else if (filter === 'applied') {
            // Show applied students
            $('#studentsTable tbody tr.applied').show();
        } else if (filter === 'notapplied') {
            // Show not applied students
            $('#studentsTable tbody tr.notapplied').show();
        }
    });
});
</script>

<?php include('../navbar/footer.php'); ?>
</body>
</html>
