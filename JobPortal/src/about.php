<?php
session_start(); // Start the session
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Employment Bulletin Board</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/ebb-logo.png" rel="icon">

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
    <link href="css/about.css" rel="stylesheet">

    <style>
        
    </style>
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
       
        <?php include 'navbar.php'; ?>
        
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

        <img src="images/bugallon.png" alt="" class="responsive-image">


        <!-- Mission, Vision, and Values Start -->
        <div class="container py-5">
          <!-- <h1 class="text-center">Our Mission, Vision, and Values</h1> -->
          <div class="row mt-4 ">
            <div class="col-md-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Mission</h2>
                    <p class="card-text">The Municipal Government of Bugallon exists to provide quality services and upholds the general welfare of its people through sustainable development, social responsibility, environmental protection, and economic progress in strong partnership with the private sectors.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Vision</h2>
                    <p class="card-text">Bugallon: A Top-Class Municipality in the field of Governance, Information Technology, Health, Tourism, and Commerce, governed by God-centered and People-oriented Leaders, Home of Globally-competitive and Locally-anchored constituents living in a Sustainable and conducive environment for an Organized, Nurtured and Empowered Community.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                      <h2 class="card-title">Values</h2>
                      <p class="card-text">Our values revolve around integrity, respect, and commitment. We foster inclusivity, embracing diverse perspectives. Pursuing excellence through innovation, we meet evolving community needs. Committed to sustainability and social responsibility, we aim for a lasting positive impact.</p>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Mission, Vision, and Values End -->


        <!-- Gallery start-->
        <div class="container text-center">
          <h1 class="center">About MBB</h1>
            <div class="d-flex justify-content-center">

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
                        <!-- <a class="btn btn-primary py-3 px-5 mt-3" href="mission.php">Read More</a> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

            </div>

        </div>

        <!-- Gallery end -->

        <!-- Gallery start-->
        
        <!-- <div class="container text-center">
          <h1 class="center">Gallery</h1>
            <div class="d-flex justify-content-center">
              <p>-----?gridgallery?-----</p>
            </div>
        </div> -->
        <!-- Gallery end -->

        

        <!-- Video Player Start -->
        <div class="video-container">
            <video controls loop>
                <source src="images/video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <!-- Video Player End -->


        <!-- GPS -->
        <div class="container text-center p-3">
            <br>
            <br>
          <h1 class="center">Location</h1>
          <br>
            <br>
            <div class="d-flex justify-content-center">
              <iframe class="position-relative rounded w-75 p-5" 
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15344.522958659853!2d120.2174292!3d15.9545475!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33915917835f5103%3A0x4efeba6b6c6d3b86!2sBugallon%20Town%20Hall!5e0!3m2!1sen!2sph!4v1708504541405!5m2!1sen!2sph"
                frameborder="0" style="min-height: 500px; border:0;" allowfullscreen="" aria-hidden="false"
                tabindex="0">
              </iframe>
            </div>
        </div>
        <!-- GPS -->


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
                        <a class="btn btn-link text-white-50" href="mission.php">About Us</a>
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
</body>

</html>