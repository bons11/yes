<?php
    // Include database connection
    include 'auth/php/config.php';


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $contact_number = $_POST['contact_number'];
    $message = $_POST['message'];
    $role = $_POST['role'];

    // Prepare and bind the SQL statement
    $stmt = $con->prepare("INSERT INTO tbl_inquiry (name, email, subject, contact_number,message, role) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $subject, $contact_number, $message, $role);

    // Execute the statement
    if ($stmt->execute()) {
        echo "success";
    } else {
        http_response_code(500); // Internal Server Error
        echo "error";
    }

    // Close statement and connection
    $stmt->close();
    $con->close();
} else {
    http_response_code(400); // Bad Request
    echo "error";
}
?>
