<?php

include 'date_end.php';

// Include the database configuration file
include '../auth/php/config.php';

// Query to fetch the total number of rows in tbl_user table
$query = "SELECT COUNT(*) AS total FROM tbl_user";
$result = mysqli_query($con, $query);

// Check if query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $totalUsers = $row['total'];
} else {
    // If query fails, set default value of total users to 0
    $totalUsers = 0;
}


// Query to fetch the total number of rows in tbl_user table
$query1 = "SELECT COUNT(*) AS total_applicant FROM tbl_applicant";
$result1 = mysqli_query($con, $query1);

// Check if query was successful
if ($result1) {
    $row = mysqli_fetch_assoc($result1);
    $totalApplicant = $row['total_applicant'];
} else {
    // If query fails, set default value of total users to 0
    $totalApplicant = 0;
}


// Query to fetch the total number of rows in tbl_user table
$query2 = "SELECT COUNT(*) AS total_vacancy FROM tbl_vacancy";
$result2 = mysqli_query($con, $query2);

// Check if query was successful
if ($result2) {
    $row = mysqli_fetch_assoc($result2);
    $totalVacancy = $row['total_vacancy'];
} else {
    // If query fails, set default value of total users to 0
    $totalVacancy = 0;
}


// Query to fetch the total number of rows in tbl_user table
$query3 = "SELECT COUNT(*) AS total_inquiry FROM tbl_inquiry";
$result3 = mysqli_query($con, $query3);

// Check if query was successful
if ($result3) {
    $row = mysqli_fetch_assoc($result3);
    $totalInquiry = $row['total_inquiry'];
} else {
    // If query fails, set default value of total users to 0
    $totalInquiry = 0;
}


// Close the database connection
mysqli_close($con);
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="style/styles.css" />
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2"></i>Admin Panel
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="page-dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="page-company.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-building me-2"></i>Company
                </a>
                <a href="page-vacancy.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
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
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </nav>

            

                <div class="container-fluid px-4">
                        <div class="row g-3 my-2">
                                <!-- Search form -->
                                <form class="d-flex me-3" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input class="form-control me-2" type="search" name="search" placeholder="Search..." aria-label="Search" onchange="clearSearch()">
                                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                                <a href="page-applicants.php" class="text-decoration-none text-dark">
                            <div class="col-md-3">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2"><?php echo $totalApplicant; ?></h3>
                                        <p class="fs-5">Applicants</p>
                                    </div>
                                <i class="fas fa-file fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="page-vacancy.php" class="text-decoration-none text-dark">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?php echo $totalVacancy; ?></h3>
                                    <p class="fs-5">Vacancies</p>
                                </div>
                                <i class="fas fa-clipboard fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a> 
                    </div>

                    <div class="col-md-3">
                        <a href="page-inquiry.php" class="text-decoration-none text-dark">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2"><?php echo $totalInquiry; ?></h3>
                                    <p class="fs-5">Inquiries</p>
                                </div>
                                <i class="fas fa-address-card fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="page-user-list.php" class="text-decoration-none text-dark">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <!-- Display the total number of users -->
                                    <h3 class="fs-2"><?php echo $totalUsers; ?></h3>
                                    <p class="fs-5">Users</p>
                                </div>
                                <i class="fa fa-user fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent Applicants</h3>
                        <div class="col">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                            </div>
                            <table class="table bg-white rounded shadow-sm table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date Apply</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Portfolio</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Resume</th>
                                    <th scope="col">Cover Letter</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th> <!-- New column for Action buttons -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include '../auth/php/config.php'; // Include config.php file

                                // Check if $con variable is defined and valid
                                if (!$con) {
                                    die("Connection failed: " . mysqli_connect_error());
                                }

                                // Fetch data from tbl_applicant
                                if (isset($_GET['search'])) {
                                    $search = mysqli_real_escape_string($con, $_GET['search']);
                                    $query = "SELECT * FROM tbl_applicant WHERE 
                                            date_apply LIKE '%$search%' OR 
                                            name LIKE '%$search%' OR
                                            portfolio LIKE '%$search%' OR
                                            email LIKE '%$search%' OR 
                                            resume LIKE '%$search%' OR 
                                            cover_letter LIKE '%$search%' OR 
                                            status LIKE '%$search%'";
                                } else {
                                    $query = "SELECT * FROM tbl_applicant";
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
                                    echo "<td>" . htmlspecialchars($row['date_apply']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['portfolio']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['resume']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['cover_letter']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-success btn-sm me-1' onclick='editApplicant(" . $row['uid'] . ")'><i class='fas fa-eye'></i></button>";
                                    echo "<button class='btn btn-danger btn-sm ms-1' onclick='deleteApplicant(" . $row['uid'] . ")'><i class='fas fa-trash-alt'></i></button>";
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
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

        function editApplicant(uid) {
        // Redirect to the edit page with the user ID in the URL
        window.location.href = "../page-view-applicant.php?uid=" + uid;
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


                // Function to delete a user
                function deleteApplicant(uid) {
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
                    xhr.open("POST", "delete-applicant.php", true);
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
                    xhr.send("uid=" + uid);
                }
            });
        }

    </script>
</body>

</html>