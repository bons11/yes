<?php
session_start();
include '../auth/php/config.php';

// Define the upload directory
$upload_dir = '../uploads/';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file uploads
    $event_image_path = $upload_dir . basename($_FILES['event_image']['name']);

    // Move uploaded image to the upload directory
    if (move_uploaded_file($_FILES['event_image']['tmp_name'], $event_image_path)) {
        // Get form data
        $event_name = mysqli_real_escape_string($con, $_POST['event_name']);
        $event_details = mysqli_real_escape_string($con, $_POST['event_details']);
        $date_end = mysqli_real_escape_string($con, $_POST['date_end']);

        // Prepare SQL statement
        $sql = "INSERT INTO tbl_announcement (event_name, event_details, event_image, date_end) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);

        // Bind parameters and execute statement
        $stmt->bind_param("ssss", $event_name, $event_details, $event_image_path, $date_end);
        if ($stmt->execute()) {
            // Redirect to a success page or display a success message
            echo "<script>alert('Vacancy added successfully.');</script>";
        } else {
            // Handle the error
            echo "Error creating event: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Handle file upload error
        echo "Error uploading event image.";
    }

    $con->close();
}
?>
