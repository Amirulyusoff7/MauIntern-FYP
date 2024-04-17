              <?php
              session_start();

              include('../config.php');
              // Retrieve student table from the database

              // $query = "SELECT s.*, sk.* FROM student s
              //           JOIN skill sk ON s.studentID = sk.studentID
              //           WHERE s.studentID = '{$_SESSION['studentID']}'";

              // $query = "SELECT c.*, i.* FROM company c
              //           JOIN internship i ON c.companyID = i.companyID
              //           WHERE c.companyID = '{$_SESSION['companyID']}'";

              $query = "SELECT * FROM company where companyID = '{$_SESSION['companyID']}'";

              $result = mysqli_query($conn, $query);
              $company = mysqli_fetch_assoc($result);
              // $decodedImageData = base64_decode($student['image']);

              ?>

              <!DOCTYPE html>
              <html>

              <head>

                <!-- Required meta tags -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

                <!-- BOOTSTRAP & MY OWN CSS -->
                <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
                <!-- <link rel="stylesheet" type="text/css" href="../psm/css/indexstyle.css"> -->
                <!-- <link rel="stylesheet" type="text/css" href="../css/studprofile.css"> -->
                <link rel="stylesheet" type="text/css" href="../css/companystyle.css">

                <style>
                  .row {
                    margin-bottom: 20px;
                  }

                  .col-md-4 {
                    padding: 10px;
                  }

                  .skill-card {
                    background-color: #f8f9fa;
                    border: 1px solid #ced4da;
                    border-radius: 5px;
                    padding: 10px;
                    height: 100%;
                  }

                  .skill-card h4 {
                    margin-top: 0;
                  }

                  .skill-card p {
                    margin-bottom: 5px;
                  }
                </style>
                <title>Company Profile</title>

              <body>
                <?php
                require_once "../navbar/comp-header.php";
                ?>

                <!-- JS -->
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

                <div class="container" id="company-info">
                  <h2>Company Information <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateModal_<?php echo $_SESSION['companyID']; ?>">Edit Info</button></h2>
                  <p><strong>Company Name:</strong> <?php echo $company['company_name']; ?></p>
                  <p><strong>Company Email:</strong> <?php echo $company['emailCompany']; ?></p>
                  <p><strong>Company Website:</strong> <?php echo $company['website']; ?></p>
                  <p><strong>Customer Service Number:</strong> <?php echo $company['custServiceNum']; ?></p>
                  <p><strong>Company Address:</strong> <?php echo $company['address']; ?></p>
                  <p><strong>Industry:</strong> <?php echo $company['industry']; ?></p>
                </div>
                <br>
                <div class="container" id="PIC-info">
                  <h2>Person In Charge Information <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updatePICModal_<?php echo $_SESSION['companyID']; ?>"> Edit Info </button></h2>
                  <p><strong>Name:</strong> <?php echo $company['PICName']; ?></p>
                  <p><strong>Contact Number:</strong> <?php echo $company['PICphoneNum']; ?></p>
                  <p><strong>Email:</strong> <?php echo $company['PICemail']; ?></p>
                </div>

                <!-- Update Modal for Company Info -->
                <div class="modal fade" id="updateModal_<?php echo $_SESSION['companyID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel_<?php echo $_SESSION['companyID']; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel_<?php echo $_SESSION['companyID']; ?>">Update Company Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/psm/company/update-company-process.php" method="POST">
                          <input type="hidden" name="companyID" value="<?php echo $_SESSION['companyID']; ?>">
                          <div class="form-group">
                            <label for="update_company_name">Company Name:</label>
                            <input type="text" class="form-control" id="update_company_name" name="update_company_name" value="<?php echo $company['company_name']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="update_emailCompany">Email Company:</label>
                            <input type="text" class="form-control" id="update_emailCompany" name="update_emailCompany" value="<?php echo $company['emailCompany']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="update_website">Website:</label>
                            <input type="text" class="form-control" id="update_website" name="update_website" value="<?php echo $company['website']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="update_custServiceNum">Customer Service Number:</label>
                            <input type="text" class="form-control" id="update_custServiceNum" name="update_custServiceNum" value="<?php echo $company['custServiceNum']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="update_address">Address:</label>
                            <input type="text" class="form-control" id="update_address" name="update_address" value="<?php echo $company['address']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="update_industry">Industry:</label>
                            <select class="form-control" id="update_industry" name="update_industry" required>
                              <option value="select" disabled selected>select</option>
                              <option value="Finance and Banking" <?php if ($company['industry'] === 'Finance and Banking') echo 'selected'; ?>>Finance and Banking</option>
                              <option value="Healthcare" <?php if ($company['industry'] === 'Healthcare') echo 'selected'; ?>>Healthcare</option>
                              <option value="E-commerce and Retail" <?php if ($company['industry'] === 'E-commerce and Retail') echo 'selected'; ?>>E-commerce and Retail</option>
                              <option value="Manufacturing and Logistics" <?php if ($company['industry'] === 'Manufacturing and Logistics') echo 'selected'; ?>>Manufacturing and Logistics</option>
                              <option value="Telecommunications" <?php if ($company['industry'] === 'Telecommunications') echo 'selected'; ?>>Telecommunications</option>
                              <option value="Other" <?php if ($company['industry'] === 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                          </div>

                          <button type="submit" class="btn btn-primary" name="submit" value="submit">Save Changes</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>


                     <!-- Update Modal for PIC Info  -->
                     <div class="modal fade" id="updatePICModal_<?php echo $_SESSION['companyID']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel_<?php echo $_SESSION['companyID']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel_<?php echo $_SESSION['companyID']; ?>">Update PIC Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/psm/company/update-pic-process.php" method="POST">
                                        <input type="hidden" name="companyID" value="<?php echo $_SESSION['companyID']; ?>">
                                        <div class="form-group">
                                            <label for="update_PICName">PIC Name:</label>
                                            <input type="text" class="form-control" id="update_PICName" name="update_PICName" value="<?php echo $company['PICName']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="update_PICphoneNum">PIC Contact Number:</label>
                                            <input type="text" class="form-control" id="update_PICphoneNum" name="update_PICphoneNum" value="<?php echo $company['PICphoneNum']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="update_PICemail">PIC Email:</label>
                                            <input type="text" class="form-control" id="update_PICemail" name="update_PICemail" value="<?php echo $company['PICemail']; ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="submit" value="submit">Save Changes</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

</body>

</html>