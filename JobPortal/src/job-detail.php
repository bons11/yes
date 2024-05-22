<?php
session_start(); // Start the session

// Include database connection
include 'auth/php/config.php';

// Check if job_number parameter exists in the URL
if(isset($_GET['job_number'])) {
    // Retrieve job number from the URL
    $job_number = $_GET['job_number'];

    // SQL query to fetch job details based on job_number
    $sql = "SELECT v.*, c.logo FROM tbl_vacancy v INNER JOIN tbl_company c ON v.company_name = c.company_name WHERE v.job_number = ?";
    
    // Prepare statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "s", $job_number);

    // Execute statement
    mysqli_stmt_execute($stmt);

    // Get result
    $result = mysqli_stmt_get_result($stmt);

    // Check if job details are found
    if (mysqli_num_rows($result) > 0) {
        // Fetch job details
        $row = mysqli_fetch_assoc($result);
        $company_category = $row['company_category'];
        $company_name = $row['company_name'];
        $job_title = $row['job_title'];
        $job_description = $row['job_description'];
        $job_salary = $row['job_salary'];
        $job_nature = $row['job_nature'];
        $location = $row['location'];
        $date_created = $row['date_created'];
        $date_end = $row['date_end'];
        $logo = $row['logo'];

    // Fetch responsibility details if available
    $responsibility_detail = '';
    $responsibility_sub1 = '';
    $responsibility_sub2 = '';
    $responsibility_sub3 = '';
    $responsibility_sub4 = '';
    $responsibility_sub5 = '';

    // SQL query to fetch responsibility details based on job_number
    $sql_responsibility = "SELECT * FROM tbl_responsibility WHERE job_number = ?";
    $stmt_responsibility = mysqli_prepare($con, $sql_responsibility);
    mysqli_stmt_bind_param($stmt_responsibility, "s", $job_number);
    mysqli_stmt_execute($stmt_responsibility);
    $result_responsibility = mysqli_stmt_get_result($stmt_responsibility);

    // Check if responsibility details are found
    if (mysqli_num_rows($result_responsibility) > 0) {
        // Fetch responsibility details
        $row_responsibility = mysqli_fetch_assoc($result_responsibility);
        $responsibility_detail = $row_responsibility['responsibility_detail'];
        $responsibility_sub1 = $row_responsibility['responsibility_sub1'];
        $responsibility_sub2 = $row_responsibility['responsibility_sub2'];
        $responsibility_sub3 = $row_responsibility['responsibility_sub3'];
        $responsibility_sub4 = $row_responsibility['responsibility_sub4'];
        $responsibility_sub5 = $row_responsibility['responsibility_sub5'];
    }

    // Fetch qualification details if available
    $qualification_detail = '';
    $qualification_sub1 = '';
    $qualification_sub2 = '';
    $qualification_sub3 = '';
    $qualification_sub4 = '';
    $qualification_sub5 = '';

    // SQL query to fetch qualification details based on job_number
    $sql_qualification = "SELECT * FROM tbl_qualification WHERE job_number = ?";
    $stmt_qualification = mysqli_prepare($con, $sql_qualification);
    mysqli_stmt_bind_param($stmt_qualification, "s", $job_number);
    mysqli_stmt_execute($stmt_qualification);
    $result_qualification = mysqli_stmt_get_result($stmt_qualification);

    // Check if qualification details are found
    if (mysqli_num_rows($result_qualification) > 0) {
        // Fetch qualification details
        $row_qualification = mysqli_fetch_assoc($result_qualification);
        $qualification_detail = $row_qualification['qualification_detail'];
        $qualification_sub1 = $row_qualification['qualification_sub1'];
        $qualification_sub2 = $row_qualification['qualification_sub2'];
        $qualification_sub3 = $row_qualification['qualification_sub3'];
        $qualification_sub4 = $row_qualification['qualification_sub4'];
        $qualification_sub5 = $row_qualification['qualification_sub5'];
    }

    // Fetch company detail if available
    $company_detail = '';

    // SQL query to fetch company detail based on company_name
    $sql_company_detail = "SELECT company_detail FROM tbl_company WHERE company_name = ?";
    $stmt_company_detail = mysqli_prepare($con, $sql_company_detail);
    mysqli_stmt_bind_param($stmt_company_detail, "s", $company_name);
    mysqli_stmt_execute($stmt_company_detail);
    $result_company_detail = mysqli_stmt_get_result($stmt_company_detail);

    // Check if company detail is found
    if (mysqli_num_rows($result_company_detail) > 0) {
        // Fetch company detail
        $row_company_detail = mysqli_fetch_assoc($result_company_detail);
        $company_detail = $row_company_detail['company_detail'];
    }

        // Output job details or handle further processing
    } else {
        // No job found with the given job_number
        echo "No job found with the given job_number.";
    }
} else {
    // No job_number parameter in the URL
    echo "No job_number specified.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bugallon Municipal Bulletin Board</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

     <!-- Include SweetAlert CSS and JS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">Job Portal</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Jobs</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="category.php" class="dropdown-item">Job Category</a>
                            <a href="job-list.php" class="dropdown-item">Job List</a>
                        </div>
                    </div>
                    <a href="contacts.php" class="nav-item nav-link">Contact</a>
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                        if (isset($_SESSION['name'])) {
                            // User is logged in, display their name
                            echo $_SESSION['name'];
                        } else {
                            // User is not logged in, show default "Signin"
                            echo "Login";
                        }
                        ?>
                    </a>

                    <div class="dropdown-menu rounded-0 m-0">
                        <?php
                        if (isset($_SESSION['name'])) {
                            // If user is logged in, show profile, settings, and logout options
                            echo "<a href='#' class='dropdown-item' onclick='confirmLogout()'>Logout</a>";
                        } else {
                            // If user is not logged in, show regular signin options
                            echo "<a href='auth/login.php' class='dropdown-item'>User Login</a>";
                            echo "<a href='admin/index.php' class='dropdown-item'>Admin Login</a>";
                        }
                        ?>
                    </div>
                    </div>
                    <a href="job-list.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Apply Job<i class="fa fa-arrow-right ms-3"></i></a>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
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


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Job Detail</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Job Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->


    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/jpeg;base64,' . base64_encode($logo); ?>" alt="Company Logo" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-3"><?php echo $job_title; ?></h3> <!-- it should fetch in mysql table "tbl_vacancy" in column job_title -->
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $location; ?></span> <!-- it should fetch in mysql table "tbl_vacancy" in column location -->
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?php echo $job_nature; ?></span> <!-- it should fetch in mysql table "tbl_vacancy" in column job_nature -->
                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $job_salary; ?></span> <!-- it should fetch in mysql table "tbl_vacancy" in column job_salary -->
                        </div>
                    </div>

                    <div class="mb-5">
                        <h4 class="mb-3">Job description</h4>
                        <p><?php echo $job_description; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column job_description -->
                        <h4 class="mb-3">Responsibility</h4>
                        <p><?php echo $responsibility_detail; ?></p> <!-- it should fetch in mysql table "tbl_responsibility" in column responisibility_detail -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $responsibility_sub1; ?></p> <!--  it should fetch in mysql table "tbl_responsibility" in column responsibility_sub1 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $responsibility_sub2; ?></p> <!--  it should fetch in mysql table "tbl_responsibility" in column responsibility_sub2 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $responsibility_sub3; ?></p> <!--  it should fetch in mysql table "tbl_responsibility" in column responsibility_sub3 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $responsibility_sub4; ?></p> <!--  it should fetch in mysql table "tbl_responsibility" in column responsibility_sub4 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i>: <?php echo $responsibility_sub5; ?></p> <!--  it should fetch in mysql table "tbl_responsibility" in column responsibility_sub5 -->

                        <h4 class="mb-3">Qaulifications</h4>
                        <p><?php echo $qualification_detail; ?></p> <!-- it should fetch in mysql table "tbl_qualification" in column qualification_detail -->
                        <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $qualification_sub1; ?></p> <!--  it should fetch in mysql table "tbl_qualification" in column qualification_sub1 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $qualification_sub2; ?></p> <!--  it should fetch in mysql table "tbl_qualification" in column qualification_sub2 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $qualification_sub3; ?></p> <!--  it should fetch in mysql table "tbl_qualification" in column qualification_sub3 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i> <?php echo $qualification_sub4; ?></p> <!--  it should fetch in mysql table "tbl_qualification" in column qualification_sub4 -->
                            <p><i class="fa fa-angle-right text-primary me-2"></i>: <?php echo $qualification_sub5; ?></p> <!--  it should fetch in mysql table "tbl_qualification" in column qualification_sub5 -->
                    </div>

                    <div class="">
                        <h4 class="mb-4">Apply For The Job</h4>
                        <form action="submit_application.php" id="submitform" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" name="name" placeholder="Your Name" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control" name="portfolio" placeholder="Portfolio Website (Optional)">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="file" class="form-control bg-white" name="resume" accept=".pdf" required>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="cover_letter" rows="5" placeholder="Cover Letter" required></textarea>
                            </div>
                            <!-- Add hidden input field for company_name -->
                            <input type="hidden" name="company_name" value="<?php echo $company_name; ?>">
                            <!-- End of hidden input field for company_name -->
                            <input type="hidden" name="job_number" value="<?php echo $job_number; ?>">
                            <div class="col-12">
                                <button id="applyBtn" class="btn btn-primary w-100" type="button">Apply Now</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Job Summary</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: <?php echo $date_created; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column date_created -->
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: <?php echo $job_nature; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column job_nature -->
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Salary: <?php echo $job_salary; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column job_salary -->
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Location: <?php echo $location; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column location -->
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Date Line: <?php echo $date_end; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column date_end -->
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Company Detail</h4>
                        <p class="m-0"><?php echo $company_detail; ?></p> <!-- it should fetch in mysql table "tbl_vacancy" in column job_detail -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Job Detail End -->


 <!-- Footer Start -->
 <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <img src="admin/style/images/image.png" class="img-fluid" alt="Logo" width="200" height="100">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="index.php">Home</a>
                        <a class="btn btn-link text-white-50" href="about.php">About Us</a>
                        <a class="btn btn-link text-white-50" href="category.php">Job Category</a>
                        <a class="btn btn-link text-white-50" href="job-list.php">Job List</a>
                        <a class="btn btn-link text-white-50" href="contacts.php">Contact Us</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>bugallonpangasinan@gmail.com</p>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Town Hall of Bugallon, Pangasinan</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+63 921 993 1481</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+63 921 993 1575</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="https://twitter.com/OneBugallon"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/onebugallon"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/onebugallon/"><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-outline-light btn-social" href="https://ph.indeed.com/"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Emergency Hotlines</h5>
                        <a class="btn btn-link text-white-50" href="https://www.facebook.com/people/Bfp-RegionOne-Bugallon-Pangasinan/100009375930770/?paipv=0&eav=AfbJj-FSJvsJnGHHCiccWWacPs_H755tKOE8e55zc5CBjbOvqBbKWys1zf9ygop_Kk4&_rdr">BUREAU of Fire Protection</a>
                        <a class="btn btn-link text-white-50" href="https://www.facebook.com/bugallonpolicestation/">PNP Bugallon</a>
                        <a class="btn btn-link text-white-50" href="https://www.facebook.com/PangasinanPDRRMO/">PDRRMO Pangasinan</a>
                        <a class="btn btn-link text-white-50" href="https://www.facebook.com/dilgpangasinanR1/">DILG Provincial</a>
                        <a class="btn btn-link text-white-50" href="https://www.facebook.com/mdrrmc.bugallon.9/">MDRRMO Bugallon</a>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            All Right Reserved &copy; <a class="border-bottom" href="https://www.facebook.com/onebugallon">ONE Bugallon</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    <?php
    if (isset($_GET['status']) && isset($_GET['message'])) {
        $status = $_GET['status'];
        $message = $_GET['message'];

        // Echo the JavaScript code
        echo "if ('$status' === 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '$message',
                showConfirmButton: false, // Hide the 'Okay' button
                timer: 3000 // Auto close after 3 seconds
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '$message'
            });
        }";
    }
    ?>
    </script>

    <script>
    document.getElementById("applyBtn").addEventListener("click", function() {
        // Check if there is a session logged in
        // You can replace this condition with your actual session check logic
        var isLoggedIn = <?php echo isset($_SESSION['name']) ? 'true' : 'false'; ?>;
        
        if (isLoggedIn) {
            // If logged in, submit the form
            document.getElementById("submitform").submit(); // Replace "yourFormId" with your form's ID
        } else {
            // If not logged in, show an error using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'You must be logged in to apply for this job.',
            });
        }
    });
    </script>


    <script>
    // Show an error using SweetAlert if form is not valid
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("applyBtn").addEventListener("click", function() {
            var isValid = document.getElementById("submitform").checkValidity();
            
            if (!isValid) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Please fill out all required fields.',
                });
            }
        });
    });
    </script>


</body>

</html>