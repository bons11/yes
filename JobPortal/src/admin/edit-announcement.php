<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id']; // Retrieve user ID
    $event_name = $_POST['event_name'];
    $event_details = $_POST['event_details'];

    // File upload handling
    $file_name = $_FILES['event_image']['name'];
    $file_tmp = $_FILES['event_image']['tmp_name'];
    $file_destination = '../uploads/' . $file_name; // Define destination folder

    move_uploaded_file($file_tmp, $file_destination); // Move uploaded file to destination folder

    $query = "UPDATE tbl_announcement SET event_name='$event_name', event_details='$event_details', event_image='$file_destination' WHERE id='$id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('User updated successfully');</script>";
        header("Location: page-dashboard.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
} elseif (isset($_GET['id']) && !empty($_GET['id'])) { // Check if uid is provided in the URL
    $id = mysqli_real_escape_string($con, $_GET['id']); // Retrieve uid from URL

    exit();
} else {
    header("Location: page-dashboard.php");
    exit();
}

mysqli_close($con);
?>
