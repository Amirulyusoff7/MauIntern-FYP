<?php
session_start();

include('../config.php'); // Include the database connection file

$query = "SELECT i.title, i.StartDate, i.EndDate, a.DateApplied, c.company_name, a.Status FROM application a 
JOIN internship i ON a.internshipID = i.internshipID 
JOIN company c ON i.companyID = c.companyID 
WHERE a.studentID = '{$_SESSION['studentID']}'
ORDER BY a.applicationID";

?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Add DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    <style>
        .intern-applied {
            display: grid;
            grid-template-columns: 1fr 3.5fr 1fr;
            grid-template-rows: 0.1fr repeat(2, 1fr);
            grid-column-gap: 0px;
            grid-row-gap: 0px;
            text-align: center;
        }

        .intern-heading {
            grid-area: 1 / 2 / 2 / 3;
        }

        .intern-tables {
            grid-area: 2 / 2 / 3 / 3;
            border-style: solid;
        }
    </style>

</head>
<title>Intern Applied</title>

<body>
    <?php
    require_once "../navbar/student-header.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <div class="intern-applied">
        <div class="intern-heading">
            <h1 style="align-content: center;">Internship Application</h1>
        </div>
        <div class="intern-tables">

            <table id="internship" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Date Applied</th>
                        <th>Company Name</th>
                        <th>Status of Application</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../config.php');

                    $internApplied = mysqli_query($conn, "SELECT i.title AS Name, i.StartDate AS StartDate, i.EndDate AS EndDate, a.DateApplied AS DateApplied, 
                    c.company_name AS CompanyName, a.Status AS StatusApplication  FROM application a 
                    JOIN internship i ON a.internshipID = i.internshipID 
                    JOIN company c ON i.companyID = c.companyID 
                    WHERE a.studentID = '{$_SESSION['studentID']}'
                    ORDER BY a.applicationID");

                    $counter = 1; // Initialize the counter

                    while ($row = mysqli_fetch_array($internApplied)) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>"; // Display the counter value
                        echo "<td>" . $row['Name'] . "</td>";
                        echo "<td>" . $row['StartDate'] . "</td>";
                        echo "<td>" . $row['EndDate'] . "</td>";
                        echo "<td>" . $row['DateApplied'] . "</td>";
                        echo "<td>" . $row['CompanyName'] . "</td>";

                        $status = '';
                        switch ($row['StatusApplication']) {
                            case 1:
                                $status = 'Pending';
                                break;
                            case 2:
                                $status = 'Accepted';
                                break;
                            case 3:
                                $status = 'Rejected';
                                break;
                            default:
                                $status = 'Unknown';
                                break;
                        }
                        echo "<td>" . $status . "</td>";
                        echo "</tr>";
                        $counter++; // Increment the counter
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#internship').DataTable({
                lengthChange: false, // Disable the "Show [number] entries" dropdown
                paging: false,
                searching: true,
                ordering: true,
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false, // Disable sorting for the first column (numbering column)
                    "searchable": false, // Disable searching for the first column
                }]
            });
        });
        $('#internship').wrap('<div class="dataTables-container"></div>');
    </script>

</body>

</html>
