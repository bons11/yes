<?php
include 'auth/php/config.php';


if (!isset($_SESSION['id'])) {

    return;
}
// Fetch the current user's data
$user_id = $_SESSION['id'];
$sql = "SELECT name, address, contact, birthday, email, company FROM tbl_user WHERE uid = '$user_id'";
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
    <?php
if (isset ($_SESSION['role']) && $_SESSION['role']  == "representative") {
                    ?>
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Vacancy</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="admin/add-vacancy.php" method="post" enctype="multipart/form-data">
            <!-- Company Name -->
            <div class="form-group">
                <label for="job_title">Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($user['company']); ?>" required>
            </div>
            <div class="mb-3">
                    <label for="company_category" class="form-label">Company Category</label>
                    <select class="form-select" id="company_category" name="company_category" required>
                        <?php
                        include 'auth/php/config.php';

                        $category_query = "SELECT category FROM tbl_category";
                        $category_result = mysqli_query($con, $category_query);
                        while ($row = mysqli_fetch_assoc($category_result)) {
                            echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            <!-- Job Title -->
            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>

            <!-- Job Description -->
            <div class="form-group">
                <label for="job_description">Job Description:</label>
                <input type="text" class="form-control" id="job_description" name="job_description" required>
            </div>
            <div class="mb-3">
                    <label for="responsibility_detail" class="form-label">Job Responsibility</label>
                    <input type="text" class="form-control" id="responsibility_detail" name="responsibility_detail" required>
                </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub1" name="responsibility_sub1" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub2" name="responsibility_sub2" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub3" name="responsibility_sub3" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub4" name="responsibility_sub4" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="responsibility_sub5" name="responsibility_sub5" placeholder="•" required>
                </div>
            <!-- Job Salary -->
            <div class="form-group">
                <label for="job_salary">Job Salary:</label>
                <input type="number" class="form-control" id="job_salary" name="job_salary" placeholder="Optional">
            </div>

            <!-- Job Nature -->
            <div class="form-group">
                <label for="job_nature">Job Nature:</label>
                <select class="form-control" id="job_nature" name="job_nature" required>
                    <option value="Full Time">Full Time</option>
                    <option value="Part Time">Part Time</option>
                </select>
            </div>
            <div class="mb-3">
                    <label for="town" class="form-label">Town</label>
                        <select class="form-select" id="town" name="town" required>
                            <option>Aguilar </option>
                            <option>Binmaley</option>
                            <option>Bugallon</option>
                            <option>Lingayen</option>
                            <option>Mangatarem</option>
                            <option>Labrador</option>
                        </select>
                </div>

            <!-- Location -->
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" required>
            </div>

            <div class="mb-3">
                    <label for="qualification_detail" class="form-label">Qualifications</label>
                    <input type="text" class="form-control" id="qualification_detail" name="qualification_detail" required>
                </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub1" name="qualification_sub1" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub2" name="qualification_sub2" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub3" name="qualification_sub3" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub4" name="qualification_sub4" placeholder="•" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="qualification_sub5" name="qualification_sub5" placeholder="•" required>
                    </div>

            <!-- Date Created -->
            <div class="form-group">
                <label for="date_created">Date Created:</label>
                <input type="date" class="form-control" id="date_created" name="date_created" required>
            </div>

            <!-- Date End -->
            <div class="form-group">
                <label for="date_end">Date End:</label>
                <input type="date" class="form-control" id="date_end" name="date_end" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>


<!-- post a job modal below vvvvvvv -->


<?php
} elseif(isset ($_SESSION['name'])) {
    ?>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <form action="process_form.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($user['name']); ?>" required style="display:none">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required style="display:none">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($user['birthday']); ?>" required style="display:none">
            </div>
            <div class="form-group">
                <label for="occupation">Occupation:</label>
                <input type="text" class="form-control" id="occupation" placeholder="(Optional)" name="occupation">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo htmlspecialchars($user['contact']); ?>" required style="display:none">
            </div>
            <div class="form-group">
                <textarea class="form-control" style="display:none" id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>
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
                <label for="company_detail">Company Detail:</label>
                <input type="text" class="form-control" id="company_detail" name="company_detail" required>
            </div>
            <div class="form-group">
                <label for="company_email">Company Email:</label>
                <input type="email" class="form-control" id="company_email" name="company_email" required>
            </div>
            <div class="form-group">
                <label for="company_contact">Company Contact:</label>
                <input type="text" class="form-control" id="company_contact" name="company_contact" required>
            </div>
            <div class="form-group">
                <label for="valid_id">Company Logo:</label>
                <input type="file" class="form-control" id="logo" name="logo">
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
            <!-- Additional Fields for Company Details -->
            <!-- End of Additional Fields -->
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
<?php
}
?>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>