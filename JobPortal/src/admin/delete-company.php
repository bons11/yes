<?php
// Include the database configuration file
include '../auth/php/config.php';

// Check if the user ID is set and not empty
if (isset($_POST['uid']) && !empty($_POST['uid'])) {
    // Sanitize and validate the user ID
    $uid = mysqli_real_escape_string($con, $_POST['uid']);

    // Prepare a delete statement
    $query = "DELETE FROM tbl_company WHERE uid = '$uid'";

    // Execute the delete statement
    if (mysqli_query($con, $query)) {
        // User deleted successfully
        echo "Category deleted successfully";
    } else {
        // Error occurred while deleting user
        echo "Error deleting category: " . mysqli_error($con);
    }
} else {
    // Return an error if user ID is not provided
    echo "Category ID not provided";
}

// Close database connection
mysqli_close($con);
?>