<?php
include 'date_end.php';
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
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold" onclick="confirmLogout()">
                    <i class="fas fa-power-off me-2"></i>Logout
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                <h2 class="fs-2 m-0">Vacancy</h2>
            </div>
        </nav>
        <div class="container-fluid px-4">
            <div class="row my-5">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <!-- Add User button -->
                            <a href="page-add-vacancy.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Add Vacancy</a>
                        </div>
                        <!-- Dropdown-->
                        <div class="dropdown me-2">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Filter by
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="page-vacancy.php">Default</a></li>
                                <li><a class="dropdown-item" href="#" onclick="applyFilter('Category Alphabetical')">Category Alphabetical</a></li>
                                <li><a class="dropdown-item" href="#" onclick="applyFilter('Company Alphabetical')">Company Alphabetical</a></li>
                                <li><a class="dropdown-item" href="#" onclick="applyFilter('Category Date Created')">Date Created</a></li>
                            </ul>
                        </div>
                        <div class="d-flex">
                            <!-- Search form -->
                            <form class="d-flex me-3" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input class="form-control me-2" type="search" name="search" placeholder="Search..." aria-label="Search" onchange="clearSearch()">
                                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <table class="table bg-white rounded shadow-sm  table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Salary</th>
                                <th scope="col">Nature</th>
                                <th scope="col">Location</th>
                                <th scope="col">Municipality</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Date End</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../auth/php/config.php'; // Include config.php file

                            // Check if $con variable is defined and valid
                            if (!$con) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Fetch data from tbl_category
                            if (isset($_GET['search'])) {
                                $search = mysqli_real_escape_string($con, $_GET['search']);
                                $query = "SELECT * FROM tbl_vacancy WHERE 
                                        company_category LIKE '%$search%' OR 
                                        company_name LIKE '%$search%' OR 
                                        job_title LIKE '%$search%' OR 
                                        job_description LIKE '%$search%' OR 
                                        job_salary LIKE '%$search%' OR
                                        job_nature LIKE '%$search%' OR
                                        location LIKE '%$search%' OR
                                        town LIKE '%$search%' OR
                                        date_created LIKE '%$search%' OR
                                        date_end LIKE '%$search%'";
                            } else {
                                // Define what to do if search parameter is not set
                                // For example, you might want to provide a default query or handle it differently
                                 $query = "SELECT * FROM tbl_vacancy ORDER BY date_created DESC";
                            }

                            $result = mysqli_query($con, $query);

                            // Check if query was successful
                            if (!$result) {
                                echo "Error: " . mysqli_error($con);
                                exit();
                            }

                            
                            // Loop through the fetched data and display in the table
                            $count = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $count++ . "</th>";
                                echo "<td>" . htmlspecialchars($row['company_category']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['company_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['job_title']) . "</td>";
                                $job_description = htmlspecialchars($row['job_description']);
                                $job_description = strlen($job_description) > 20 ? substr($job_description, 0, 20) . '...' : $job_description;
                                echo "<td><span title='" . $job_description . "'>" . $job_description . "</span></td>";
                                echo "<td>" . htmlspecialchars($row['job_salary']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['job_nature']) . "</td>";
                                $location = htmlspecialchars($row['location']);
                                $location = strlen($location) > 30 ? substr($location, 0, 30) . '...' : $location;
                                echo "<td><span title='" . $location . "'>" . $location . "</span></td>";
                                echo "<td>" . htmlspecialchars($row['town']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date_created']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['date_end']) . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-success btn-sm ms-1' onclick='editVacancy(" . $row['uid'] . ")'><i class='fas fa-edit'></i></button>";
                                echo "<button class='btn btn-danger btn-sm ms-1' onclick='deleteVacancy(" . $row['job_number'] . ")'><i class='fas fa-trash-alt'></i></button>";
                                echo "</td>";
                                echo "</tr>";
                            }

                            // Close database connection
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Function to redirect to the edit page with user ID
    function editVacancy(uid) {
        window.location.href = "page-edit-vacancy.php?uid=" + uid;
    }

    // Function to delete a user
    // Function to delete a user
    function deleteVacancy(job_number) {
        Swal.fire({
            title: 'Are you sure you want to delete?',
            text: 'This action cannot be undone.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#d33', // Reddish color
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete-vacancy.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        Swal.fire({
                            title: 'Success',
                            text: xhr.responseText,
                            icon: 'success'
                        }).then(() => {
                            window.location.reload();
                        });
                    }
                };
                xhr.send("job_number=" + job_number);
            }
        });
    }

    // Function to reload overall table data when search field is cleared
    function clearSearch() {
        var searchInput = document.querySelector('input[name="search"]');
        if (searchInput.value === "" && event.target.type !== 'submit') {
            window.location.href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";
        }
    }

    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            confirmButtonColor: '#d33', // Reddish color
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "log-off.php";
            }
        });
    }

    // Toggle sidebar
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function () {
        el.classList.toggle("toggled");
    };


    function applyFilter(filter) {
    // Get the table body
    var tableBody = document.querySelector('tbody');

    // Get all table rows
    var rows = tableBody.querySelectorAll('tr');

    // Retrieve the default order of rows by their initial index
    var defaultOrder = Array.from(rows).sort(function(rowA, rowB) {
        return Array.from(rowA.parentNode.children).indexOf(rowA) - Array.from(rowB.parentNode.children).indexOf(rowB);
    });

    // Check if the selected filter is "Default"
    if (filter === 'Default') {
        // Clear the table body
        tableBody.innerHTML = '';

        // Append the default order of rows back to the table body
        defaultOrder.forEach(function(row) {
            tableBody.appendChild(row.cloneNode(true)); // Clone the node to preserve event listeners
        });
    } else {
        // Sort the rows based on the selected filter
        var rowsArray = Array.from(rows);
        rowsArray.sort(function(rowA, rowB) {
            var valueA, valueB;

            // Adjust the index based on the column you want to sort by
            switch (filter) {
                case 'Category Alphabetical':
                    valueA = rowA.querySelector('td:nth-child(2)').textContent.trim(); // Category column
                    valueB = rowB.querySelector('td:nth-child(2)').textContent.trim(); // Category column
                    break;
                case 'Company Alphabetical':
                    valueA = rowA.querySelector('td:nth-child(3)').textContent.trim(); // Company Name column
                    valueB = rowB.querySelector('td:nth-child(3)').textContent.trim(); // Company Name column
                    break;
                case 'Category Date Created':
                    valueA = rowA.querySelector('td:nth-child(10)').textContent.trim(); // Date Created column
                    valueB = rowB.querySelector('td:nth-child(10)').textContent.trim(); // Date Created column
                    break;
                default:
                    return 0; // For other cases, return 0 to maintain the order
            }

            // Perform sorting based on the values
            if (filter === 'Category Alphabetical' || filter === 'Company Alphabetical') {
                return valueA.localeCompare(valueB);
            } else if (filter === 'Category Date Created') {
                var dateA = new Date(valueA);
                var dateB = new Date(valueB);
                return dateA - dateB;
            }
        });

        // Clear the table body
        tableBody.innerHTML = '';

        // Append sorted rows back to the table body
        rowsArray.forEach(function(row) {
            tableBody.appendChild(row);
        });
    }
}
</script>


</body>
</html>
