<?php session_start(); 
// Retrieve student table from the database
// echo "Company ID: " . $_SESSION['companyID'];
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

    <!-- Add jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- Add DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

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

    </style>
</head>
<title>Internship Dashboard</title>
<body>

<?php 
require_once "../navbar/comp-header.php"; 
// require_once "../navbar/sidebar.php";
?>

<!-- <h3>Hello, <?php echo $_SESSION['PICName']; ?></h3> -->

<div class="container">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <h2>Internship Posting List</h2>
            <a href="<?php $_SERVER['PHP_SELF']; ?>">Refresh</a><!--  add dialog ask user to refresh -->
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('../config.php');

            $internship = mysqli_query($conn, "SELECT * FROM internship WHERE companyID = '{$_SESSION['companyID']}'");

            $counter = 1; // Initialize the counter

            while ($row = mysqli_fetch_array($internship)) {
                echo "<tr>";
                echo "<td>" . $counter . "</td>"; // Display the counter value
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['StartDate'] . "</td>";
                echo "<td>" . $row['EndDate'] . "</td>";
                echo "<td>";
                echo "<select class='status-select' data-internshipid='" . $row['internshipID'] . "'>";
                echo "<option value='Offering'" . ($row['Status'] === 'Offering' ? ' selected' : '') . ">Offering</option>";
                echo "<option value='Not Offering'" . ($row['Status'] === 'Not Offering' ? ' selected' : '') . ">Not Offering</option>";
                echo "</select>";
                echo "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary btn-sm' href='edit-date.php?internshipID=" . $row['internshipID'] . "'>Edit</a>";
                echo "<button class='btn btn-danger btn-sm' onclick='deleteInternship(" . $row['internshipID'] . ")'>Delete</button>";
                echo "</td>";
                echo "</tr>";
                $counter++; // Increment the counter
            }
            ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
    $('#example').DataTable({
        lengthChange: false,
        paging: false,
        searching: true,
        ordering: true,
        "columnDefs": [{
            "targets": 0,
            "orderable": false,
            "searchable": false,
        }]
    });

    // Handle status change
    $('.status-select').change(function() {
        var internshipID = $(this).data('internshipid');
        var newStatus = $(this).val();

        // Debugging: Print the data being sent to the server
        console.log('Sending data to server:');
        console.log('Internship ID: ' + internshipID);
        console.log('New Status: ' + newStatus);

        // Make an AJAX request to update_status.php
        $.ajax({
            url: 'update-status.php',
            type: 'POST',
            data: { internshipID: internshipID, newStatus: newStatus },
            success: function(response) {
                console.log('Server response:');
                console.log(response); // Output the response from update_status.php
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:');
                console.log(error); // Output any errors
            }
        });
    });
});

    $('#example').wrap('<div class="dataTables-container"></div>');
    
    function deleteInternship(internshipID) {
    // Implement the delete functionality, e.g., show a confirmation dialog
    var confirmDelete = confirm('Are you sure you want to delete this internship?');

    if (confirmDelete) {
        // If confirmed, make an AJAX request to delete the internship
        $.ajax({
            url: 'delete-internship.php',
            type: 'POST',
            data: { internshipID: internshipID },
            success: function(response) {
                // Handle the response from the server
                console.log(response);

                // Check if the response contains "Internship deleted successfully!"
                if (response.includes("Internship deleted successfully!")) {
                    // Reload the page after a short delay
                    setTimeout(function() {
                        alert('Internship deleted successfully!');
                        window.location.reload();
                    }, 1000); // You can adjust the delay (in milliseconds) as needed
                }
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:');
                console.log(error);
            }
        });
    }
}

    // Function to open the edit modal and populate the form
    function openEditModal(internshipID, startDate, endDate) {
        // Populate the form fields in the modal with the fetched data
        $('#editStartDate').val(startDate);
        $('#editEndDate').val(endDate);
        $('#internshipID').val(internshipID);

        // Open the modal
        $('#editInternshipModal').modal('show');
    }

    // Function to save edited internship data
    function saveEditedInternship() {
        // You can make an AJAX request here to send the edited data to the server
        // and update the database. Don't forget to handle the response accordingly.
        // Example:
        $.ajax({
            url: 'save-edited-internship.php',
            type: 'POST',
            data: $('#editInternshipForm').serialize(), // Serialize form data
            success: function(response) {
                console.log('Server response:');
                console.log(response); // Output the response from the server

                // Close the modal after successful save
                $('#editInternshipModal').modal('hide');

                // Optionally, you can refresh the table or take other actions as needed
            },
            error: function(xhr, status, error) {
                console.log('AJAX error:');
                console.log(error);
            }
        });
    }

    </script>

</div>

<div class="modal fade" id="editInternshipModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Internship</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editInternshipForm">
                    <div class="form-group">
                        <label for="editStartDate">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="editStartDate" value="">
                    </div>
                    <div class="form-group">
                        <label for="editEndDate">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="editEndDate" value="">
                    </div>
                    <input type="hidden" id="internshipID" name="internshipID" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEditedInternship()">Save Changes</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
