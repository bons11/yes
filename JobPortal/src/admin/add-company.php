<?php

// Include config.php file
include '../auth/php/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize an empty array to store validation errors
    $errors = [];

    // Validate form inputs
    $company_name = validate_input($_POST["company_name"]);
    $company_detail = validate_input($_POST["company_detail"]);
    $company_address = validate_input($_POST["company_address"]);
    $company_email = validate_input($_POST["company_email"]);
    $company_contact = validate_input($_POST["company_contact"]);
    $company_owner = validate_input($_POST["company_owner"]);

    // File upload handling
        $logo = $_FILES["logo"];
        $logo_tmp_name = $logo["tmp_name"];
        $logo_error = $logo["error"];

        // Check if any field is empty
        if (empty($company_name) || empty($company_detail) || empty($company_address) || empty($company_email) || empty($company_contact) || empty($company_owner)) {
            $errors[] = "All fields are required.";
        }

        // Check for logo upload error
        if ($logo_error !== UPLOAD_ERR_OK) {
            $errors[] = "Error uploading logo.";
        }

        // If there are no validation errors, insert data into tbl_company
        if (empty($errors)) {
            // Read the contents of the uploaded file
            $logo_data = file_get_contents($logo_tmp_name);

            // Insert data into database
            $query = "INSERT INTO tbl_company (company_name, company_detail, company_address, company_email, company_contact, company_owner, logo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssss", $company_name, $company_detail, $company_address, $company_email, $company_contact, $company_owner, $logo_data);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to page-company.php after successful insertion
                header("Location: page-company.php");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }

    // Output validation errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
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

// Close the database connection
mysqli_close($con);

?>