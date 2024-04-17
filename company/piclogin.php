<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('../config.php');

if(isset($_POST['Login']))
{
    $email = $_POST['PICemail'];
    $password = $_POST['PICpassword'];

    $query = mysqli_query($conn, "SELECT c.companyID AS companyID, c.PICName AS PICName, cs.status_Company AS status_Company FROM company c 
                                  JOIN companystatus cs ON c.companyID = cs.companyID 
                                  WHERE PICemail = '".$_POST['PICemail']."' && PICpassword = '".$_POST['PICpassword']."'");
    
    if(mysqli_num_rows($query)) {
        $row = mysqli_fetch_assoc($query);
        $companyID = $row['companyID'];
        $PICName = $row['PICName'];
        $status = $row['status_Company'];

        if ($status === 'Banned') {
            // echo "<script>alert('Your company has been banned. Please contact support.');</script>";
            echo "<script>
                setTimeout(function() {
                    alert('Your company has been banned. Please contact support.');
                    window.location.href = '/psm/call-support.php';
                }, 500);
              </script>";
        } else if ($status === 'Active' || $status === null) {
            $_SESSION['companyID'] = $companyID;
            $_SESSION['PICName'] = $PICName;
            $_SESSION['type'] = 'PICcompany';

            echo "<script>
                setTimeout(function() {
                    alert('Login successful!');
                    window.location.href = '/psm/company/dashboard.php';
                }, 500);
              </script>";
        } else {
            echo "<script>alert('Your company is not active. Please contact support.');</script>";
        }
    } else {
        echo "<script>alert('Invalid Email or Password');</script>";
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Company Login</title>
    <link rel="stylesheet" type="text/css" href="../css/studlogin.css">

    <?php
    // require_once "./navbar/header.php";
    // require_once "../navbar/index-header.php";
    require_once "../navbar/sidebar.php";
    ?>
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="PICemail">PIC Email</label>
            <input type="email" placeholder="Enter your email" id="PICemail" name="PICemail" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Enter your password" id="PICpassword" name="PICpassword" required>

            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="Login">Login</button>
            <p>Don't have an account? <a href="../company/compsignup.php">Sign up</a></p>
        </form>
    </div>
</body>
</html>
