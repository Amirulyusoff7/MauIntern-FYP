<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">
    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">

    <script>
        function redirectToPage(pageUrl) {
            window.location.href = pageUrl;
        }
    </script>
</head>

<body>
    <header>
            <div class="logo1">
                <img src="/psm/img/logo.png" width="80" height="80" alt="logo" class="logo-img">
            </div>


        <div class="header">
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/student/')">Home</button>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/student/intern-applied.php')">Intern Applied</button>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/student/studprofile.php')">Student Profile</button>
            <button class="btn btn-dark" onclick="redirectToPage('\\psm/student/studskill.php')">Student Skills</button>
        </div>
        <!-- <form method="POST" action="../student/logout.php">
            <input type="submit" name="Logout" value="Logout">
        </form> -->

        <!-- <button  class="btn btn-danger" onclick="location.href='../student/logout.php'" type="button">Logout</button> -->

    </header>
    <br>
</body>

</html>
