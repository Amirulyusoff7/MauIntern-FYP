<!DOCTYPE html>
<html>

<head>
    <title>Internship Posting Form</title>
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- BOOTSTRAP & MY OWN CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../psm/css/indexstyle.css">
    <link rel="stylesheet" type="text/css" href="../css/studprofile.css">

    <title>Internship Posting Form</title>
    <style>
        .container {
            max-width: 500px;
            margin: 0 auto;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group.required label:after {
            content: '*';
            color: red;
            margin-left: 5px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Internship Posting Form</h2>
        <form action="../company/process-intern-details.php" method="POST">
            <!-- Internship Details -->
            <div class="form-group required">
                <label for="title">Internship Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group required">
                <label for="description">Internship Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group required">
                <label for="duration">Duration</label>
                <input type="text" class="form-control" id="duration" name="duration" required>
            </div>
            <div class="form-group required">
                <label for="StartDate">Start Date</label>
                <input type="date" class="form-control" id="StartDate" name="StartDate" required>
            </div>
            <div class="form-group required">
                <label for="EndDate">End Date</label>
                <input type="date" class="form-control" id="EndDate" name="EndDate" required>
            </div>
            <div class="form-group required">
                <label for="Status">Status</label>
                <select class="form-control" id="Status" name="Status" required>
                    <option value="Select Status" disabled selected>Select Status</option>
                    <option value="Offering">Offering</option>
                    <option value="Not Offering">Not Offering</option>
                </select>
            </div>
            <!-- Hidden Field for Company ID -->
            <input type="hidden" name="companyID" value="<?php echo $companyID; ?>">
            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-submit" name="submit">Submit</button>
            </div>
        </form>
    </div>


</body>

</html>