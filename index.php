<?php
include('./config.php'); // Include the database connection file

// Pagination settings
$internshipsPerPage = 9;
$currentpage = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($currentpage - 1) * $internshipsPerPage;

$query = "SELECT i.internshipID AS internshipID, i.title AS title, i.intern_description AS description, i.Status AS Status, 
c.company_name AS CompanyName, c.address AS Address, c.industry AS Industry
FROM internship i 
INNER JOIN company c ON i.companyID = c.companyID
WHERE i.Status = 'Offering'
ORDER BY i.internshipID DESC
LIMIT $start, $internshipsPerPage;";

$result = mysqli_query($conn, $query);
$internships = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Get total number of internships for pagination
$totalInternshipsQuery = "SELECT COUNT(*) AS total FROM internship WHERE Status = 'Offering'";
$totalResult = mysqli_query($conn, $totalInternshipsQuery);
$row = mysqli_fetch_assoc($totalResult);
$totalInternships = $row['total'];
$totalPages = ceil($totalInternships / $internshipsPerPage);
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/indexstyle.css">

    <style>
        .search-bar {
            margin-bottom: 20px;
        }

        .search-bar .input-group {
            width: 300px;
            margin: 0 auto;
        }

        .search-bar input[type="text"] {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .search-bar .btn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
    </style>

</head>
<title>Home Page</title>

<body>
    <?php
    // require_once "./navbar/index-header.php";
    require_once "./navbar/sidebar.php";
    ?>

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <main>
        <div class="index-container">
            <div class="career-tips">
                <div class="card-body">
                    <h1 class="card-title"><a href="./careertips.php">Career Tips</a></h1>
                    <h1 class="card-title"><a href="./cover-letter.php">Career Development Resources</a></h1>
                    <div class="card-footer">
                        <p>&copy; 2023 MauIntern All rights reserved.</p>
                        <p>Terms of Service | Privacy Policy</p>
                    </div>
                </div>
            </div>


            <div class="intern-content">

                <div class="search-barr">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search internships">
                        <div class="input-group-append">
                            <select class="form-control" id="industryFilter">
                                <option value="">All Industries</option>
                                <option value="Finance and Banking">Finance and Banking</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="E-commerce and Retail">E-commerce and Retail</option>
                                <option value="Manufacturing and Logistics">Manufacturing and Logistics</option>
                                <option value="Telecommunications">Telecommunications</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="container">
                    <div class="row gy-3" id="internship-row">
                        <?php foreach ($internships as $internship) { ?>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $internship['title']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $internship['CompanyName']; ?></h6>
                                        <p class="card-text"><?php echo $internship['description']; ?></p>
                                        <p class="card-text industry"><?php echo $internship['Industry']; ?></p>
                                        <a href="./apply-intern.php?internshipID=<?php echo $internship['internshipID']; ?>" class="btn btn-primary">View to Apply</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Internship Pagination">
                        <ul class="pagination justify-content-center">
                            <?php if ($currentpage > 1) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentpage - 1; ?>">Previous</a>
                                </li>
                            <?php } ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?php echo ($i == $currentpage) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>

                            <?php if ($currentpage < $totalPages) { ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentpage + 1; ?>">Next</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </main>


    <script>
        $(document).ready(function() {
            $('#searchInput, #industryFilter').on('input change', function() {
                var searchValue = $('#searchInput').val().trim();
                var selectedIndustry = $('#industryFilter').val();

                // Perform search based on the searchValue and selectedIndustry
                // You can use AJAX to fetch search results from the server

                // Example: Filtering internship cards based on searchValue and selectedIndustry
                $('.card').each(function() {
                    var cardText = $(this).text().toLowerCase();
                    var cardIndustry = $(this).find('.card-text.industry').text().toLowerCase();

                    var showCard = cardText.includes(searchValue.toLowerCase()) && (selectedIndustry === '' || cardIndustry.includes(selectedIndustry.toLowerCase()));

                    if (showCard) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });

                // Move the matching cards to the top
                var matchedCards = $('.card:visible');
                $('#internship-row').empty();

                for (var i = 0; i < matchedCards.length; i += 3) {
                    var row = $('<div class="row gy-3"></div>');

                    for (var j = i; j < i + 3 && j < matchedCards.length; j++) {
                        var column = $('<div class="col-4"></div>');
                        column.append(matchedCards[j]);
                        row.append(column);
                    }

                    $('#internship-row').append(row);
                }
            });
        });
    </script>
</body>
<?php include('./navbar/footer.php'); ?>
</html>
