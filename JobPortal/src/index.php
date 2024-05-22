<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bugallon Municipal Bulletin Board</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/bugallon-seal.png" rel="icon">

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
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="mission.php" class="nav-item nav-link">About</a>
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


        <!-- Carousel Start -->
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="images/pexels-anamul-rezwan-1216589.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Welcome to the Bugallon Municipal Bulletin Board</h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Find The Perfect Job That You Deserved</p>
                                    <a href="job-search.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="images/pexels-sora-shimazaki-5668842.jpg" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(43, 57, 64, .5);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-3 text-white animated slideInDown mb-4">Bugallon Municipal Bulletin Board </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-2">Find the best startup job that fit you</p>
                                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->


                <!-- Search Start -->
                <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
            <div class="container">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <input type="text" class="form-control border-0" id="keyword" placeholder="Keyword" />
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" id="category">
                                    <option value="">Category</option>
                                    <?php

                                    include 'auth/php/config.php';
                                    // Fetch categories from tbl_category
                                    $categoryQuery = "SELECT category FROM tbl_category";
                                    $categoryResult = mysqli_query($con, $categoryQuery);
                                    if ($categoryResult) {
                                        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
                                            echo "<option value='" . $categoryRow['category'] . "'>" . $categoryRow['category'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select border-0" id="company">
                                    <option value="">Company</option>
                                    <?php
                                    // Fetch company names from tbl_company
                                    $companyQuery = "SELECT company_name FROM tbl_company";
                                    $companyResult = mysqli_query($con, $companyQuery);
                                    if ($companyResult) {
                                        while ($companyRow = mysqli_fetch_assoc($companyResult)) {
                                            echo "<option value='" . $companyRow['company_name'] . "'>" . $companyRow['company_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100" onclick="searchJobs()">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
                <div class="row g-4">
                <?php
                    // Include config.php file
                    include 'auth/php/config.php';

                    // Fetch data from tbl_category where status is available
                    $query = "SELECT category, logo FROM tbl_category WHERE status = 'available'";
                    $result = mysqli_query($con, $query);

                    // Check if query was successful
                    if ($result) {
                        // Check if there are any rows returned
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $categoryName = $row['category'];
                                $queryVacancyCount = "SELECT COUNT(*) as vacancy_count FROM tbl_vacancy WHERE company_category = '$categoryName'";
                                $resultVacancyCount = mysqli_query($con, $queryVacancyCount);
                                $vacancyCount = 0;
                                if ($resultVacancyCount) {
                                    $rowVacancyCount = mysqli_fetch_assoc($resultVacancyCount);
                                    $vacancyCount = $rowVacancyCount['vacancy_count'];
                                }
                                ?>
                                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                                    <a class="cat-item rounded p-4" href="selected-category.php?category=<?php echo urlencode($categoryName); ?>">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['logo']); ?>" class="img-fluid" alt="" style="width: 100px; height: 100px;">
                                        <h6 class="mb-3"><?php echo $categoryName; ?></h6>
                                        <p class="mb-0"><?php echo $vacancyCount; ?> Vacancy</p>
                                    </a>
                                </div>
                                <?php
                            }
                        } else {
                            echo "No categories found.";
                        }
                    } else {
                        // Print any error messages
                        echo "Error: " . mysqli_error($con);
                    }

                    // Close database connection
                    mysqli_close($con);
                ?>
                </div>
            </div>
        </div>
        <!-- Category End -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active"  href="job-list.php">
                                <h6 class="mt-n1 mb-0">Featured</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3"  href="full_time_jobs.php">
                                <h6 class="mt-n1 mb-0">Full Time</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3"  href="part_time_jobs.php">
                                <h6 class="mt-n1 mb-0">Part Time</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">

                    <?php

                    include 'auth/php/config.php';

                     $sql = "SELECT v.*, c.logo FROM tbl_vacancy v INNER JOIN tbl_company c ON v.company_name = c.company_name ORDER BY date_created DESC LIMIT 10";
                    $result = mysqli_query($con, $sql);

                    if (!$result) {
                        echo "Error: " . mysqli_error($con);
                    } else {
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="job-item p-4 mb-4">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                            <!-- Fetch company logo dynamically -->
                                            <img class="flex-shrink-0 img-fluid border rounded" src="data:image/jpeg;base64,<?php echo base64_encode($row['logo']); ?>" alt="" style="width: 80px; height: 80px;">
                                            <div class="text-start ps-4">
                                                <h5 class="mb-3"><?php echo $row['job_title']; ?></h5>
                                                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i><?php echo $row['location']; ?></span>
                                                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i><?php echo $row['job_nature']; ?></span>
                                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i><?php echo $row['job_salary']; ?></span>
                                                <span class="text-truncate me-0"><i class="far fas fa-building text-primary me-2"></i><?php echo $row['company_name']; ?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                            <div class="d-flex mb-3">
                                                <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                                <a class="btn btn-primary" href="job-detail.php?job_number=<?php echo $row['job_number']; ?>">Apply Now</a>
                                            </div>
                                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: <?php echo $row['date_end']; ?></small>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }

                    mysqli_close($con);
                    ?>

                        <a class="btn btn-primary py-3 px-5" href="job_list_all.php">Browse More Jobs</a>

                    </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="images/20130907_094226.png">
                            </div>
                            <div class="col-6 text-start">
                                <img class="img-fluid" src="images/ourladyoflourdesparish.jpg" style="width: 85%; margin-top: 15%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid" src="images/4053406072_f14e79cd12_z.jpg" style="width: 85%;">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="images/mtzionpilgrimage.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">We help to get the best job suited for the people of Bugallon</h1>
                        <p><i class="fa fa-check text-primary me-3"></i>Professionalism and expertise guide our exceptional client services.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Innovation and creativity fuel our continuous improvement and problem-solving.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Diversity and inclusivity create a welcoming and collaborative environment for all.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Commitment to quality ensures our services exceed expectations.</p>
                        <p><i class="fa fa-check text-primary me-3"></i>Teamwork and collaboration drive our success and innovation.</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="mission.php">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


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

    <script>
        function searchJobs() {
            var keyword = document.getElementById("keyword").value;
            var category = document.getElementById("category").value;
            var company = document.getElementById("company").value;

            // Redirect to job-list.php with search parameters
            window.location.href = "searched-job.php?keyword=" + keyword + "&category=" + category + "&company=" + company;
        }
    </script>
</body>

</html>