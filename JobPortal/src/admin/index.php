<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../img/bugallon-seal.png" rel="icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style/index.css">
  <style>
    
  </style>
  <title>EBB Admin</title>
</head>
<body>

  <div class="container">
    <div class="myform">
      <img src="style/images/image.png" alt="Bugallon Seal">
      <form method="post">
        <h2 class="text-center"><b>Admin Login</b></h2>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Username or email" name="email" required>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
        </div>
        <a href="../index.php">Back to Home</a>

      </form>
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
