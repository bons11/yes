<?php
include 'auth/php/config.php';

// Fetch the current user's data
$user_id = $_SESSION['id'];
$sql = "SELECT name, address, contact, birthday, email FROM tbl_user WHERE uid = '$user_id'";
$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    // Handle error or set default values
    $user = [
        'name' => '',
        'address' => '',
        'contact' => '',
        'birthday' => '',
        'email' => ''
    ];
}
//nword
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal Form Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .modal-content {
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="process_form.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user['birthday']); ?>" required>
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" class="form-control" id="occupation" placeholder="(Optional)" name="occupation">
            </div>
            <div class="form-group">
                <label for="contact">Contact Number:</label>
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="business_name">Business Name:</label>
                <input type="text" class="form-control" id="business_name" name="business_name" required>
            </div>
            <div class="form-group">
                <label for="business_location">Business Location:</label>
                <input type="text" class="form-control" id="business_location" name="business_location" required>
            </div>
            <div class="form-group">
                <label for="business_permit">Business Permit:</label>
                <input type="file" class="form-control" id="business_permit" name="business_permit" required>
            </div>
            <div class="form-group">
                <label for="business_picture">Business Picture:</label>
                <input type="file" class="form-control" id="business_picture" name="business_picture" required>
            </div>
            <div class="form-group">
                <label for="valid_id">Valid ID:</label>
                <input type="file" class="form-control" id="valid_id" name="valid_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>