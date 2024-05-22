<?php
// Include config.php file
include '../auth/php/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an empty array to store validation errors
    $errors = [];

    // Validate form inputs
    $date = validate_input($_POST["date"]);
    $category = validate_input($_POST["category"]);
    $description = validate_input($_POST["description"]);
    $status = validate_input($_POST["status"]);

    // File upload handling
    $logo = $_FILES["logo"];
    $logo_tmp_name = $logo["tmp_name"];
    $logo_error = $logo["error"];

    // Check if any field is empty
    if (empty($date) || empty($category) || empty($description) || empty($status)) {
        $errors[] = "All fields are required.";
    }

    // Check for logo upload error
    if ($logo_error !== UPLOAD_ERR_OK) {
        $errors[] = "Error uploading logo.";
    }

    // If there are no validation errors, insert data into tbl_category
    if (empty($errors)) {
        // Read the contents of the uploaded file
        $logo_data = file_get_contents($logo_tmp_name);

        // Insert data into database
        $query = "INSERT INTO tbl_category (date, category, description, status, logo) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $date, $category, $description, $status, $logo_data);
        
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to page-category.php after successful insertion
            header("Location: page-category.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
    } else {
        // If there are validation errors, output them
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    // Close database connection
    mysqli_close($con);
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