<?php
include '../auth/php/config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = mysqli_real_escape_string($con, $_POST['uid']);

    // Update the role in tbl_user
    $query_update_user = "UPDATE tbl_user SET role='representative' WHERE uid='$uid'";
    if (mysqli_query($con, $query_update_user)) {
        // Remove the user from tbl_job_owner_apply
        $query_remove_user = "DELETE FROM tbl_job_owner_apply WHERE uid='$uid'";
        if (mysqli_query($con, $query_remove_user)) {
            echo "User approved and removed successfully from job owner requests.";
        } else {
            echo "Error removing user from job owner requests: " . mysqli_error($con);
        }
    } else {
        echo "Error updating user role: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Invalid request method.";
}
?>
