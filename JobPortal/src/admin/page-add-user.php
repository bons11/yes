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
    <title>Add User</title>
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
                <a href="page-user-list.php" class="list-group-item list-group-item-action bg-transparent second-text active">
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
                <h2 class="fs-2 m-0">Add User</h2>
            </div>
        </nav>
        <!-- /Top navigation bar -->

        <!-- Main content container -->
        <div class="container mt-5">
            <!-- Add user form -->
            <div class="bg-light p-4 rounded">
                <form action="add-user.php" method="POST">
                <input type="hidden" name="uid" value="<?php echo $user['uid']; ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address"  required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact"  required>
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"  required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"  required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option>admin</option>
                                    <option>user</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i>Add User</button>
                                <a href="page-user-list.php" class="btn btn-secondary">Cancel</a>
                            </div>
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