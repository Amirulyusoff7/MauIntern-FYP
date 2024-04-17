<?php
require_once "../config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	<?php
	require_once "../navbar/index-header.php";
	?>

		<style>
            .registration-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .registration-form label,
        .registration-form input {
            display: block;
            margin-bottom: 10px;
        }

        .registration-form input[type="email"],
        .registration-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .registration-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .registration-form button:hover {
            background-color: #45a049;
        }
            .register-box {
            display: grid;
            grid-template-columns: repeat(4, 0.7fr);
            grid-template-rows: 0.5fr 6fr 1fr;
            grid-column-gap: 5px;
            grid-row-gap: px;
            }

            .title-instruction { 
                grid-area: 1 / 2 / 2 / 3;
                background-color: #FFB7C0; 
            }
            .title-register { 
                grid-area: 1 / 3 / 2 / 4; 
                /* background-color: #E4DEDE;  */
            }
            .instruction-content { 
                grid-area: 2 / 2 / 3 / 3; 
                height: auto;
                background-color: #FFB7C0; `    
            }
            .register-content { 
                grid-area: 2 / 3 / 3 / 4; 
                border: 10px;
                padding: 10px;
                /* background-color: #E4DEDE;  */
            }
		</style>

</head>
<body>

<div class="register-box">
        <div class="title-instruction"> 
        <h2>Instructions to Register</h2>
        </div>
        <div class="title-register"> 
        <h1>Student Registration</h1>
        </div>
        <div class="instruction-content">
                <p>1. Your username must be unique. </p>
				<p>2. Your password must be mix of lowercase,  </p>
				<p>uppercase, numbers and special characters: </p>
				<p>(*/!#$%^&)</p>
        </div>
        <div class="register-content"> 
			<div class="registration-form">
			<form action="../admin/register-admin-process.php" method="post">

            <label for="Email">Email:</label>
            <input type="email" id="email" name="email" required>
				<br>
				<label for="password">Password</label>
				<input type="password" placeholder="!Abc12345" id="passwords" name="passwords" required>
				
				<label for="confirm_password">Confirm Password</label>
				<input type="password" id="confirm_password" name="confirm_password" required>

				<input type="submit" value="Register" name="submit">
				<p>Already have an account? <a href="../admin/adminlogin.php">Login</a></p>
			</form>
			</div>
        </div>
</div>

</body>
</html>
