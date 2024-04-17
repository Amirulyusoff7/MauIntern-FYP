<?php
session_start();
include('../config.php');

// Retrieve the admin information from the session
$adminID = $_SESSION['adminID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['compStatusID'], $_POST['status'], $_POST['reason'])) {
        $compStatusID = $_POST['compStatusID'];
        $status = $_POST['status'];
        $reason = $_POST['reason'];

        // Update the status in the database
        $updateQuery = "UPDATE companystatus SET status_Company = '$status', reason_block = '$reason', adminID = '$adminID' WHERE CompStatusID = '$compStatusID'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            header("Location: test.php"); // Redirect to test.php
            exit();
        } else {
            echo 'error';
        }
    } else {
        echo 'missing parameters';
    }
}

?> 
