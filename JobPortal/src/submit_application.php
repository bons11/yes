<?php
include 'auth/php/config.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to check if a string is empty or contains only whitespace
function isEmptyOrWhitespace($str) {
    return !isset($str) || trim($str) === '';
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$portfolio = isset($_POST['portfolio']) ? $_POST['portfolio'] : ""; // Portfolio is optional
$cover_letter = $_POST['cover_letter'];
$job_number = $_POST['job_number'];
$company_name = $_POST['company_name']; // Make sure this is passed in the form data


// Check if any required field is empty
if (isEmptyOrWhitespace($name) || isEmptyOrWhitespace($email) || isEmptyOrWhitespace($_FILES["resume"]["name"]) || isEmptyOrWhitespace($cover_letter)) {
    $message = "Please fill in all required fields.";
    $status = "error";
} else {
    // File upload handling for resume
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["resume"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if PDF file
    if ($imageFileType != "pdf") {
        $message = "Sorry, only PDF files are allowed.";
        $status = "error";
    } else {
        // Check file size and move uploaded file
        if ($_FILES["resume"]["size"] > 500000) {
            $message = "Sorry, your file is too large.";
            $status = "error";
        } elseif (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
            // Prepare and execute SQL statement
            $date_apply = date("Y-m-d");
            $sql = "INSERT INTO tbl_applicant (job_number, date_apply, name, portfolio, email, resume, cover_letter) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            if ($stmt) { // Check if statement is prepared successfully
                mysqli_stmt_bind_param($stmt, "sssssss", $job_number, $date_apply, $name, $portfolio, $email, $target_file, $cover_letter);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Application submitted successfully.";
                    $status = "success";

                    // // Insert inquiry data into tbl_inquiry
                    // $sql_applicant = "INSERT INTO tbl_applicant (job_number, name, email, portfolio, cover_letter) 
                    //                 VALUES (?, ?, ?, ?, ?)";
                    // $stmt_applicant = mysqli_prepare($con, $sql_applicant);
                    // if ($stmt_applicant) { // Check if statement is prepared successfully
                    //     mysqli_stmt_bind_param($stmt_applicant, "sssss", $job_number, $name, $email, $portfolio, $cover_letter);
                    //     mysqli_stmt_execute($stmt_applicant);
                    // } else {
                    //     $message = "Error preparing inquiry SQL statement: " . mysqli_error($con); // Capture MySQL error
                    //     $status = "error";
                    // }

                    // Fetch receiver's email from tbl_company
                    $sql_company_email = "SELECT company_email FROM tbl_company WHERE company_name = ?";
                    $stmt_company_email = mysqli_prepare($con, $sql_company_email);
                    if ($stmt_company_email) { // Check if statement is prepared successfully
                        mysqli_stmt_bind_param($stmt_company_email, "s", $company_name);
                        mysqli_stmt_execute($stmt_company_email);
                        $result_company_email = mysqli_stmt_get_result($stmt_company_email);
                        $row_company_email = mysqli_fetch_assoc($result_company_email);
                        $receiver_email = $row_company_email['company_email'];

                        // Send email using PHPMailer
                        $mail = new PHPMailer(true);

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'arturoyparraguirre01@gmail.com'; // Replace with your Gmail username
                        $mail->Password = 'noyg pzxf spxg qfks'; // Replace with your Gmail password
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;

                        $mail->setFrom('arturoyparraguirre01@gmail.com'); // Replace with your email address

                        $mail->addAddress($receiver_email);

                        $mail->isHTML(true);

                        $mail->Subject = "New Job Application";
                        $mail->Body = "Name: $name <br>Email: $email <br>Portfolio: $portfolio <br>Cover Letter: $cover_letter";
                        $mail->AltBody = "Name: $name \nEmail: $email \nCover Letter: $cover_letter"; // Plain text version of the email

                        // Attach resume file
                        $mail->addAttachment($target_file);

                        $mail->send();

                        $message = "Application Successfully Submitted "; // Capture MySQL error
                        $status = "success";
                    } else {
                        $message = "Error preparing company email SQL statement: " . mysqli_error($con); // Capture MySQL error
                        $status = "error";
                    }

                    // Redirect with status, message, and job_number
                    header("Location: job-detail.php?status=$status&message=$message&job_number=$job_number");
                    exit();
                } else {
                    $message = "Error while saving application data: " . mysqli_error($con); // Capture MySQL error
                    $status = "error";
                }
            } else {
                $message = "Error preparing application SQL statement: " . mysqli_error($con); // Capture MySQL error
                $status = "error";
            }
        } else {
            $message = "Sorry, there was an error uploading your file.";
            $status = "error";
        }
    }
}

// Redirect back to job-detail.php with status and message
header("Location: job-detail.php?job_number=$job_number&status=$status&message=$message");
exit();
?>