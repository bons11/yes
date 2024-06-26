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


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->


        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Send Us Feedback and any Queries!</h1>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center bg-light rounded p-4">
                                    <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                        <i class="fa fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <span>Town Hall of Bugallon</span>
                                </div>
                            </div>
                            <div class="col-md-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center bg-light rounded p-4">
                                    <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                        <i class="fa fa-envelope-open text-primary"></i>
                                    </div>
                                    <span>bugallonpangasinan@gmail.com</span>
                                </div>
                            </div>
                            <div class="col-md-4 wow fadeIn" data-wow-delay="0.5s">
                                <div class="d-flex align-items-center bg-light rounded p-4">
                                    <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                        <i class="fa fa-phone-alt text-primary"></i>
                                    </div>
                                    <span>+63 921 993 1481 | +63 921 993 1575</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h2 class="position-relative rounded w-100 h-100" style="min-height: 400px; display: flex; align-items: center; justify-content: center; text-align: center; background-color: #f8f9fa; padding: 20px;">
                          Municipality Of Bugallon Bulletin Board: Connecting for Hiring and Growth. "Your hub for Jobs and Progress!"
                        </h2>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp d-flex justify-content-center" data-wow-delay="0.5s">
                            <div>
                                <p class="mb-4">Your message will be acknowledged shortly. Thank you for your understanding. </p>
                                <form id="contactForm">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                                                <label for="name">Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                                                <label for="email">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" >
                                                <label for="subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="(Optional)" pattern="\d{11}" maxlength="11" minlength="11" required>
                                                <label for="subject">Contact Number</label>
                                                <small id="contactNumberError" class="form-text text-danger" style="display: none;">Please enter a valid 11-digit number.</small>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a message here" id="message" name="message" style="height: 150px"></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <select class="form-select" name="role" id="role">
                                                <option value="" selected disabled>Choose</option>
                                                <option value="Job seeker">Job seeker</option>
                                                <option value="Job recruiter">Job recruiter</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->



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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Function to handle form submission
    $('#contactForm').submit(function (event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'insert_inquiry.php', // Change to your PHP file for inserting data
            data: formData,
            success: function (response) {
                // If insertion is successful, show success message
                Swal.fire({
                    title: 'Success',
                    text: 'Your message has been sent successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000
                });
                // Clear the form fields after successful submission
                $('#contactForm')[0].reset();
            },
            error: function (xhr, status, error) {
                // If there's an error, show error message
                Swal.fire({
                    title: 'Error',
                    text: 'There was an error sending your message. Please try again later.',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });
</script>

<script>
        function validateContactNumber() {
            var contactNumber = document.getElementById("contact_number").value;
            var errorElement = document.getElementById("contactNumberError");
            var isValid = /^\d{11}$/.test(contactNumber);

            if (!isValid) {
                errorElement.style.display = "block";
                return false;
            }

            errorElement.style.display = "none";
            return true;
        }
    </script>

</body>

</html>