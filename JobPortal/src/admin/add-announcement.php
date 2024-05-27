<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_details = $_POST['event_details'];
    $date_end = $_POST['date_end'];

    // Check if event image is uploaded
    if (!empty($_FILES['event_image']['name'])) {
        $event_image = $_FILES['event_image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["event_image"]["name"]);

        // Move uploaded image to target directory
        if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $target_file)) {
            // Prepare SQL statement
            $sql = "INSERT INTO tbl_event (event_name, event_details, event_image, date_end) VALUES (?, ?, ?, ?)";
            $stmt = $con->prepare($sql);

            // Bind parameters and execute statement
            $stmt->bind_param("ssss", $event_name, $event_details, $event_image, $date_end);
            if ($stmt->execute()) {
                echo "Event created successfully";
            } else {
                echo "Error creating event: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Please upload an event image.";
    }

    $con->close();
}
?>
