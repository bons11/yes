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
    // Fetch valid_id from tbl_user
    $sql_valid_id = "SELECT valid_id FROM tbl_user WHERE email = ?";
    $stmt_valid_id = mysqli_prepare($con, $sql_valid_id);
    if ($stmt_valid_id) {
        mysqli_stmt_bind_param($stmt_valid_id, "s", $email);
        mysqli_stmt_execute($stmt_valid_id);
        $result_valid_id = mysqli_stmt_get_result($stmt_valid_id);
        if ($row_valid_id = mysqli_fetch_assoc($result_valid_id)) {
            $valid_id = $row_valid_id['valid_id'];
        } else {
            $message = "User not found.";
            $status = "error";
            header("Location: job-detail.php?job_number=$job_number&status=$status&message=$message");
            exit();
        }
    } else {
        $message = "Error preparing user SQL statement: " . mysqli_error($con);
        $status = "error";
        header("Location: job-detail.php?job_number=$job_number&status=$status&message=$message");
        exit();
    }

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
            $sql = "INSERT INTO tbl_applicant (job_number, date_apply, name, portfolio, email, resume, cover_letter, valid_id) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            if ($stmt) { // Check if statement is prepared successfully
                mysqli_stmt_bind_param($stmt, "ssssssss", $job_number, $date_apply, $name, $portfolio, $email, $target_file, $cover_letter, $valid_id);
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Application submitted successfully.";
                    $status = "success";

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
                        $mail->Username = 'bgllnmncplblltnbrd@gmail.com'; // Replace with your Gmail username
                        $mail->Password = 'feix hmve vsca rpyl'; // Replace with your Gmail password
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;

                        $mail->setFrom('bgllnmncplblltnbrd@gmail.com'); // Replace with your email address

                        $mail->addAddress($receiver_email);

                        $mail->isHTML(true);

                        $mail->Subject = "New Job Application";
                        $mail->Body = "Name: $name <br>Email: $email <br>Portfolio: $portfolio <br>Cover Letter: $cover_letter <br>Valid ID: $valid_id";
                        $mail->AltBody = "Name: $name \nEmail: $email \nPortfolio: $portfolio \nCover Letter: $cover_letter \nValid ID: $valid_id"; // Plain text version of the email

                        // Attach resume file
                        $mail->addAttachment($target_file);

                        // Attach valid_id image
                        $valid_id_file = "path/to/valid_id/images/" . $valid_id; // Update this path accordingly
                        if (file_exists($valid_id_file)) {
                            $mail->addAttachment($valid_id_file);
                        }

                        $mail->send();

                        $message = "Application Successfully Submitted";
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
