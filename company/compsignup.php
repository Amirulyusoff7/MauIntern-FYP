<?php
require_once "../config.php";
// require_once "../navbar/comp-header.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="../css/compreg.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Email Validation Style -->
    <style>
        span.error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }

        span.success {
            color: green;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>


</head>

<?php
	require_once "../navbar/sidebar.php";
	?>

<title>Company Registration </title>

<body>
    <div class="container">
        <!-- <header>Registration For company</header> -->
        <h1>Registration For company</h1>
        <form action="../company/process_form.php" method="POST">
            <div class="form first">
                <div class="details ID">
                    <span class="title">Company Details</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Company Name</label>
                            <input type="text" placeholder="Enter Company Name" id="company_name" name="company_name" required>
                        </div>

                        <div class="input-field">
                            <label>Email Company</label>
                            <input type="email" placeholder="Enter company email" id="emailCompany" name="emailCompany" required>
                            <span id="emailCompanyStatus"></span>
                            <script>
                                $(document).ready(function() {
                                    $('#emailCompany').on('keyup', function() {
                                        var email = $(this).val();
                                        $.ajax({
                                            type: 'POST',
                                            url: '../company/check_email_company.php',
                                            data: {
                                                email: email
                                            },
                                            success: function(response) {
                                                $('#emailCompanyStatus').html(response);
                                            }
                                        });
                                    });
                                });
                            </script>
                        </div>

                        <div class="input-field">
                            <label>Customer Service Contact Number</label>
                            <input type="text" placeholder="Enter Company number" id="custServiceNum" name="custServiceNum" required>
                        </div>

                        <div class="input-field">
                            <label>Industry</label>
                            <select id="industry" name="industry">
                                <option value="select" disabled selected>select</option>
                                <option value="Finance and Banking">Finance and Banking</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="E-commerce and Retail">E-commerce and Retail</option>
                                <option value="Manufacturing and Logistics">Manufacturing and Logistics</option>
                                <option value="Telecommunications">Telecommunications</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <label>Website Link</label>
                            <input type="text" placeholder="Enter Company Website" id="website" name="website" required>
                        </div>

                        <div class="input-field">
                            <label>Address</label>
                            <input type="textarea" placeholder="Optional" id="address" name="address">
                        </div>
                    </div>
                    <button class="nextBtn">
                        <span class="btnText">Next</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                    <p>Already have an account? <a href="../company/piclogin.php">Login</a></p>
                </div>
            </div>


            <div class="form second">
                <div class="details personal">
                    <span class="title">Person In Charge Details</span>
                    <div class="fields">
                        <div class="input-field">
                            <label>Full Name</label>
                            <input type="text" placeholder="Enter your name" id="PICName" name="PICName" required>
                        </div>

                        <div class="input-field">
                            <label>Email</label>
                            <input type="email" placeholder="Enter your email" id="PICemail" name="PICemail" required>
                            <span id="email-error"></span>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $('#PICemail').on('keyup', function() {
                                    var email = $(this).val();
                                    $.ajax({
                                        type: 'POST',
                                        url: '../company/check_email_company.php',
                                        data: {
                                            email: email
                                        },
                                        success: function(response) {
                                            $('#email-error').html(response);
                                        }
                                    });
                                });
                            });
                        </script>


                        <div class="input-field">
                            <label>Mobile Number</label>
                            <input type="text" placeholder="Enter mobile number" id="PICphoneNum" name="PICphoneNum" required>
                        </div>

                        <div class="input-field">
                            <label>Password</label>
                            <input type="password" placeholder="Password" id="PICpassword" name="PICpassword" required>
                        </div>

                        <div class="input-field">
                            <label>Confirm Password</label>
                            <input type="password" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="input-field">
                            <p>Your password must be mix of lowercase,uppercase, numbers and special characters: (*/!#$%^&)</p>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="backBtn">
                            <i class="uil uil-navigator"></i>
                            <span class="btnText">Back</span>
                        </div>

                        <button class="sumbit" type="submit" name="submit">
                            <span class="btnText">Register</span>
                            <i class="uil uil-navigator"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="../js/compreg.js"></script>
</body>

</html>