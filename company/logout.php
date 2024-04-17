<?php
include('../config.php');

// Logout
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
