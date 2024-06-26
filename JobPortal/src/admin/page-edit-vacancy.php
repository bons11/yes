<?php
include 'date_end.php';
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style/styles.css" />
    <title>EBB Admin</title>
    <link href="img/bugallon-seal.png" rel="icon">
</head>
<body>

    <style>
        /* Add custom styles for the scrollable content area */
        #page-content-wrapper {
            overflow-y: auto;
            max-height: calc(100vh - 56px); /* Adjust according to your header's height */
        }
    </style>
    
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Admin Panel
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="page-dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="page-company.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-building me-2"></i>Company
                </a>
                <a href="page-vacancy.php" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-clipboard me-2"></i>Vacancy
                </a>
                <a href="page-inquiry.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-address-card me-2"></i>Inquiry
                </a>
                <a href="page-applicants.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-file me-2"></i>Applicants
                </a>
                <a href="page-category.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-layer-group me-2"></i>Category
                </a>
                <a href="job-owner-request.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-envelope me-2"></i>Owner Requests
                </a>
                <a href="page-user-list.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-users me-2"></i>Manage Users
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                    class="fas fa-power-off me-2"></i>Logout
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

    <!-- Page content wrapper -->
    <div id="page-content-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
        <div class="d-flex align-items-center">
            <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
            <h2 class="fs-2 m-0">Edit Vacancy</h2>
        </div>

    </nav>
        <!-- /Top navigation bar -->

        <!-- Main content container -->
        <div class="container mt-5">
            <!-- Edit user form -->
            <div class="bg-light p-4 rounded">
            <?php
                include '../auth/php/config.php';

                if (isset($_GET['uid']) && !empty($_GET['uid'])) {
                    $uid = mysqli_real_escape_string($con, $_GET['uid']);
                    $query_vacancy = "SELECT * FROM tbl_vacancy WHERE uid = '$uid'";
                    $result_vacancy = mysqli_query($con, $query_vacancy);

                    if ($result_vacancy && mysqli_num_rows($result_vacancy) > 0) {
                        $vacancy = mysqli_fetch_assoc($result_vacancy);
                        $job_number = $vacancy['job_number'];
                        $query_responsibility = "SELECT * FROM tbl_responsibility WHERE job_number = '$job_number'";
                        $result_responsibility = mysqli_query($con, $query_responsibility);
                        $responsibility = mysqli_fetch_assoc($result_responsibility);
                        $query_qualification = "SELECT * FROM tbl_qualification WHERE job_number = '$job_number'";
                        $result_qualification = mysqli_query($con, $query_qualification);
                        $qualification = mysqli_fetch_assoc($result_qualification);
                ?>
                        <form action="edit-vacancy.php" method="POST">

                        <input type="hidden" name="job_number" value="<?php echo $vacancy['job_number']; ?>"> <!-- Add this line to include job_number -->
                            <div class="mb-3">
                                <label for="company_category" class="form-label">Company Category</label>
                                <select class="form-select" id="company_category" name="company_category" required>
                                    <?php
                                    // Fetch data from tbl_category and populate the dropdown
                                    $category_query = "SELECT category FROM tbl_category";
                                    $category_result = mysqli_query($con, $category_query);
                                    while ($row = mysqli_fetch_assoc($category_result)) {
                                        $selected = ($row['category'] == $vacancy['company_category']) ? 'selected' : '';
                                        echo "<option value='" . $row['category'] . "' $selected>" . $row['category'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <select class="form-select" id="company_name" name="company_name" required>
                                    <?php
                                    // Fetch data from tbl_company and populate the dropdown
                                    $company_query = "SELECT company_name FROM tbl_company";
                                    $company_result = mysqli_query($con, $company_query);
                                    while ($row = mysqli_fetch_assoc($company_result)) {
                                        $selected = ($row['company_name'] == $vacancy['company_name']) ? 'selected' : '';
                                        echo "<option value='" . $row['company_name'] . "' $selected>" . $row['company_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="job_title" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo htmlspecialchars($vacancy['job_title']); ?>" required>                            
                            </div>
                            <div class="mb-3">
                                <label for="job_description" class="form-label">Job Description</label>
                                <input type="text" class="form-control" id="job_description" name="job_description" value="<?php echo htmlspecialchars($vacancy['job_description']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="responsibility_detail" class="form-label">Job Responsibility</label>
                                <input type="text" class="form-control" id="responsibility_detail" name="responsibility_detail" value="<?php echo htmlspecialchars($responsibility['responsibility_detail']); ?>" required>
                            </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="responsibility_sub1" name="responsibility_sub1" placeholder="•" value="<?php echo htmlspecialchars($responsibility['responsibility_sub1']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="responsibility_sub2" name="responsibility_sub2" placeholder="•" value="<?php echo htmlspecialchars($responsibility['responsibility_sub2']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="responsibility_sub3" name="responsibility_sub3" placeholder="•" value="<?php echo htmlspecialchars($responsibility['responsibility_sub3']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="responsibility_sub4" name="responsibility_sub4" placeholder="•" value="<?php echo htmlspecialchars($responsibility['responsibility_sub4']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="responsibility_sub5" name="responsibility_sub5" placeholder="•" value="<?php echo htmlspecialchars($responsibility['responsibility_sub5']); ?>" required>
                                </div>
                            <div class="mb-3">
                                <label for="job_salary" class="form-label">Job Salary</label>
                                <input type="number" class="form-control" placeholder="Optional" id="job_salary" name="job_salary" value="<?php echo htmlspecialchars($vacancy['job_salary']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="job_nature" class="form-label">Job Nature</label>
                                    <select class="form-select" id="job_nature" name="job_nature" required>
                                        <option <?php if($vacancy['job_nature'] == 'Full Time') echo 'selected'; ?>>Full Time</option>
                                        <option <?php if($vacancy['job_nature'] == 'Part Time') echo 'selected'; ?>>Part Time</option>
                                    </select>
                            </div>
                            <div class="mb-3">
                                <label for="location" class="form-label">Location</label>
                                <input type="text" class="form-control" id="location" name="location" value="<?php echo htmlspecialchars($vacancy['location']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                <label for="town" class="form-label">Town</label>
                              <select class="form-select" id="town" name="town" value="<?php echo htmlspecialchars($vacancy['town']); ?>" required>
                                <option <?php if($vacancy['town'] == 'Aguilar') echo 'selected'; ?>>Aguilar </option>
                                <option <?php if($vacancy['town'] == 'Binmaley') echo 'selected'; ?>>Binmaley</option>
                                <option <?php if($vacancy['town'] == 'Bugallon') echo 'selected'; ?>>Bugallon</option>
                                <option <?php if($vacancy['town'] == 'Lingayen') echo 'selected'; ?>>Lingayen</option>
                                <option <?php if($vacancy['town'] == 'Mangatarem') echo 'selected'; ?>>Mangatarem</option>
                                <option <?php if($vacancy['town'] == 'Labrador') echo 'selected'; ?>>Labrador</option>
                              </select>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="qualification_detail" class="form-label">Qualifications</label>
                                <input type="text" class="form-control" id="qualification_detail" name="qualification_detail" value="<?php echo htmlspecialchars($qualification['qualification_detail']); ?>" required>
                            </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="qualification_sub1" name="qualification_sub1" placeholder="•" value="<?php echo htmlspecialchars($qualification['qualification_sub1']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="qualification_sub2" name="qualification_sub2" placeholder="•" value="<?php echo htmlspecialchars($qualification['qualification_sub2']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="qualification_sub3" name="qualification_sub3" placeholder="•" value="<?php echo htmlspecialchars($qualification['qualification_sub3']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="qualification_sub4" name="qualification_sub4" placeholder="•" value="<?php echo htmlspecialchars($qualification['qualification_sub4']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="qualification_sub5" name="qualification_sub5" placeholder="•" value="<?php echo htmlspecialchars($qualification['qualification_sub5']); ?>" required>
                                </div>

                            <div class="mb-3">
                                <label for="date_created" class="form-label">Date Created</label>
                                <input type="date" class="form-control" id="date_created" name="date_created" value="<?php echo htmlspecialchars($vacancy['date_created']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="date_end" class="form-label">Date End</label>
                                <input type="date" class="form-control" id="date_end" name="date_end" value="<?php echo htmlspecialchars($vacancy['date_end']); ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Save Changes</button>
                            <a href="page-vacancy.php" class="btn btn-secondary">Cancel</a>
                            
                        </form>
                <?php
                    } else {
                        echo "Vacancy not found.";
                    }
                } else {
                    echo "Vacancy ID not provided.";
                }
                ?>
            </div>
            <!-- /Edit user form -->
        </div>
        <!-- /Main content container -->
    </div>
    <!-- /Page content wrapper -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Your JavaScript code here
</script>
</body>
</html>