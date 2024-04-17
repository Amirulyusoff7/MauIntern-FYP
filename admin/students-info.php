<?php
session_start();
include('../config.php');
require_once "../navbar/admin-header.php"; 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Information</title>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

</head>
<body>

<div class="container">
    <table id="example" class="display" style="width:100%">
        <thead>
            <h2>Students Internship Status</h2>
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
        include('../config.php');

        $company = mysqli_query($conn, "SELECT a.Status AS Status, s.fullname AS fullname, s.email AS email, s.programme AS programme, s.phoneNum AS phoneNum
                                        FROM student s
                                        JOIN application a ON s.studentID = a.studentID
                                        WHERE a.studentID = s.studentID");

        $counter = 1; // Initialize the counter

        while ($row = mysqli_fetch_assoc($company)) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>"; // Display the counter value
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phoneNum'] . "</td>";
            echo "<td>" . $row['programme'] . "</td>";
            echo "<td>";

            // Convert numeric status value to text
            $statusValue = $row['Status'];
            $statusText = '';

            if ($statusValue == 1) {
                $statusText = 'Pending';
            } elseif ($statusValue == 2) {
                $statusText = 'Accepted';
            } elseif ($statusValue == 3) {
                $statusText = 'Rejected';
            }

            echo $statusText;

            echo "</td>";
            // echo "<td>";
            // echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#statusModal_' . $row['CompStatusID'] . '">Update</button>';
            // echo "</td>";
            echo "</tr>";

            $counter++; // Increment the counter
        }
        ?>
        </tbody>
    </table>
</div>

<?php include('../navbar/footer.php'); ?>

</body>
</html>
