<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="\psm/css/header.css">
    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="../css/comp-header.css"> -->

    <script>
        function redirectToPage(pageUrl) {
            window.location.href = pageUrl;
        }
    </script>
</head>

<body>
    <!-- <header> -->
        <!-- <div class="logo-container">
            <a href="/psm/index.php">
                <div class="logo1">
                    <img src="/psm/img/logo.png" width="80" height="80" alt="logo" class="logo-img">
                </div>
            </a>
        </div> -->

        <div class="header">
        <div class="logo-container">
                <div class="logo1">
                    <img src="/psm/img/logo.png" width="80" height="80" alt="logo" class="logo-img">
                </div>
        </div>
        <div>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm')">Home</button>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/careertips.php')">Career Tips</button>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/cover-letter.php')">Cover Letter Template</button>
            <button class="btn btn-info" onclick="redirectToPage('\\psm/student/studentlogin.php')">Student Login</button>
            <button class="btn btn-info" onclick="redirectToPage('\\psm/company/piclogin.php')">Company Login</button>
            <!-- <button class="btn btn-dark" onclick="redirectToPage('\\psm/admin/adminlogin.php')">Admin Login</button> -->
        </div>
        </div>
    <!-- </header>  -->
    <br>
</body>

</html>
