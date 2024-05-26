<?php
// Include the database configuration file
include '../auth/php/config.php';

// Check if the user ID is set and not empty
if (isset($_POST['id']) && !empty($_POST['id'])) {
    // Sanitize and validate the user ID
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Prepare a delete statement
    $query = "DELETE FROM tbl_job_owner_apply WHERE id = '$id'";

    // Execute the delete statement
    if (mysqli_query($con, $query)) {
        // User deleted successfully
        echo "User deleted successfully";
    } else {
        // Error occurred while deleting user
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    // Return an error if user ID is not provided
    echo "User ID not provided";
}

// Close database connection
mysqli_close($con);
?>