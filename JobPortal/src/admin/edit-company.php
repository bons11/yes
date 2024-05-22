<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['uid']) && !empty($_POST['uid'])) {
        $uid = $_POST['uid'];
        $company_name = $_POST['company_name'];
        $company_detail = $_POST['company_detail'];
        $company_address = $_POST['company_address'];
        $company_email = $_POST['company_email'];
        $company_contact = $_POST['company_contact'];
        $company_owner = $_POST['company_owner'];


        // Check if a new logo file is uploaded
        if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logo_tmp_name = $_FILES['logo']['tmp_name'];
            $logo_data = file_get_contents($logo_tmp_name);
            $query = "UPDATE tbl_company SET company_name=?, company_detail=?, company_address=?, company_email=?, company_contact=?, company_owner=?, logo=? WHERE uid=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssssi", $company_name, $company_detail, $company_address, $company_email, $company_contact, $company_owner, $logo_data, $uid);
        } else {
            // If no new logo file is uploaded, update other fields except for the logo
            $query = "UPDATE tbl_company SET company_name=?, company_detail=?, company_address=?, company_email=?, company_contact=?, company_owner=? WHERE uid=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssssi", $company_name, $company_detail, $company_address, $company_email, $company_contact, $company_owner, $uid);
        }

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Company updated successfully');</script>";
            header("Location: page-company.php");
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "Company ID not provided.";
    }
} elseif (isset($_GET['uid']) && !empty($_GET['uid'])) { // Check if uid is provided in the URL
    $uid = mysqli_real_escape_string($con, $_GET['uid']); // Retrieve uid from URL
    $query = "SELECT * FROM tbl_company WHERE uid = '$uid'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $company = mysqli_fetch_assoc($result);
    } else {
        echo "Company not found.";
        exit();
    }
} else {
    header("Location: page-edit-company.php");
    exit();
}

mysqli_close($con);
?>