<?php
// Include config.php file
include '../auth/php/config.php';

// Initialize an empty array to store validation errors
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $name = validate_input($_POST["name"]);
    $address = validate_input($_POST["address"]);
    $contact = validate_input($_POST["contact"]);
    $birthday = validate_input($_POST["birthday"]);
    $email = validate_input($_POST["email"]);
    $password = $_POST["password"]; // Password field without validation for user input
    $role = validate_input($_POST["role"]);

    // Check if any field is empty
    if (empty($name) || empty($address) || empty($contact) || empty($birthday) || empty($email) || empty($password) || empty($role)) {
        $errors[] = "All fields are required.";
    }

    // If there are no validation errors, insert data into tbl_user
    if (empty($errors)) {
        // No need to hash the password here
        $hashed_password = $password;
        
        $query = "INSERT INTO tbl_user (name, address, contact, birthday, email, password, role) VALUES ('$name', '$address', '$contact', '$birthday', '$email', '$hashed_password', '$role')";
        
        if (mysqli_query($con, $query)) {
            // Redirect back to page-user-list.php
            echo "<script>window.location.href='page-user-list.php';</script>";
            // Show success message in popup alert
            echo "<script>alert('User added successfully.');</script>";
            // Exit the script
            exit();
        } else {
            // Show error message in popup alert
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        // If there are validation errors, output them
        $error_message = implode("<br>", $errors);
        // Show error message in popup alert
        echo "<script>alert('$error_message');</script>";
    }
}

// Function to validate form input
function validate_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>