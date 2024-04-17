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

    <style>
        /* Style for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        /* Style for the links in the sidebar */
        .sidebar a {
            padding: 10px 16px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
        }

        /* Change color on hover */
        .sidebar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Style for the logo image */
        .logo-img {
            width: 100px; /* Adjust the width as needed */
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Style for the logout button */
        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 100%;
            text-align: left;
        }
    </style>

    <script>
        function redirectToPage(pageUrl) {
            window.location.href = pageUrl;
        }
    </script>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Logo container within the sidebar -->
        <div class="logo-container">
            <div class="logo1">
                <img src="/psm/img/logo.png" width="80" height="80" alt="logo" class="logo-img">
            </div>
        </div>
        <!-- Sidebar links -->
        <a href="/psm/student/index.php">Home</a>
        <a href="/psm/student/intern-applied.php">Internship Application</a>
        <a href="/psm/student/studprofile.php">Student Profile</a>
        <a href="/psm/student/studskill.php">Student Skill</a>
        <!-- Logout button -->
        <div class="logout-btn">
            <button class="btn btn-danger" onclick="location.href='../student/logout.php'">Logout</button>
        </div>
    </div>

    <!-- Content -->
    <div style="margin-left: 250px; padding: 15px;">
    </div>

    <br>
</body>

</html>
