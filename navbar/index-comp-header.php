<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">
    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="../css/indexstyle.css"> -->
    <link rel="stylesheet" type="text/css" href="../css/comp-header.css">

    <script>
        function redirectToPage(pageUrl) {
            window.location.href = pageUrl;
        }
    </script>
</head>

<body>
    <header>
        <a href="/psm/index.php">
            <div class="logo1">
                <img src="/psm/img/logo.png" width="80" height="80" alt="logo" class="logo-img">
            </div>
        </a>

        <div class="header">
            <button class="btn btn-dark" onclick="redirectToPage('../company/index.php')">Home</button>
            <button class="btn btn-dark" onclick="redirectToPage('../company/dashboard.php')">Dashboard</button>
            <button class="btn btn-dark" onclick="redirectToPage('../company/company-profile.php')">Company Profile</button>
            <button class="btn btn-dark" onclick="redirectToPage('../company/INTERNTEST.php')">Intern Posting</button>
            <!-- <button class="btn btn-dark dropdown-toggle" type="button" id="profileDropdown" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Profile
                </button>
                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="/psm/student/studprofile.php">Student Profile</a>
                    <a class="dropdown-item" href="/psm/student/studinfo.php">Student Information</a>
                    <a class="dropdown-item" href="/psm/student/studskill.php">Student Skill</a>
                    <a class="dropdown-item" href="/psm/student/studeducation.php">Student Education</a> 
                </div>  -->
        </div>
        <!-- <button  class="btn btn-danger" onclick="location.href='../company/logout.php'" type="button">Logout</button> -->

    </header>
    <br>
</body>

</html>
