<?php

session_start();
include('../config.php');

// Get the count of registered students
$studentCountQuery = "SELECT COUNT(*) AS registeredStudents FROM student";
$studentCountResult = mysqli_query($conn, $studentCountQuery);
$studentCountData = mysqli_fetch_assoc($studentCountResult);
$studentCount = $studentCountData['registeredStudents'];

// Get the count of applied student
$applicationCountQuery = "SELECT COUNT(DISTINCT studentID) AS AppliedStudent FROM application";
$applicationCountResult = mysqli_query($conn, $applicationCountQuery);
$applicationCountData = mysqli_fetch_assoc($applicationCountResult);
$applicationCount = $applicationCountData['AppliedStudent'];

// Get the count of total internship
$internshipCountQuery = "SELECT COUNT(*) as interCount FROM internship";
$internshipCountResult = mysqli_query($conn, $internshipCountQuery);
$internshipCountData = mysqli_fetch_assoc($internshipCountResult);
$internshipCount = $internshipCountData['interCount'];

// Get the count of total company
$companyCountQuery = "SELECT COUNT(*) as companyCount FROM company";
$companyCountResult = mysqli_query($conn, $companyCountQuery);
$companyCountData = mysqli_fetch_assoc($companyCountResult);
$companyCount = $companyCountData['companyCount'];

// Fetch the latest student
$latestStudentQuery = "SELECT * FROM student ORDER BY studentID DESC LIMIT 1";
// Execute the query and retrieve the student data
$latestStudentResult = mysqli_query($conn, $latestStudentQuery);
$latestStudent = mysqli_fetch_assoc($latestStudentResult);

// Fetch the latest application
$latestAppliedQuery = "SELECT i.title AS title, a.DateApplied AS DateApplied FROM application a JOIN internship i ON a.internshipID = i.internshipID ORDER BY applicationID DESC LIMIT 1";
// Execute the query and retrieve the application data
$latestAppliedResult = mysqli_query($conn, $latestAppliedQuery);
$latestApplied = mysqli_fetch_assoc($latestAppliedResult);

// Fetch the latest company
$latestCompanyQuery = "SELECT * FROM company ORDER BY companyID DESC LIMIT 1";
// Execute the query and retrieve the recruiter data
$latestCompanyResult = mysqli_query($conn, $latestCompanyQuery);
$latestCompany = mysqli_fetch_assoc($latestCompanyResult);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .welcome-heading {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .users-heading {
            font-size: 24px;
            font-weight: bold;
            color: #555;
            margin-bottom: 20px;
        }

        .card {
            transition: background-color 0.3s;
        }

        .card:hover {
            background-color: #FFFFFF;
            cursor: pointer;
        }

        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            font-size: 16px;
            color: #555;
        }

        .latest-user-section {
            display: flex;
            flex-direction: row;
            gap: 30px;
            align-items: center;
            justify-content: space-between;
            margin-top: 30px;
        }

        .latest-user-card {
            background-color: #F8F9FA;
            border: none;
        }

        .latest-user-card .card-body {
            padding: 20px;
        }

        .latest-user-card .card-title {
            margin-bottom: 15px;
        }

        .latest-user-card .card-text {
            margin-bottom: 8px;
        }

        .latest-user-card .card-text:last-child {
            margin-bottom: 0;
        }

        .latest-user-card .user-details {
            display: flex;
            flex-direction: column;
        }

        .latest-user-card .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
        }

        .latest-user-card .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #student-chart {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: solid;
        }
    </style>
</head>
<body>
    <?php 
    
    require_once "../navbar/admin-header.php"; 
    
    ?>
    
            <main>
            <div class="container mt-5">
                    <h1 class="welcome-heading">Dashboard</h1>

                    <h2 class="users-heading">Registered Student</h2>

                    <div class="row">
                                    <canvas id="student-chart"></canvas>
                    </div>

                    <div class="latest-user-section">
                        <div class="col-md-4">
                            <div class="latest-user-card">
                                <div class="card-body">
                                    <h5 class="card-title">Latest Registered Student</h5>
                                    <?php if ($latestStudent) : ?>
                                        <div class="user-details">
                                            <p class="card-text">Name: <?php echo $latestStudent['fullname']; ?></p>
                                            <p class="card-text">Email: <?php echo $latestStudent['email']; ?></p>
                                        </div>
                                    <?php else : ?>
                                        <p class="card-text">No data found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="latest-user-card">
                                <div class="card-body">
                                    <h5 class="card-title">Latest Application</h5>
                                    <?php if ($latestApplied) : ?>
                                        <div class="user-details">
                                            <p class="card-text">Internship Title: <?php echo $latestApplied['title']; ?></p>
                                            <p class="card-text">Date Applied: <?php echo $latestApplied['DateApplied']; ?></p>
                                        </div>
                                    <?php else : ?>
                                        <p class="card-text">No data found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="latest-user-card">
                                <div class="card-body">
                                    <h5 class="card-title">Latest Company</h5>
                                    <?php if ($latestCompany) : ?>
                                        <div class="user-details">
                                            <p class="card-text">Company Name: <?php echo $latestCompany['company_name']; ?></p>
                                            <p class="card-text">Person In Charge Name: <?php echo $latestCompany['PICName']; ?></p>
                                        </div>
                                    <?php else : ?>
                                        <p class="card-text">No data found.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.0"></script>
    <script>
        var ctx = document.getElementById('student-chart').getContext('2d');
        var usersChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Registered Students', 'Student Who Apply', 'Total of Internship', 'Total of Company'],
                datasets: [{
                    // label: 'Students Application',
                    data: [
                        <?php echo $studentCount; ?>,
                        <?php echo $applicationCount; ?>,
                        <?php echo $internshipCount; ?>,
                        <?php echo $companyCount; ?>
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }
                }
            }
        });
    </script>

<?php include('../navbar/footer.php'); ?>

</body>
</html>
