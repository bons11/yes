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
    <title>Edit User</title>
    <link href="img/bugallon-seal.png" rel="icon">
</head>

<body>

    <style>
        /* Add custom styles for the scrollable content area */
        #page-content-wrapper {
            overflow-y: auto;
            max-height: calc(100vh - 56px);
            /* Adjust according to your header's height */
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
                <a href="page-dashboard.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="page-company.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-building me-2"></i>Company
                </a>
                <a href="page-vacancy.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-clipboard me-2"></i>Vacancy
                </a>
                <a href="page-inquiry.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-address-card me-2"></i>Inquiry
                </a>
                <a href="page-applicants.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-file me-2"></i>Applicants
                </a>
                <a href="page-category.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-layer-group me-2"></i>Category
                </a>
                <a href="job-owner-request.php"
                    class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-envelope me-2"></i>Owner Requests
                </a>
                <a href="page-user-list.php"
                    class="list-group-item list-group-item-action bg-transparent second-text active">
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
                    <h2 class="fs-2 m-0">Announcements</h2>
                </div>

            </nav>
            <!-- /Top navigation bar -->

            <!-- Main content container -->
            <div class="container mt-5">
                <!-- Edit user form -->
                <div class="bg-light p-4 rounded">
                    <?php
                    include '../auth/php/config.php';

                    if (isset($_GET['id']) && !empty($_GET['id'])) {
                        $id = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM tbl_announcement WHERE id = '$id'";
                        $result = mysqli_query($con, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            $announcement = mysqli_fetch_assoc($result);
                            ?>
                            <form action="edit-announcement.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <!-- Hidden input to hold announcement id -->
                                <div class="mb-3">
                                    <label for="event_name" class="form-label">Event Name</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name"
                                        value="<?php echo htmlspecialchars($announcement['event_name']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="event_details" class="form-label">Event Details</label>
                                    <input type="text" class="form-control" id="event_details" name="event_details"
                                        value="<?php echo htmlspecialchars($announcement['event_details']); ?>" required>
                                </div>
                                <!-- Add the input field for uploading an image -->
                                <div class="mb-3">
                                    <label for="event_image" class="form-label">Event Image</label>
                                    <input type="file" class="form-control" id="event_image" name="event_image" value="<?php echo htmlspecialchars($announcement['event_details']); ?>" required>
                                </div>
                                <!-- Add the remaining input fields for other announcement details -->
                                <div>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Save
                                        Changes</button>
                                    <a href="page-dashboard.php" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>

                            <?php
                        } else {
                            echo "Announcement not found.";
                        }
                    } else {
                        echo "Announcement ID not provided.";
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