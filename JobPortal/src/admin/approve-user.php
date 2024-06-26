<?php
include '../auth/php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Fetch user details from tbl_job_owner_apply
    $query_get_user = "SELECT * FROM tbl_job_owner_apply WHERE id='$id'";
    $result_user = mysqli_query($con, $query_get_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $row = mysqli_fetch_assoc($result_user);
        
        $name = mysqli_real_escape_string($con, $row['name']);
        $address = mysqli_real_escape_string($con, $row['address']);
        $birthday = mysqli_real_escape_string($con, $row['birthday']);
        $password = mysqli_real_escape_string($con, $row['password']);
        $email = mysqli_real_escape_string($con, $row['email']);
        $business_name = mysqli_real_escape_string($con, $row['business_name']);
        $business_location = mysqli_real_escape_string($con, $row['business_location']);
        $company_detail = mysqli_real_escape_string($con, $row['company_detail']);
        $company_email = mysqli_real_escape_string($con, $row['company_email']);
        $company_contact = mysqli_real_escape_string($con, $row['company_contact']);
        $contact = mysqli_real_escape_string($con, $row['contact']);
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
            $query_insert_user = "INSERT INTO tbl_user (name, address, birthday, password, company, role, email, contact, logo) 
                              VALUES ('$name', '$address', '$birthday', '$password', '$business_name',  'representative', '$email', '$contact', '$logo')";
            if (mysqli_query($con, $query_insert_user)) {
                // Remove user from tbl_job_owner_apply
                $query_remove_user = "DELETE FROM tbl_job_owner_apply WHERE id='$id'";
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

<?php
include '../auth/php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = mysqli_real_escape_string($con, $_POST['id']);

    // Fetch user details from tbl_job_owner_apply
    $query_get_user = "SELECT * FROM tbl_job_owner_apply WHERE id='$id'";
    $result_user = mysqli_query($con, $query_get_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $row = mysqli_fetch_assoc($result_user);
        
        // Insert user details into tbl_user
        $name = mysqli_real_escape_string($con, $row['name']);
        $address = mysqli_real_escape_string($con, $row['address']);
        $birthday = mysqli_real_escape_string($con, $row['birthday']);
        $business_name = mysqli_real_escape_string($con, $row['business_name']);
        $business_location = mysqli_real_escape_string($con, $row['business_location']);
        $company_detail = mysqli_real_escape_string($con, $row['company_detail']);
        $company_email = mysqli_real_escape_string($con, $row['company_email']);
        $company_contact = mysqli_real_escape_string($con, $row['company_contact']);
        $contact = mysqli_real_escape_string($con, $row['contact']);
        $logo = mysqli_real_escape_string($con, $row['logo']);

        $query_insert_user = "INSERT INTO tbl_user (name, address, birthday, company, role, email, contact, logo) 
                              VALUES ('$name', '$address', '$birthday','$business_name',  'representative', '$company_email', '$contact', '$logo')";
        if (mysqli_query($con, $query_insert_user)) {
            // Remove user from tbl_job_owner_apply
            $query_remove_user = "DELETE FROM tbl_job_owner_apply WHERE id='$id'";
            if (mysqli_query($con, $query_remove_user)) {
                echo "User approved and added to users table.";
            } else {
                echo "Error removing user from job owner requests: " . mysqli_error($con);
            }
        } else {
            echo "Error inserting user into users table: " . mysqli_error($con);
        }
    } else {
        echo "User details not found or already approved.";
    }

    mysqli_close($con);
} else {
    echo "Invalid request method.";
}
?>


