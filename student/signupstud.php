<?php
require_once "../config.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


	<?php
	require_once "../navbar/sidebar.php";
	?>

		<style>

			/* New styles for the instruction box */
			.col {
				background-color: #FFBCC4;
				padding: 20px;
				border-radius: 5px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				width: 5px; /* Adjust the width of the instruction box as desired */
				margin-top: 10px;
			}

			/* Optional: Style the heading and paragraph in the instruction box */
			.instruction-box h2 {
				margin-top: 10px;
			}
		</style>

</head>
<body>
	<div class="container text-center">
		<div class="row">
			<div class="col">
				<h2>Instructions to Register</h2>
        		<p>1. Enter your full name with all capital letter </p>
				<p>2. Email must follow the format xxx@xxx.com </p>
				<p>3. Your password must be mix of lowercase,  
				<p>uppercase, numbers and special characters: </p>
				<p>(*/!#$%^&)</p>
				<p>4. Phone Number must without "-" </p>

			</div>
		</div>
	
			<div class="register-box">
			<h1>Student Registration</h1>
			<form action="../student/register-student.php" method="post">

				<label for="email">Email</label>
				<input type="email" placeholder="Example: abc@gmail.com" id="email" name="email" required>
				<span id="emailStatus"></span>

				<script>
					$(document).ready(function() {
					$('#email').on('keyup', function() {
						var email = $(this).val();
						$.ajax({
						type: 'POST',
						url: '../student/check_email.php',
						data: { email: email },
						success: function(response) {
							$('#emailStatus').html(response);
						}
						});
					});
					});
				</script>
				<br>
				<label for="password">Password</label>
				<input type="password" placeholder="!Abc12345" id="passwords" name="passwords" required>
				
				<label for="confirm_password">Confirm Password</label>
				<input type="password" id="confirm_password" name="confirm_password" required>
				
				<label for="fullname">Full Name</label>
				<input type="text" placeholder="AMIRUL BIN YUSOFF" id="fullname" name="fullname" required>

				<label for="phoneNum">Phone Number</label>
				<input type="text" placeholder="0122567208" id="phoneNum" name="phoneNum" required>
				
				<label for="address">Address</label>
				<textarea id="address" name="address" required></textarea>
				<br>
				<label for="programme">Programme</label>
				<select name="programme" required>
					<option value="select" disabled selected>select</option>
					<option value="BITD">BITD</option>
					<option value="BITI">BITI</option>
					<option value="BITZ">BITZ</option>
					<option value="BITM">BITM</option>
					<option value="BITS">BITS</option>
				</select>

				<label for="YearOfStudy">Year Of Study</label>
				<select name="YearOfStudy" required>
					<option value="select" disabled selected>select</option>
					<option value="Year 1">Year 1</option>
					<option value="Year 2">Year 2</option>
					<option value="Year 3">Year 3</option>
					<option value="Year 4">Year 4</option>
				</select>

				<label for="CGPA">CGPA</label>
				<input type="text" id="CGPA" name="CGPA" required placeholder="Example: 3.5">

				<input type="submit" value="Register" name="submit">
				<p>Already have an account? <a href="studentlogin.php">Login</a></p>
			</form>
			</div>
	</div>

</body>
</html>
