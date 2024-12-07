<?php
session_start();
include 'auth/php/config.php';

// Define the upload directory
$upload_dir = 'uploads/';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file uploads
    $business_permit_path = $upload_dir . basename($_FILES['business_permit']['name']);
    $business_picture_path = $upload_dir . basename($_FILES['business_picture']['name']);
    $valid_id_path = $upload_dir . basename($_FILES['valid_id']['name']);
    $logo_path = $upload_dir . basename($_FILES['logo']['name']); // Logo path

    // Move uploaded files to the upload directory
    if (move_uploaded_file($_FILES['business_permit']['tmp_name'], $business_permit_path) &&
        move_uploaded_file($_FILES['business_picture']['tmp_name'], $business_picture_path) &&
        move_uploaded_file($_FILES['valid_id']['tmp_name'], $valid_id_path) &&
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_path)) {

        // Insert data into tbl_job_owner_apply including the user ID
        $user_id = $_SESSION['id'];
        $name = mysqli_real_escape_string($con, $_POST['fullname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $birthday = mysqli_real_escape_string($con, $_POST['dob']);
        $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $business_name = mysqli_real_escape_string($con, $_POST['business_name']);
        $business_location = mysqli_real_escape_string($con, $_POST['business_location']);
        $company_email = mysqli_real_escape_string($con, $_POST['company_email']);
        $company_detail = mysqli_real_escape_string($con, $_POST['company_detail']);
        $company_contact = mysqli_real_escape_string($con, $_POST['company_contact']);

        $sql_apply = "INSERT INTO tbl_job_owner_apply (uid, name, email, birthday, contact, occupation, address, business_name, business_location, business_permit, business_picture, valid_id, logo, company_email, company_detail, company_contact) 
                VALUES ('$user_id', '$name', '$email', '$birthday', '$contact', '$occupation', '$address', '$business_name', '$business_location', '$business_permit_path', '$business_picture_path', '$valid_id_path', '$logo_path', '$company_email', '$company_detail', '$company_contact')";

        if (mysqli_query($con, $sql_apply)) {
            // Redirect to index.php
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql_apply . "<br>" . mysqli_error($con);
        }
    } else {
        echo "File upload failed.";
    }

    // Close the database connection
    mysqli_close($con);
}
?>
