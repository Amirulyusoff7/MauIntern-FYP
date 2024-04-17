<?php session_start(); 

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

    <!-- Add Bootstrap Icons CSS (for the Info Circle icon) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

    <style>
        .intern-applied {
            display: grid;
            grid-template-columns: 250px 1fr ;
            grid-template-rows: 0.5fr 3fr 1fr;
            grid-column-gap: 20px;
            grid-row-gap: 0px;
            text-align: center;
        }

        .intern-heading {
            grid-area: 1 / 2 / 2 / 3;
        }

        .intern-tables {
            grid-area: 2 / 2 / 3 / 3;
            /* border-style: solid; */
        }

        code {
            font-family: Consolas, "courier new";
            color: crimson;
            background-color: #f1f1f1;
            padding: 2px;
            font-size: 105%;
        }

        select.form-control:not([size]):not([multiple]) {
            width: auto;
        }
        .status-form {
            display: flex;
            align-items: center;
        }

        .status-dropdown {
            margin-right: 10px; /* Adjust margin as needed */
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<title>Internship Dashboard</title>
<body>

<?php require_once "../navbar/comp-header.php"; ?>

<!-- <h3>Hello, <?php echo $_SESSION['PICName']; ?></h3> -->

<div class="intern-applied">
    <div class="intern-heading">
        <h1 style="align-content: center;">Internship Application of Students</h1>
        <h5><code>*Send Email Right After Change Status*</code></h5>
    </div>
    <div class="intern-tables table-container">

        <table id="internship" class="table" style="width:100%">
            <thead>
            <tr>
                <th>No.</th>
                <th>Internship Title</th>
                <th>Student Name</th>
                <th>Student Email</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>View Student Details</th>
                <!-- <th>Status of Application</th> -->
                <th>Status of Application and Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include('../config.php');

            $internApp = mysqli_query($conn, "SELECT *, i.title AS Title, s.fullname AS Fullname, s.email AS Email, 
            i.StartDate AS StartDate, i.EndDate AS EndDate, a.status AS StatusApp
            FROM application a 
            JOIN internship i ON a.internshipID = i.internshipID
            JOIN student s ON a.studentID = s.studentID
            JOIN company c ON i.companyID = c.companyID
            WHERE c.companyID = '{$_SESSION['companyID']}'
            ORDER BY a.applicationID");

            $counter = 1; // Initialize the counter

            while ($row = mysqli_fetch_array($internApp)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>"; // Display the counter value
                echo "<td>" . $row['Title'] . "</td>";
                echo "<td>" . $row['Fullname'] . "</td>";
                echo "<td>" . $row['Email'] . "</td>";
                echo "<td>" . $row['StartDate'] . "</td>";
                echo "<td>" . $row['EndDate'] . "</td>";
                echo '<td><a href="view-student-applied.php?studentID=' . $row['studentID'] . '"><i class="bi bi-info-circle-fill"></i></a></td>';
                
                
                echo '<td>
                <form class="send-email-form status-form" method="post" action="send-email.php">
                    <input type="hidden" name="applicationID" value="' . $row['applicationID'] . '">
                    <input type="hidden" name="internshipID" value="' . $row['internshipID'] . '">
                    <select class="form-control status-dropdown" name="newStatus">
                        <option value="1" ' . ($row['StatusApp'] == '1' ? 'selected' : '') . '>Pending</option>
                        <option value="2" ' . ($row['StatusApp'] == '2' ? 'selected' : '') . '>Accepted</option>
                        <option value="3" ' . ($row['StatusApp'] == '3' ? 'selected' : '') . '>Rejected</option>
                    </select>
                    
                    <button class="btn btn-primary save-button" type="submit">Send Email</button>
                </form>
            </td>';
                // echo '</td>';
            
                echo "</tr>";
                $counter++; // Increment the counter
            }
                // echo '<td>';
                // echo '<button class="btn btn-primary refresh-button" data-internshipid="' . $row['internshipID'] . '">Save</button>';
                // echo '</td>';

            //     echo "</tr>";
            //     $counter++; // Increment the counter
            // }
            function getStatusText($statusApp)
            {
                $statuses = array(
                    1 => 'Pending',
                    2 => 'Accepted',
                    3 => 'Rejected',
                    
                );

                return isset($statuses[$statusApp]) ? $statuses[$statusApp] : 'Unknown';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function () {
    // Initialize DataTable
    $('#internship').DataTable();

    // Handle status change and send email
    $('.send-email-form').submit(function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var form = $(this);
        var applicationID = form.find('[name="applicationID"]').val();
        var internshipID = form.find('[name="internshipID"]').val();
        var newStatus = form.find('.status-dropdown').val();

        // Make an AJAX request to update the status and send email
        $.ajax({
            url: 'send-email.php',
            type: 'POST',
            data: {
                applicationID: applicationID,
                internshipID: internshipID,
                newStatus: newStatus
            },
            success: function (response) {
                console.log(response);
                location.reload(); // Reload the page after successful action
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });

    // Handle Refresh button click
    $('.refresh-button').click(function () {
        var internshipID = $(this).data('internshipid'); // Get the internshipID
        var selectedStatus = $(this).closest('tr').find('.status-dropdown').val(); // Get selected status

        // Send email only if the selected status is "Accepted" (Status value: 2) or "Rejected" (Status value: 3)
        if (selectedStatus === '2' || selectedStatus === '3') {
            $.ajax({
                url: 'send-email.php',
                type: 'POST',
                data: {internshipID: internshipID},
                success: function (response) {
                    console.log(response);
                    location.reload(); // Reload the page after sending email
                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        } else {
            // If the selected status is not "Accepted" or "Rejected", just reload the page
            location.reload();
        }
    });

    function getStatusText(statusApp) {
        var statuses = {
            1: 'Pending',
            2: 'Accepted',
            3: 'Rejected',
            // Add more statuses if needed
        };

        return statuses[statusApp] || 'Unknown';
    }
});

</script>
</div>

</body>
</html>
