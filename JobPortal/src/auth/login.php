<?php
session_start(); // Start the session
include("php/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href=".../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style/style.css">
    <title>Employment Bulletin Board</title>
    <link href="../img/ebb-logo.png" rel="icon">

</head>
<body>
    
    
    <div class="container py-5 px-4">
        <div class="forms">
        <?php 
            if(isset($_POST['login_submit'])){
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                // Fetch user from database based on email and password
                $query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
                $result = mysqli_query($con, $query);

                // Check if the user exists
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['role'] == 'user') {
                        // Set session variables
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['address'] = $row['address'];
                        $_SESSION['contact'] = $row['contact'];
                        $_SESSION['birthday'] = $row['birthday'];
                        $_SESSION['password'] = $row['password'];
                        $_SESSION['id'] = $row['uid'];
                        $_SESSION['uuid'] = $row['uuid'];
                        $_SESSION['role'] = $row['role']; // Store the user's role in the session

                        // Remember Me functionality
                        if(isset($_POST['remember'])) {
                            setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
                            setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
                        } else {
                            if(isset($_COOKIE['email'])) {
                                setcookie('email', '', time() - 3600, '/'); // delete cookie
                            }
                            if(isset($_COOKIE['password'])) {
                                setcookie('password', '', time() - 3600, '/'); // delete cookie
                            }
                        }

                        // Redirect to index page
                        header("Location: ../index.php");
                        exit();
                    } else {
                        // If the user exists but does not have the role 'user' or 'representative', show error
                        echo "<script>alert('Invalid Username or Password');</script>";
                    }
                } else {
                    // If no user found with provided email and password, show error
                    echo "<script>alert('Invalid Username or Password');</script>";
                }
            }
            $upload_dir = '../uploads/';
           
            if(isset($_POST['signup_submit'])){
                $valid_id_path = $upload_dir . basename($_FILES['valid_id']['name']);

                if (move_uploaded_file($_FILES['valid_id']['tmp_name'], $valid_id_path)){

                $name = mysqli_real_escape_string($con,$_POST['name']);
                $address = mysqli_real_escape_string($con,$_POST['address']);
                $contact = mysqli_real_escape_string($con,$_POST['contact']);
                $birthday = mysqli_real_escape_string($con,$_POST['birthday']);
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);
                $confirm_password = mysqli_real_escape_string($con,$_POST['confirm_password']);

                // Check if passwords match
                if($password !== $confirm_password) {
                    echo "<script>alert('Passwords do not match');</script>";
                } else {
                    // Check if the email is already registered
                    $verify_query = mysqli_query($con,"SELECT email FROM tbl_user WHERE email='$email'");
                    if(mysqli_num_rows($verify_query) != 0 ){
                        // Email already exists, show error message as a pop-up
                        echo "<script>alert('This email is already in use, please try another one.');</script>";
                    } else {
                        // Insert the new user into the database
                        $insert_query = mysqli_query($con,"INSERT INTO tbl_user(name, address, contact, birthday, email, password, valid_id) VALUES('$name', '$address', '$contact', '$birthday','$email','$password' ,'$valid_id_path')") or die("Error Occurred: " . mysqli_error($con));

                        if($insert_query) {
                            // Display registration success message as a pop-up
                            echo "<script>alert('Registration successful!');</script>";
                            // Redirect to login page after registration
                            echo "<script>window.location.href = 'login.php';</script>";
                        } else {
                            // Display registration error message as a pop-up
                            echo "<script>alert('Error registering user');</script>";
                        }
                    }
                }
            } else {
                echo "File upload failed.";
            }
            mysqli_close($con);
            }
            ?>
            <div class="form login">
                <span class="title">Job <b style="color:#0275d8;">Seeker</b> Login</span>
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

                    <div class="input-field button disabled">
                        <input type="submit" name="login_submit" value="Login Now">
                    </div>
                </form>

                <div class="login-signup mt-3">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup now</a>
                    </span>
                </div>
                <div class="login-signup ">
                    <span class="text">Are you an Employer?
                        <a href="employer-login.php" class="text">Click Here</a>
                    </span>
                </div>
                <div class="text-center mb-3">
                    <span class="text">
                        <a href="../index.php">Back to Home</a>
                    </span>
                </div>
            </div>

      
            <div class="form signup">
            <span class="title">Job <b style="color:#0275d8;">Seeker</b> Registration</span>

            <form id="signupForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                <div class="input-field">
                    <input type="text" name="name" placeholder="Name" required>
                    <i class="uil uil-user"></i>
                </div>
                <div class="input-field">
                    <input type="text" name="address" placeholder="Address" required>
                    <i class="uil uil-map"></i>
                </div>
                <div class="input-field">
                    <input type="number" name="contact" placeholder="Contact" required>
                    <i class="uil uil-phone"></i>
                </div>
                <div class="input-field">
                    <input type="date" name="birthday" placeholder="Birthday" required>
                    <i class="uil uil-calender"></i>
                </div>
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <label for="valid_id">Valid ID</label><br>
                    <input type="file" name="valid_id" required>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Password" required>
                    <i class="uil uil-lock icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="confirm_password" class="password" placeholder="Confirm password" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>

                <div class="checkbox-text">
                    <div class="checkbox-content">
                        <input type="checkbox" id="agreeCheck" name="agree" required>
                        <label for="agreeCheck" class="text mt-2">I agree to the Terms & Conditions</label>
                    </div>
                </div>

                <div class="input-field button">
                    <input type="submit" name="signup_submit" value="Signup Now">
                </div>
            </form>

            <div class="login-signup">
                <span class="text ">Already a member?
                    <a href="#" class="text login-link">Login now</a>
                </span>
            </div>
        </div>

    <script src="script.js"></script>

    <script>
    function validateForm() {
        var agreeCheckbox = document.getElementById('agreeCheck');
        if (!agreeCheckbox.checked) {
            alert('Please agree to the Terms & Conditions before proceeding.');
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

</body>
</html>
