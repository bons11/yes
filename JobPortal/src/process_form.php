<?php
session_start();
include 'auth/php/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID from the session
    $user_id = $_SESSION['id'];

    // Get the form data
    $name = mysqli_real_escape_string($con, $_POST['fullname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $birthday = mysqli_real_escape_string($con, $_POST['dob']);
    $occupation = mysqli_real_escape_string($con, $_POST['occupation']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $business_name = mysqli_real_escape_string($con, $_POST['business_name']);
    $business_location = mysqli_real_escape_string($con, $_POST['business_location']);

    // Handle file uploads
    $business_permit = $_FILES['business_permit']['tmp_name'];
    $business_picture = $_FILES['business_picture']['tmp_name'];
    $valid_id = $_FILES['valid_id']['tmp_name'];

    // Convert files to base64 for storing in database
    $business_permit_base64 = base64_encode(file_get_contents($business_permit));
    $business_picture_base64 = base64_encode(file_get_contents($business_picture));
    $valid_id_base64 = base64_encode(file_get_contents($valid_id));

    // Insert data into tbl_job_owner_apply
    $sql = "INSERT INTO tbl_job_owner_apply (name, email, birthday, contact, occupation, address, business_name, business_location, business_permit, business_picture, valid_id) 
            VALUES ('$name', '$email', '$birthday', '$contact', '$occupation', '$address', '$business_name', '$business_location', '$business_permit_base64', '$business_picture_base64', '$valid_id_base64')";

    if (mysqli_query($con, $sql)) {
        echo "Data inserted successfully.";
        // Redirect or show a success message
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
        // Handle the error
    }

    // Close the database connection
    mysqli_close($con);
}
?>
