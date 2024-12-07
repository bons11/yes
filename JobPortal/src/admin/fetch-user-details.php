<?php
include '../auth/php/config.php'; // Include config.php file

// Check if $con variable is defined and valid
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user ID from the query parameter
$id = intval($_GET['id']);

// Fetch user details from tbl_job_owner_apply
$query = "SELECT name, email, password, birthday, contact, occupation, address, business_name, company_detail, company_email, company_contact, business_location FROM tbl_job_owner_apply WHERE id = $id";
$result = mysqli_query($con, $query);

// Check if query was successful
if (!$result) {
    echo "Error: " . mysqli_error($con);
    exit();
}

// Fetch the user details and return as JSON
$user = mysqli_fetch_assoc($result);
echo json_encode($user);

// Close database connection
mysqli_close($con);
?>
