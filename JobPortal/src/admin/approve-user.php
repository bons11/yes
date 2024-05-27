<?php
include '../auth/php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = mysqli_real_escape_string($con, $_POST['uid']);

    // Fetch the company_name from tbl_job_owner_apply
    $query_get_company = "SELECT business_name FROM tbl_job_owner_apply WHERE uid='$uid'";
    $result = mysqli_query($con, $query_get_company);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $business_name = mysqli_real_escape_string($con, $row['business_name']);
        
        // Update the role and company in tbl_user
        $query_update_user = "UPDATE tbl_user SET role='representative', company='$business_name' WHERE uid='$uid'";
        if (mysqli_query($con, $query_update_user)) {
            // Remove the user from tbl_job_owner_apply
            $query_remove_user = "DELETE FROM tbl_job_owner_apply WHERE uid='$uid'";
            if (mysqli_query($con, $query_remove_user)) {
                echo "User approved.";
            } else {
                echo "Error removing user from job owner requests: " . mysqli_error($con);
            }
        } else {
            echo "Error updating user role: " . mysqli_error($con);
        }
    } else {
        echo "Error fetching company name: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    echo "Invalid request method.";
}
?>
