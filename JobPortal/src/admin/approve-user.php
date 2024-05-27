<?php
include '../auth/php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = mysqli_real_escape_string($con, $_POST['uid']);

    // Fetch user details from tbl_job_owner_apply
    $query_get_user = "SELECT * FROM tbl_job_owner_apply WHERE uid='$uid'";
    $result_user = mysqli_query($con, $query_get_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $row = mysqli_fetch_assoc($result_user);
        
        // Insert user details into tbl_company
        $company_owner = mysqli_real_escape_string($con, $row['name']);
        $company_name = mysqli_real_escape_string($con, $row['business_name']);
        $company_address = mysqli_real_escape_string($con, $row['business_location']);
        $company_detail = mysqli_real_escape_string($con, $row['company_detail']);
        $company_email = mysqli_real_escape_string($con, $row['company_email']);
        $company_contact = mysqli_real_escape_string($con, $row['company_contact']);
        $logo = mysqli_real_escape_string($con, $row['logo']);

        $query_insert_company = "INSERT INTO tbl_company (company_owner, company_name, company_address, company_detail, company_email, company_contact, logo) 
                                VALUES ('$company_owner', '$company_name', '$company_address', '$company_detail', '$company_email', '$company_contact', '$logo')";
        if (mysqli_query($con, $query_insert_company)) {
            // Update user role and company in tbl_user
            $query_update_user = "UPDATE tbl_user SET role='representative', company='$company_name' WHERE uid='$uid'";
            if (mysqli_query($con, $query_update_user)) {
                // Remove user from tbl_job_owner_apply
                $query_remove_user = "DELETE FROM tbl_job_owner_apply WHERE uid='$uid'";
                if (mysqli_query($con, $query_remove_user)) {
                    echo "User approved and added to company records.";
                } else {
                    echo "Error removing user from job owner requests: " . mysqli_error($con);
                }
            } else {
                echo "Error updating user role: " . mysqli_error($con);
            }
        } else {
            echo "Error inserting user into company records: " . mysqli_error($con);
        }
    } else {
        echo "User details not found or already approved.";
    }

    mysqli_close($con);
} else {
    echo "Invalid request method.";
}
?>
