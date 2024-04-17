<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/indexstyle.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <?php
    include('./config.php');
    // require_once "./navbar/header.php";
    require_once "./navbar/sidebar.php";

    $query = "SELECT * FROM administrator";
    $result = mysqli_query($conn, $query);
    // $admin = mysqli_fetch_assoc($result);
    ?>

</head>
<title>Career Tips</title>
            <style>
            .parent {
            display: grid;
            grid-template-columns: 1fr repeat(2, 2.5fr) 1fr;
            grid-template-rows: 1fr 2fr 1fr;
            grid-column-gap: 0px;
            grid-row-gap: 0px;
            }

            .div1 { grid-area: 1 / 1 / 2 / 5; }
            .div2 { grid-area: 2 / 2 / 3 / 3; }
            .div3 { grid-area: 2 / 3 / 3 / 4; }
            </style>
<body>

<div class="parent">
            <div class="div1"></div>
            <div class="div2"> 
                            <h2>Contact Info</h2>
                            <?php
                                $adminCount = mysqli_num_rows($result); // Get the number of admins
                                $counter = 0; // Initialize a counter

                                while ($admin = mysqli_fetch_assoc($result)) {
                                    echo "<p>Admin Name: {$admin['admin_name']}</p>";
                                    echo "<p>Admin Phone Number: {$admin['phoneNumber']}</p>";
                                    echo "<p>Admin Email: {$admin['email']}</p>";
                                    
                                    // If there's more than one admin and it's not the last iteration
                                    if ($adminCount > 1 && $counter < $adminCount - 1) {
                                        echo "<p>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Or</p>";
                                    }
                                    
                                    $counter++; // Increment the counter
                                }
                            ?>
            </div>
            <div class="div3"><img src="./img/support.jpg" alt="Girl in a jacket" width="500" height="400"> </div>
</div>



</body>

</html>
