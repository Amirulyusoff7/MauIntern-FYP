<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// Retrieve student table from the database
// echo "Company ID: " . $_SESSION['companyID'];
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Add DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KyZXEAg3QhqLMpG8r+6+TkIbb5WIVWO5K8DEk+qEe9HVm7bG8CqAI5374b0p+85Y"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>


    <style>
        #example_wrapper {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
        }

        .status-select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        .status-select option {
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        .status-select:focus {
            outline: none;
            border-color: #4c9ed9;
            box-shadow: 0 0 0 2px rgba(76, 158, 217, 0.2);
        }

        .reason-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            width: 300px;
        }

        .reason-input:focus {
            outline: none;
            border-color: #4c9ed9;
            box-shadow: 0 0 0 2px rgba(76, 158, 217, 0.2);
        }

        .ban-button {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<title>Internship Dashboard</title>
<body>

<?php require_once "../navbar/admin-header.php"; ?>



<div class="container">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <h2>Company List</h2>
        <tr>
            <th>No.</th>
            <th>Title</th>
            <th>Company Email</th>
            <th>Industry</th>
            <th>Reason</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include('../config.php');

        $company = mysqli_query($conn, "SELECT *, cs.CompStatusID AS CompStatusID, c.company_name AS CompName, c.emailCompany AS EmailComp, c.industry AS Industry,
                                            cs.status_Company as StatusComp, cs.reason_block as Reason 
                                            FROM company c
                                            JOIN companystatus cs ON c.companyID = cs.companyID");

        $counter = 1; // Initialize the counter

        while ($row = mysqli_fetch_assoc($company)) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>"; // Display the counter value
            echo "<td>" . $row['CompName'] . "</td>";
            echo "<td>" . $row['EmailComp'] . "</td>";
            echo "<td>" . $row['Industry'] . "</td>";
            echo "<td>" . ($row['StatusComp'] === 'Active' ? 'This Company is good' : $row['Reason']) . "</td>";
            echo "<td>" . $row['StatusComp'] . "</td>";
            echo "<td>";
            echo '<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#statusModal_' . $row['CompStatusID'] . '">Update</button>';
            echo "</td>";
            echo "</tr>";

            $counter++; // Increment the counter
        }
        ?>
        </tbody>
    </table>
</div>

<?php
// Display the modals for each row
$company = mysqli_query($conn, "SELECT *, cs.CompStatusID AS CompStatusID, c.company_name AS CompName, c.emailCompany AS EmailComp, c.industry AS Industry,
                                            cs.status_Company as StatusComp, cs.reason_block as Reason 
                                            FROM company c
                                            JOIN companystatus cs ON c.companyID = cs.companyID");

while ($row = mysqli_fetch_assoc($company)) {
    echo '<div class="modal fade" id="statusModal_' . $row['CompStatusID'] . '" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">';
    echo '<div class="modal-dialog" role="document">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title" id="statusModalLabel">Update Status</h5>';
    echo '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span>';
    echo '</button>';
    echo '</div>';
    echo '<div class="modal-body">';
    echo '<form id="statusForm_' . $row['CompStatusID'] . '">';
    echo '<div class="form-group">';
    echo '<label for="statusSelect_' . $row['CompStatusID'] . '">Status:</label>';
    echo '<select class="form-control" id="statusSelect_' . $row['CompStatusID'] . '">';
    echo '<option disabled selected>Select</option>';
    echo '<option value="Active">Active</option>';
    echo '<option value="Banned">Banned</option>';
    echo '</select>';
    echo '</div>';
    echo '<div class="form-group">';
    echo '<label for="reasonInput_' . $row['CompStatusID'] . '">Reason:</label>';
    echo '<input type="text" class="form-control" id="reasonInput_' . $row['CompStatusID'] . '">';
    echo '<br>';
    echo '<h6>Please refresh after click update.</h6>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '<div class="modal-footer">';
    echo '<button type="button" class="btn btn-primary" id="updateStatusBtn_' . $row['CompStatusID'] . '">Update</button>';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>


<script>
    $(document).ready(function() {
        $('#example').DataTable({
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

        // Add event listener for update buttons
        $("button[id^='updateStatusBtn_']").click(function() {
            var compStatusID = $(this).attr("id").split("_")[1];
            var status = $("#statusSelect_" + compStatusID).val();
            var reason = $("#reasonInput_" + compStatusID).val();

            // AJAX request to update the database
            $.ajax({
                url: "../admin/update-status.php", // Replace with the correct URL for the PHP script that updates the status
                type: "POST",
                data: {
                    compStatusID: compStatusID,
                    status: status,
                    reason: reason
                },
                success: function(response) {
                    // Handle the response from the server if needed
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle the error if the request fails
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<?php include('../navbar/footer.php'); ?>
</body>
</html>
