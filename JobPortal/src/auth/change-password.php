<?php
session_start(); // Start the session
include("php/config.php");

$error = ""; // Initialize error message

if (!isset($_SESSION['tbl_user']['uid'])) {
    header("Location: forgot-password.php"); // Redirect to forgot-password.php if user session is not set
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>"; // Display error message in a popup
    } else {
        // Update the password in the database
        $uid = $_SESSION['tbl_user']['uid'];
        $query = "UPDATE tbl_user SET password = '$password' WHERE uid = $uid";
        $result = mysqli_query($con, $query); // Use $con instead of $conn

        if ($result) {
            // Password updated successfully
            echo "<script>alert('Password changed successfully!'); window.location.href='login.php';</script>"; // Display success message in a popup and then redirect
            exit();
        } else {
            // Handle error if password update fails
            $error = "Failed to update password!";
            echo "<script>alert('$error'); window.location.href='login.php';</script>"; // Display error message in a popup and then redirect
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style/style.css">
         
    <title>Login & Registration Form</title>
    <style>
        /* Style for the clickable label */
        .clickable-label {
            margin-top: 20px; /* Adjust top margin as needed */
            text-align: center;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="forms">

            <div class="form login">
                <span class="title">Change Password</span>
                <br>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field">
                        <input type="password" name="password" class="password" id="password" placeholder="New Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw" onclick="togglePasswordVisibility('password')"></i>
                    </div>

                    <div class="input-field">
                        <input type="password" name="confirm_password" class="password" id="confirm_password" placeholder="Confirm Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw" onclick="togglePasswordVisibility('confirm_password')"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login_submit" value="Change">
                    </div>

                </form>

                <!-- Clickable label -->
                <div class="clickable-label">Remember your password? <a href="login.php">Login here</a></div>

            </div>
        </div>
    </div>

    <script>
    // Function to toggle password visibility
    function togglePasswordVisibility(fieldId) {
        var field = document.getElementById(fieldId);
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    }
</script>

</body>
</html>