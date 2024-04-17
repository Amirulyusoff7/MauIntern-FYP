<?php
session_start();
include('../config.php');

if(isset($_POST['Login']))
{
    $query = mysqli_query($conn, "SELECT admin_name, email, passwords FROM administrator WHERE email  = '".$_POST['email']."' && passwords = '".$_POST['passwords']."'");
    if(mysqli_num_rows($query)) {
        $row=mysqli_fetch_assoc($query);

        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] = $row['admin_name'];
        $_SESSION['type'] = 'admin';
        header("location:adminindex.php");
	}
	 else
	{
	 echo "<script>alert('Invalid Email or Password');</script>";
	} 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" type="text/css" href="../css/studlogin.css">

    <?php
    require_once "../navbar/index-header.php";
    ?>
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="email">PIC Email</label>
            <input type="email" placeholder="Enter your email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" placeholder="Enter your password" id="passwords" name="passwords" required>

            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <button type="submit" name="Login">Login</button>
            <!-- <p>Don't have an account? <a href="../company/compsignup.php">Sign up</a></p> -->
        </form>
    </div>
</body>
</html>
