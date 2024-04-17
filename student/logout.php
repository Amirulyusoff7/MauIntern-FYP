<?php
include('../config.php');

// Logout
// if (isset($_POST['Logout'])) {
//     // Clear all session variables
//     $_SESSION = array();

//     // Destroy the session
//     session_destroy();

//     // Redirect to the login page
//     header("Location: \psm\index.php");
//     exit();
// }

// Start or resume the session
session_start();

// Destroy all session data
session_destroy();

// Redirect the user to the login page after a delay
echo '<script>
    setTimeout(function() {
        alert("You have been logged out.");
        window.location.href = "/psm/index.php"; // Redirect to the login page
    }, 500); // Delay in milliseconds (1 seconds)
</script>';
exit();

?>
