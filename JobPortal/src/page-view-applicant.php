<?php
session_start(); // Start the session

// Include database connection
include 'auth/php/config.php';

// Check if uid parameter exists in the URL
if(isset($_GET['uid'])) {
    // Retrieve uid from the URL
    $uid = $_GET['uid'];

    // SQL query to fetch job_number based on uid
    $sql_job_number = "SELECT job_number FROM tbl_applicant WHERE uid = ?";
    $stmt_job_number = mysqli_prepare($con, $sql_job_number);
    mysqli_stmt_bind_param($stmt_job_number, "s", $uid);
    mysqli_stmt_execute($stmt_job_number);
    $result_job_number = mysqli_stmt_get_result($stmt_job_number);

    // Check if job_number is found
    if (mysqli_num_rows($result_job_number) > 0) {
        // Fetch job_number
        $row_job_number = mysqli_fetch_assoc($result_job_number);
        $job_number = $row_job_number['job_number'];

        // Now use job_number to fetch the rest of the details
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

            
            // Fetch applicant information if available
            $applicant_uid = ''; // Initialize the variable

            $applicant_name = '';
            $applicant_email = '';
            $applicant_portfolio = '';
            $applicant_resume = '';
            $cover_letter = '';
            $status = '';


            // SQL query to fetch applicant information based on uid
            $sql_applicant = "SELECT * FROM tbl_applicant WHERE uid = ?";
            $stmt_applicant = mysqli_prepare($con, $sql_applicant);
            mysqli_stmt_bind_param($stmt_applicant, "s", $uid);
            mysqli_stmt_execute($stmt_applicant);
            $result_applicant = mysqli_stmt_get_result($stmt_applicant);


            // Check if applicant information is found
            if (mysqli_num_rows($result_applicant) > 0) {
                // Fetch applicant information
                $row_applicant = mysqli_fetch_assoc($result_applicant);
                $applicant_name = $row_applicant['name'];
                $applicant_email = $row_applicant['email'];
                $applicant_portfolio = $row_applicant['portfolio'];
                $applicant_resume = $row_applicant['resume'];
                $cover_letter = $row_applicant['cover_letter'];
                $status = $row_applicant['status'];
                $applicant_uid = $row_applicant['uid']; // Assigning uid to the variable for later use
            }

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

        } else {
            // No job found with the given job_number
            echo "No job found with the given job_number.";
        }
    } else {
        // No job_number found with the given uid
        echo "No job_number found with the given uid.";
    }
} else {
    // No uid parameter in the URL
    echo "No uid specified.";
}

// Handling form submission for updating applicant status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if applicant_uid is set and not empty
    if (isset($_POST['applicant_uid']) && !empty($_POST['applicant_uid'])) {
        // Retrieve applicant_uid from the form
        $applicant_uid = $_POST['applicant_uid'];

        // Check if status is set and not empty
        if (isset($_POST['status']) && !empty($_POST['status'])) {
            // Sanitize and validate status
            $status = mysqli_real_escape_string($con, $_POST['status']);

            // SQL query to update status
            $sql_update_status = "UPDATE tbl_applicant SET status = ? WHERE uid = ?";
            $stmt_update_status = mysqli_prepare($con, $sql_update_status);

            // Bind parameters
            mysqli_stmt_bind_param($stmt_update_status, "ss", $status, $applicant_uid);

            // Execute statement
            if (mysqli_stmt_execute($stmt_update_status)) {
                // Redirect to admin/page-dashboard.php
                header("Location: admin/page-dashboard.php");
                exit; // Ensure that subsequent code is not executed after redirection
            } else {
                echo "Error updating status: " . mysqli_error($con);
            }
        } else {
            echo "Status is required.";
        }
    } else {
        echo "Applicant UID is required.";
    }
}
?>

<!-- Include HTML markup or PHP code to display the job details -->



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
                        <h4 class="mb-4">Applicants Information</h4>
                        <form action="" id="submitform" method="post" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" name="name" placeholder="Your Name" value="<?php echo $applicant_name; ?>" readonly required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email" value="<?php echo $applicant_email; ?>" readonly required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control" name="portfolio" placeholder="Portfolio Website (Optional)" value="<?php echo $applicant_portfolio; ?>" readonly>
                                </div>
                                <div class="col-12 col-sm-6">
                                <?php 
                                if (!empty($applicant_resume)) {
                                    // Construct the resume file path
                                    $resume_filepath = "uploads/" . basename($applicant_resume);

                                    // Check if the resume file exists
                                    if (file_exists($resume_filepath)) {
                                ?>
                                        <div class="col-12 col-sm-6">
                                            <p>
                                                <a href="<?php echo $resume_filepath; ?>" download="<?php echo basename($resume_filepath); ?>">Download Resume</a>
                                            </p>
                                        </div>
                                <?php 
                                    } else {
                                        echo "Resume file \"$applicant_resume\" does not exist.";
                                    }
                                } else {
                                    echo "No resume file provided.";
                                }
                                ?>
                                </div> 
                                <div class="col-12">
                                    <textarea class="form-control" name="cover_letter" rows="5" placeholder="Cover Letter" readonly required><?php echo $cover_letter; ?></textarea>
                                </div>
                                <!-- Add a hidden input field to store the uid -->
                                <input type="hidden" name="applicant_uid" value="<?php echo $applicant_uid; ?>">
                                <div class="col-12">
                                <select class="form-select" name="status">
                                    <?php
                                    // Define status options
                                    $statusOptions = array("Pending", "Under Review", "Interview Scheduled", "Interviewed", "Not Selected");

                                    // Loop through options array and output dropdown options
                                    foreach ($statusOptions as $option) {
                                        // Check if the option matches the current status, if so, mark it as selected
                                        $selected = ($option == $status) ? "selected" : "";
                                        echo "<option value='$option' $selected>$option</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="col-12">
                                    <button id="applyBtn" class="btn btn-primary w-100" type="submit">Done</button>
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
