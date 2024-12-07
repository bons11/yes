<?php
// Include the database configuration file
include '../auth/php/config.php';

// Check if the user ID is set and not empty
if (isset($_POST['uid']) && !empty($_POST['uid'])) {
    // Sanitize and validate the user ID
    $uid = mysqli_real_escape_string($con, $_POST['uid']);

    // Begin a transaction (for data consistency)
    mysqli_autocommit($con, false);

    // Get the UUID of the user to be deleted
    $query_uuid = "SELECT uuid FROM tbl_user WHERE uid = '$uid'";
    $result_uuid = mysqli_query($con, $query_uuid);

    if ($result_uuid) {
        $row = mysqli_fetch_assoc($result_uuid);
        $uuid = $row['uuid'];

        // Prepare delete statements for tbl_user, tbl_company, tbl_vacancy, and tbl_applicant
        $query_user = "DELETE FROM tbl_user WHERE uid = '$uid'";
        $query_company = "DELETE FROM tbl_company WHERE uuid = '$uuid'";
        $query_vacancy = "DELETE FROM tbl_vacancy WHERE uuid = '$uuid'";
        $query_applicant = "DELETE FROM tbl_applicant WHERE job_number IN (SELECT job_number FROM tbl_vacancy WHERE uuid = '$uuid')";

        // Execute the delete statements
        $success = true;
        if (!mysqli_query($con, $query_user)) {
            $success = false;
        }
        if (!mysqli_query($con, $query_company)) {
            $success = false;
        }
        if (!mysqli_query($con, $query_vacancy)) {
            $success = false;
        }
        if (!mysqli_query($con, $query_applicant)) {
            $success = false;
        }

        if ($success) {
            // Commit the transaction
            mysqli_commit($con);

            // User and related data deleted successfully
            echo "User and related data deleted successfully";
        } else {
            // Rollback the transaction on failure
            mysqli_rollback($con);

            // Error occurred while deleting data
            echo "Error deleting data: " . mysqli_error($con);
        }
    } else {
        // Rollback the transaction on failure to retrieve UUID
        mysqli_rollback($con);

        // Error occurred while retrieving UUID
        echo "Error retrieving UUID: " . mysqli_error($con);
    }
} else {
    // Return an error if user ID is not provided
    echo "User ID not provided";
}

// Close database connection
mysqli_close($con);
?>
