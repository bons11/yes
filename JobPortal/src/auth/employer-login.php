<?php
session_start();
include("php/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/bugallon-seal.png" rel="icon">
    <link rel="stylesheet" href=".../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/employer-page.css">
    <title>Bugallon Municipal Bulletin Board</title>
</head>
<body>
    <div class="container py-5 px-4">
        <div class="forms">
        <?php 
            if (isset($_POST['login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM tbl_job_owner_apply WHERE email='$email' AND password='$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if 'role' is empty
        if (empty($row['role'])) {
            // Display an alert if the account is not approved
            echo "<script>alert('Your account is not approved by an admin yet.');</script>";
        } elseif ($row['role'] == 'user' || $row['role'] == 'representative') {
            $_SESSION['name'] = $row['name'];
            $_SESSION['valid'] = $row['email'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['birthday'] = $row['birthday'];
            $_SESSION['contact'] = $row['contact'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['business_name'] = $row['business_name'];
            $_SESSION['company_detail'] = $row['company_detail'];
            $_SESSION['company_email'] = $row['company_email'];
            $_SESSION['company_contact'] = $row['company_contact'];
            $_SESSION['business_location'] = $row['business_location'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if (isset($_POST['remember'])) {
                setcookie('email', $email, time() + (86400 * 30), "/");
                setcookie('password', $password, time() + (86400 * 30), "/");
            } else {
                if (isset($_COOKIE['email'])) {
                    setcookie('email', '', time() - 3600, '/');
                }
                if (isset($_COOKIE['password'])) {
                    setcookie('password', '', time() - 3600, '/');
                }
            }

            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
$upload_dir = '../uploads/';

// Check if the form is submitted
if (isset($_POST['signup_submit'])) {
    // Handle file uploads
    $business_permit_path = $upload_dir . basename($_FILES['business_permit']['name']);
    $business_picture_path = $upload_dir . basename($_FILES['business_picture']['name']);
    $valid_id_path = $upload_dir . basename($_FILES['valid_id']['name']);
    $logo_path = $upload_dir . basename($_FILES['company_logo']['name']); // Logo path
    $dti_path = $upload_dir . basename($_FILES['dti_permit']['name']);
    $dir_path = $upload_dir . basename($_FILES['dir']['name']);
    $sss_path = $upload_dir . basename($_FILES['sss']['name']);

    // Move uploaded files to the upload directory
    if (move_uploaded_file($_FILES['business_permit']['tmp_name'], $business_permit_path) &&
        move_uploaded_file($_FILES['business_picture']['tmp_name'], $business_picture_path) &&
        move_uploaded_file($_FILES['valid_id']['tmp_name'], $valid_id_path) &&
        move_uploaded_file($_FILES['company_logo']['tmp_name'], $logo_path) &&
        move_uploaded_file($_FILES['dti_permit']['tmp_name'], $dti_path) &&
        move_uploaded_file($_FILES['dir']['tmp_name'], $dir_path) &&
        move_uploaded_file($_FILES['sss']['tmp_name'], $sss_path)) {

        $name = mysqli_real_escape_string($con, $_POST['name']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $birthday = mysqli_real_escape_string($con, $_POST['birthday']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
        $business_name = mysqli_real_escape_string($con, $_POST['business_name']);
        $job_role = mysqli_real_escape_string($con, $_POST['occupation']);
        $company_detail = mysqli_real_escape_string($con, $_POST['company_detail']);
        $company_email = mysqli_real_escape_string($con, $_POST['company_email']);
        $company_contact = mysqli_real_escape_string($con, $_POST['company_contact']);
        $business_location = mysqli_real_escape_string($con, $_POST['business_location']);

        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match');</script>";
        } else {
            $verify_query = mysqli_query($con, "SELECT email FROM tbl_job_owner_apply WHERE email='$email'");
            if (mysqli_num_rows($verify_query) != 0) {
                echo "<script>alert('This email is already in use, please try another one.');</script>";
            } else {
                $insert_query = mysqli_query($con, "INSERT INTO tbl_job_owner_apply (name, address, contact, birthday, email, password, business_name, occupation, company_detail, company_email, company_contact, business_location, business_permit, business_picture, valid_id, logo, dti, dir, sss) VALUES ('$name', '$address', '$contact', '$birthday', '$email', '$password', '$business_name', '$job_role', '$company_detail', '$company_email', '$company_contact', '$business_location', '$business_permit_path', '$business_picture_path', '$valid_id_path', '$logo_path', '$dti_path', '$dir_path', '$sss_path')") or die("Error Occurred: " . mysqli_error($con));

                if ($insert_query) {
                    echo "<script>alert('Registration successful!');</script>";
                    echo "<script>window.location.href = 'login.php';</script>";
                } else {
                    echo "<script>alert('Error registering user');</script>";
                }
            }
        }
    } else {
        echo "File upload failed.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
            <div class="form login">
                <span class="title">Job <b style="color: #5bc0de;">Owner</b> Login</span>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck" name="remember">
                            <label for="logCheck" class="text mt-2">Remember me</label>
                        </div>
                        <a href="forgot-password.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login_submit" value="Login Now">
                    </div>
                </form>

                <div class="login-signup mt-3">
                    <span class="text">Register here!
                        <a href="#" class="text signup-link">Signup now</a>
                    </span>
                </div>
                <div class="login-signup">
                    <span class="text">Are you a Job seeker?
                        <a href="login.php" class="text">Click here</a>
                    </span>
                </div>
                <div class="text-center mb-3">
                    <span class="text">
                        <a href="../index.php">Back to Home</a>
                    </span>
                </div>
            </div>

            <div class="form signup" style="overflow: auto;">
            <span class="title">Job <b style="color: #5bc0de;">Owner</b> Registration</span>

            <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <h5 class="text-uppercase text-muted mb-3 mt-2">Personal Information</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="text" name="name" placeholder="Full Name" required>
                            <i class="uil uil-user"></i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="text" name="address" placeholder="Complete Address" required>
                            <i class="uil uil-map-marker"></i>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="tel" name="contact" placeholder="Phone Number" pattern="[0-9]{11}" required>
                            <i class="uil uil-phone"></i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="date" name="birthday" placeholder="Birthday" required>
                            <i class="uil uil-calender"></i>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope"></i>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="password" name="password" placeholder="Password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
                    </div>
                </div>

                <h5 class="text-uppercase text-muted mb-3 mt-2">Business Information</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="text" name="business_name" placeholder="Business Name" required>
                            <i class="uil uil-briefcase"></i>
                        </div>
                    </div>
                    

                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="text" name="company_detail" placeholder="Business Description" required>
                            <i class="uil uil-info-circle"></i>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="email" name="company_email" placeholder="Business Email" required>
                            <i class="uil uil-envelope"></i>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="input-field">
                            <input type="tel" name="company_contact" placeholder="Business Contact" pattern="[0-9]{11}" required>
                            <i class="uil uil-phone"></i>
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <input type="text" name="business_location" placeholder="Business Location" required>
                    <i class="uil uil-map-marker"></i>
                </div>

                <div class="p-4">
                    <select name="occupation" class="form-select form-select-lg custom-select" required>
                        <option value="" selected disabled>Select Job Role</option>
                        <option value="CEO">CEO</option>
                        <option value="COO">COO</option>
                        <option value="CFO">CFO</option>
                        <option value="CTO">CTO</option>
                        <option value="President">President</option>
                        <option value="Vice President">Vice President</option>
                        <option value="Senior Director">Senior Director</option>
                        <option value="Assistant Director">Assistant Director</option>
                        <option value="Manager">Manager</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div class="input-field">
                    <label for="business_permit">Business Permit</label>
                    <input type="file" name="business_permit" required>
                </div>

                <div class="input-field">
                    <label for="business_picture">Business Picture</label>
                    <input type="file" name="business_picture" required>
                </div>

                <div class="input-field">
                    <label for="valid_id">Valid ID</label>
                    <input type="file" name="valid_id" required>
                </div>

                <div class="input-field">
                    <label for="company_logo">Company Logo</label>
                    <input type="file" name="company_logo" required>
                </div>

                <div class="input-field">
                    <label for="dti_permit">DTI Permit</label>
                    <input type="file" name="dti_permit" required>
                </div>

                <div class="input-field">
                    <label for="dir">Dir Permit</label>
                    <input type="file" name="dir" required>
                </div>

                <div class="input-field">
                    <label for="sss">SSS Permit</label>
                    <input type="file" name="sss" required>
                </div>

                <div class="input-field button">
                    <input type="submit" name="signup_submit" value="Signup Now">
                </div>
            </form>

            <div class="login-signup mt-3">
                <span class="text">Already have an account?
                    <a href="#" class="text login-link">Login now</a>
                </span>
            </div>
            <div class="text-center mb-3">
                <span class="text">
                    <a href="../index.php">Back to Home</a>
                </span>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
