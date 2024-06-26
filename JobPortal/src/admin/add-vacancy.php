<?php
// Include config.php file
include '../auth/php/config.php';

// Initialize an empty array to store validation errors
$errors = [];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $company_category = validate_input($_POST["company_category"]);
    $company_name = validate_input($_POST["company_name"]);
    $job_title = validate_input($_POST["job_title"]);
    $job_description = validate_input($_POST["job_description"]);
    $job_salary = $_POST["job_salary"]; 
    $job_nature = validate_input($_POST["job_nature"]);
    $location = validate_input($_POST["location"]);
    $date_created = $_POST["date_created"];
    $date_end = validate_input($_POST["date_end"]);

    $responsibility_detail = validate_input($_POST["responsibility_detail"]);
    $responsibility_sub1 = validate_input($_POST["responsibility_sub1"]);
    $responsibility_sub2 = validate_input($_POST["responsibility_sub2"]);
    $responsibility_sub3 = validate_input($_POST["responsibility_sub3"]);
    $responsibility_sub4 = validate_input($_POST["responsibility_sub4"]);
    $responsibility_sub5 = validate_input($_POST["responsibility_sub5"]);

    $qualification_detail = validate_input($_POST["qualification_detail"]);
    $qualification_sub1 = validate_input($_POST["qualification_sub1"]);
    $qualification_sub2 = validate_input($_POST["qualification_sub2"]);
    $qualification_sub3 = validate_input($_POST["qualification_sub3"]);
    $qualification_sub4 = validate_input($_POST["qualification_sub4"]);
    $qualification_sub5 = validate_input($_POST["qualification_sub5"]);

    // Check if any field is empty
    if (empty($company_category) || empty($company_name) || empty($job_title) || empty($job_description) || empty($job_nature) || empty($location) || empty($date_created) || empty($date_end) || empty($responsibility_detail) || empty($qualification_detail)) {
        $errors[] = "All fields are required.";
    }

    // If there are no validation errors, insert data into tbl_vacancy, tbl_responsibility, and tbl_qualification
    if (empty($errors)) {
        // Generate a job number
        $job_number = generate_job_number();

        // Insert into tbl_vacancy
        $query_vacancy = "INSERT INTO tbl_vacancy (job_number, company_category, company_name, job_title, job_description, job_salary, job_nature, location, date_created, date_end) VALUES ('$job_number', '$company_category', '$company_name', '$job_title', '$job_description', '$job_salary','$job_nature', '$location', '$date_created', '$date_end')";
        // Insert into tbl_responsibility
        $query_responsibility = "INSERT INTO tbl_responsibility (job_number, responsibility_detail, responsibility_sub1, responsibility_sub2, responsibility_sub3, responsibility_sub4, responsibility_sub5) VALUES ('$job_number', '$responsibility_detail', '$responsibility_sub1' , '$responsibility_sub2' , '$responsibility_sub3' , '$responsibility_sub4' , '$responsibility_sub5')";
        // Insert into tbl_qualification
        $query_qualification = "INSERT INTO tbl_qualification (job_number, qualification_detail, qualification_sub1, qualification_sub2, qualification_sub3, qualification_sub4, qualification_sub5) VALUES ('$job_number', '$qualification_detail', '$qualification_sub1' , '$qualification_sub2' , '$qualification_sub3' , '$qualification_sub4' , '$qualification_sub5')";

        // Perform the queries
        if (mysqli_query($con, $query_vacancy) && mysqli_query($con, $query_responsibility) && mysqli_query($con, $query_qualification)) {
            // Redirect back to page-vacancy.php
            echo "<script>window.location.href='page-vacancy.php';</script>";
            // Show success message in popup alert
            echo "<script>alert('Vacancy added successfully.');</script>";
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

// Function to generate a unique job number
function generate_job_number() {
    // Generate a random number between 100000 and 999999
    return mt_rand(100000, 999999);
}
?>
