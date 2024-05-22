<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if category ID is provided via POST method
    if(isset($_POST['uid']) && !empty($_POST['uid'])) {
        $uid = $_POST['uid']; // Retrieve category ID
        $date = $_POST['date'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Check if a new logo file is uploaded
        if ($_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $logo_tmp_name = $_FILES['logo']['tmp_name'];
            $logo_data = file_get_contents($logo_tmp_name);
            $query = "UPDATE tbl_category SET date=?, category=?, description=?, logo=?, status=? WHERE uid=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "sssssi", $date, $category, $description, $logo_data, $status, $uid);
        } else {
            // If no new logo file is uploaded, update other fields except for the logo
            $query = "UPDATE tbl_category SET date=?, category=?, description=?, status=? WHERE uid=?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ssssi", $date, $category, $description, $status, $uid);
        }

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "<script>alert('Category updated successfully');</script>";
            header("Location: page-category.php");
            exit();
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
    } else {
        echo "Category ID not provided.";
    }
} elseif (isset($_GET['uid']) && !empty($_GET['uid'])) { // Check if uid is provided in the URL
    $uid = mysqli_real_escape_string($con, $_GET['uid']); // Retrieve uid from URL
    $query = "SELECT * FROM tbl_category WHERE uid = '$uid'";
    $result = mysqli_query($con, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $category = mysqli_fetch_assoc($result);
    } else {
        echo "Category not found.";
        exit();
    }
} else {
    header("Location: page-edit-category.php");
    exit();
}

mysqli_close($con);
?>
