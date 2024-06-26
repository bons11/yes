<?php
include 'date_end.php';
session_start(); // Start the session
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

<style>
    /* Add custom styles for the scrollable content area */
    #page-content-wrapper {
        overflow-y: auto;
        max-height: calc(100vh - 56px); /* Adjust according to your header's height */
    }
</style>

<div class="d-flex" id="wrapper">
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
            <a href="page-vacancy.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                <i class="fas fa-clipboard me-2"></i>Vacancy
            </a>
            <a href="page-inquiry.php" class="list-group-item list-group-item-action bg-transparent second-text active">
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
                <h2 class="fs-2 m-0">Inquiries</h2>
            </div>
        </nav>
        <div class="container-fluid px-4">
            <div class="row my-5">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <p> </p>
                        </div>
                        <div class="d-flex">
                            <!-- Search form -->
                            <form class="d-flex me-3" method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input class="form-control me-2" type="search" name="search" placeholder="Search..." aria-label="Search" onchange="clearSearch()">
                                <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <table class="table bg-white rounded shadow-sm table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Role</th>
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

                        // Fetch data from tbl_inquiry
                        if (isset($_GET['search'])) {
                            $search = mysqli_real_escape_string($con, $_GET['search']);
                            $query = "SELECT * FROM tbl_inquiry WHERE 
                                    name LIKE '%$search%' OR 
                                    email LIKE '%$search%' OR
                                    subject LIKE '%$search%' OR 
                                    message LIKE '%$search%' OR 
                                    role LIKE '%$search%' OR 
                                    status LIKE '%$search%'";
                        } else {
                            $query = "SELECT * FROM tbl_inquiry";
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
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['subject']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td>";
                            echo "<button class='btn btn-success btn-sm me-1' onclick='editInquiry(" . $row['uid'] . ")'><i class='fas fa-edit'></i></button>";
                            echo "<button class='btn btn-danger btn-sm ms-1' onclick='deleteInquiry(" . $row['uid'] . ")'><i class='fas fa-trash-alt'></i></button>";
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

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
    </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function editInquiry(uid) {
        // Show SweetAlert with dropdown for status selection
        Swal.fire({
            title: 'Edit Inquiry Status',
            html:
                '<select id="statusSelect" class="form-select">' +
                '<option value="Pending">Pending</option>' +
                '<option value="Noticed">Noticed</option>' +
                '<option value="Read">Read</option>' +
                '</select>',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            focusConfirm: false,
            preConfirm: () => {
                return new Promise((resolve, reject) => {
                    const status = document.getElementById('statusSelect').value;
                    // Send AJAX request to update status in database
                    $.ajax({
                        type: 'POST',
                        url: 'edit-inquiry.php',
                        data: { uid: uid, statusSelect: status },
                        success: function(response) {
                            if (response === 'success') {
                                Swal.fire('Success', 'Status updated successfully.', 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', 'Failed to update status', 'error');
                            }
                        },
                        error: function() {
                            reject('Failed to update status');
                        }
                    });
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Reload the page or perform any other action after successful status update
                location.reload(); // Example: reload the page
            }
        }).catch((error) => {
            Swal.fire('Error', error, 'error');
        });
    }

            // Function to delete a user
        function deleteInquiry(uid) {
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
                    xhr.open("POST", "delete-inquiry.php", true);
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

        // Function to reload overall table data when search field is cleared
        function clearSearch() {
            var searchInput = document.querySelector('input[name="search"]');
            if (searchInput.value === "" && event.target.type !== 'submit') {
                window.location.href = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";
            }
        }
</script>
</body>

</html>
