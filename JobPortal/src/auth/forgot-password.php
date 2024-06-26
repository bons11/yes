<?php
session_start(); // Start the session
include("php/config.php");

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Fetch user data from the database based on the provided email
    $query = "SELECT uid, email, password FROM tbl_user WHERE email = '$email'";
    $result = mysqli_query($con, $query); // Use $con instead of $conn

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['tbl_user'] = $user; // Store user data in session
        header("Location: change-password.php"); // Redirect to change-password.php
        exit();
    } else {
        // Handle error if user not found
        $error = "User not found!";
        echo "<script>alert('$error');</script>"; // Display error message in a popup
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="../img/ebb-logo.png" rel="icon">
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
                <span class="title">Forgot Password</span>
                <br>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="login_submit" value="Continue">
                    </div>

                </form>

                <!-- Clickable label -->
                <div class="clickable-label">Remember your password? <a href="login.php">Login here</a></div>

            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>