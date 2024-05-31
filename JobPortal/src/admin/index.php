<?php
session_start(); // Start the session
include('../auth/php/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="img/bugallon-seal.png" rel="icon">
  <link rel="stylesheet" href="style/admin-style.css">
  <title>Admin Login</title>
</head>
<body>
  
  <div class="container">
    <div class="myform">
      <form method="post">
        <h2>Admin Login</h2>
        <input type="text" placeholder="Username or email" name="email" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
    <div class="image">
      <img src="style/images/image.png">
    </div>
  </div>

  <?php
    // Include config file
    include_once '../auth/php/config.php';

    // PHP code to check login
    if(isset($_POST['login'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];

      // Fetch user from database
      $query = "SELECT * FROM tbl_user WHERE email='$email' AND password='$password' AND role='admin'";
      $result = mysqli_query($con, $query);

      // Check if user exists and is an admin
      if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        header("Location: page-dashboard.php");
      } else {
        echo "<script>alert('Invalid Email or password for Admin');</script>";
      }
    }
  ?>

</body>
</html>
