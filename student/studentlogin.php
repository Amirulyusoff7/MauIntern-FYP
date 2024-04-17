<?php
// include("session.php");
session_start();
include('../config.php');

// if(isset($_POST['Login']))
// {
//     $query = mysqli_query($conn, "SELECT studentID, fullname FROM student WHERE email  = '".$_POST['email']."' && passwords = '".$_POST['passwords']."'");
//     if(mysqli_num_rows($query)) {
//         $row=mysqli_fetch_assoc($query);

//         $_SESSION['studentID'] = $row['studentID'];
//         $_SESSION['fullname'] = $row['fullname'];
//         $_SESSION['type'] = 'student';
//         header("location:index.php");
// 	}
// 	 else
// 	{
// 	 echo "<script>alert('Invalid Email or Password');</script>";
// 	} 
// }

if(isset($_POST['Login'])) {
    $email = $_POST['email'];
    $password = $_POST['passwords'];

    // Check if the user is a student
    $studentQuery = mysqli_query($conn, "SELECT studentID, fullname FROM student WHERE email = '$email' AND passwords = '$password'");
    if(mysqli_num_rows($studentQuery)) {
        $studentRow = mysqli_fetch_assoc($studentQuery);

        $_SESSION['studentID'] = $studentRow['studentID'];
        $_SESSION['fullname'] = $studentRow['fullname'];
        $_SESSION['type'] = 'student';
        // header("location: index.php");
        echo "<script>
                setTimeout(function() {
                    alert('Login successful!');
                    window.location.href = '/psm/student/index.php';
                }, 500);
              </script>";
    }
    else {
        // Check if the user is an admin
        $adminQuery = mysqli_query($conn, "SELECT adminID, admin_name FROM administrator WHERE email = '$email' AND passwords = '$password'");
        if(mysqli_num_rows($adminQuery)) {
            $adminRow = mysqli_fetch_assoc($adminQuery);

            $_SESSION['adminID'] = $adminRow['adminID'];
            $_SESSION['admin_name'] = $adminRow['admin_name'];
            $_SESSION['type'] = 'admin';
            header("location: ../admin/adminindex.php");
        }
        else {
            echo "<script>alert('Invalid Email or Password');</script>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="./css/style.css"> -->
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
        <form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <label for="email">Email</label>
            <input type="email" placeholder="Enter your email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Enter your password" id="passwords" name="passwords" required>

            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="Login" value="login">Login</button>
            <p>Don't have an account? <a href="../student/signupstud.php">Sign up</a></p>
        </form>
    </div>
</body>

</html>