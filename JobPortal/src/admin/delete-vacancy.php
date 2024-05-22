<?php

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database configuration file
include '../auth/php/config.php';

// Check if the job number is set and not empty
if (isset($_POST['job_number']) && !empty($_POST['job_number'])) {
    // Sanitize and validate the job number
    $job_number = mysqli_real_escape_string($con, $_POST['job_number']);
    
    // Prepare delete statements for all related tables
    $query_vacancy = "DELETE FROM tbl_vacancy WHERE job_number = '$job_number'";
    $query_responsibility = "DELETE FROM tbl_responsibility WHERE job_number = '$job_number'";
    $query_qualification = "DELETE FROM tbl_qualification WHERE job_number = '$job_number'";

    // Execute the delete statements
    if (mysqli_query($con, $query_vacancy) && mysqli_query($con, $query_responsibility) && mysqli_query($con, $query_qualification)) {
        // Vacancy and associated entries deleted successfully
        echo "Vacancy and associated entries deleted successfully";
    } else {
        // Error occurred while deleting
        echo "Error deleting entries: " . mysqli_error($con);
    }
} else {
    // Return an error if job number is not provided
    echo "Job number not provided";
}

// Close database connection
mysqli_close($con);
?>