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
    <!-- Favicon -->
    <link href="../img/ebb-logo.png" rel="icon">
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
        <!-- Top navigation bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Add Vacancy</h2>
            </div>
        </nav>
        <!-- /Top navigation bar -->

        <!-- Main content container -->
        <div class="container mt-5">
            <!-- Add user form -->
            <div class="bg-light p-4 rounded">
            <form action="add-vacancy.php" method="POST">
                <div class="mb-3">
                    <label for="company_category" class="form-label">Company Category</label>
                    <select class="form-select" id="company_category" name="company_category" required>
                        <?php
                        // Include the config.php file to establish database connection
                        include '../auth/php/config.php';

                        // Fetch data from tbl_category and populate the dropdown
                        $category_query = "SELECT category FROM tbl_category";
                        $category_result = mysqli_query($con, $category_query);
                        while ($row = mysqli_fetch_assoc($category_result)) {
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
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
                            echo "<option value='" . $row['company_name'] . "'>" . $row['company_name'] . "</option>";
                        }

                        // Close database connection
                        mysqli_close($con);
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="job_title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="job_title" name="job_title" required>
                </div>
                <div class="mb-3">
                    <label for="job_description" class="form-label">Job Description</label>
                    <input type="text" class="form-control" id="job_description" name="job_description" required>
                </div>
                <div class="mb-3">
                    <label for="responsibility_detail" class="form-label">Job Responsibility</label>
                    <input type="text" class="form-control" id="responsibility_detail" name="responsibility_detail" required>
                </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub1" name="responsibility_sub1" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub2" name="responsibility_sub2" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub3" name="responsibility_sub3" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub4" name="responsibility_sub4" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub5" name="responsibility_sub5" placeholder="•" required>
                    </div>
                <div class="mb-3">
                    <label for="job_salary" class="form-label">Job Salary Range</label>
                    <input type="number" class="form-control" placeholder="Salary Range (ex: 11,700-30,000)" id="job_salary" name="job_salary">
                </div>
                <div class="mb-3">
                    <label for="job_nature" class="form-label">Job Nature</label>
                        <select class="form-select" id="job_nature" name="job_nature" required>
                            <option>Full Time</option>
                            <option>Part Time</option>
                            <option>Day Time</option>
                            <option>Night Time</option>
                            <option>On Call</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label for="town" class="form-label">Town</label>
                        <select class="form-select" id="town" name="town" required>
                            <option>Agno</option>
                            <option>Aguilar</option>
                            <option>Alaminos</option>
                            <option>Alcala</option>
                            <option>Anda</option>
                            <option>Asingan</option>
                            <option>Bani</option>
                            <option>Basista</option>
                            <option>Bayambang</option>
                            <option>Binmaley</option>
                            <option>Binalonan</option>
                            <option>Bolinao</option>
                            <option>Bugallon</option>
                            <option>Bullangao</option>
                            <option>Burgos</option>
                            <option>Calasiao</option>
                            <option>Dagupan</option>
                            <option>Dasol</option>
                            <option>Infanta</option>
                            <option>Labrador</option>
                            <option>Laoac</option>
                            <option>Lingayen</option>
                            <option>Mabini</option>
                            <option>Malasiqui</option>
                            <option>Manaoag</option>
                            <option>Mangaldan</option>
                            <option>Mangatarem</option>
                            <option>Mapandan</option>
                            <option>Natividad</option>
                            <option>Pozorrubio</option>
                            <option>Rosales</option>
                            <option>San Carlos City</option>
                            <option>San Fabian</option>
                            <option>San Jacinto</option>
                            <option>San Manuel</option>
                            <option>San Nicolas</option>
                            <option>San Quintin</option>
                            <option>Santa Barbara</option>
                            <option>Santa Maria</option>
                            <option>Santo Tomas</option>
                            <option>Sison</option>
                            <option>Sual</option>
                            <option>Tayug</option>
                            <option>Umingan</option>
                            <option>Urbiztondo</option>
                            <option>Urdaneta</option>
                            <option>Villasis</option>
                        </select>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="mb-3">
                    <label for="qualification_detail" class="form-label">Qualifications</label>
                    <input type="text" class="form-control" id="qualification_detail" name="qualification_detail" required>
                </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub1" name="qualification_sub1" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub2" name="qualification_sub2" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub3" name="qualification_sub3" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub4" name="qualification_sub4" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub5" name="qualification_sub5" placeholder="•" required>
                    </div>
                <div class="mb-3">
                    <label for="date_created" class="form-label">Date Created</label>
                    <input type="date" class="form-control" id="date_created" name="date_created" required>
                </div>
                <div class="mb-3">
                    <label for="date_end" class="form-label">Date End</label>
                    <input type="date" class="form-control" id="date_end" name="date_end" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Add Vacancy</button>
                <a href="page-vacancy.php" class="btn btn-secondary">Cancel</a>
            </form>
            </div>
            <!-- /Add user form -->
        </div>
        <!-- /Main content container -->
    </div>
    <!-- /Page content wrapper -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };
</script>
</body>
</html>