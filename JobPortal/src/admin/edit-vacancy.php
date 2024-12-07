<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve job number from the form
    $job_number = $_POST['job_number'];

    // Retrieve other form fields
    $company_category = mysqli_real_escape_string($con, $_POST['company_category']);
    $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
    $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
    $job_description = mysqli_real_escape_string($con, $_POST['job_description']);
    $job_salary = mysqli_real_escape_string($con, $_POST['job_salary']);
    $job_nature = mysqli_real_escape_string($con, $_POST['job_nature']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $town = mysqli_real_escape_string($con, $_POST['town']);
    $date_created = mysqli_real_escape_string($con, $_POST['date_created']);
    $date_end = mysqli_real_escape_string($con, $_POST['date_end']);
    $responsibility_detail = mysqli_real_escape_string($con, $_POST['responsibility_detail']);
    $responsibility_sub1 = mysqli_real_escape_string($con, $_POST['responsibility_sub1']);
    $responsibility_sub2 = mysqli_real_escape_string($con, $_POST['responsibility_sub2']);
    $responsibility_sub3 = mysqli_real_escape_string($con, $_POST['responsibility_sub3']);
    $responsibility_sub4 = mysqli_real_escape_string($con, $_POST['responsibility_sub4']);
    $responsibility_sub5 = mysqli_real_escape_string($con, $_POST['responsibility_sub5']);
    $qualification_detail = mysqli_real_escape_string($con, $_POST['qualification_detail']);
    $qualification_sub1 = mysqli_real_escape_string($con, $_POST['qualification_sub1']);
    $qualification_sub2 = mysqli_real_escape_string($con, $_POST['qualification_sub2']);
    $qualification_sub3 = mysqli_real_escape_string($con, $_POST['qualification_sub3']);
    $qualification_sub4 = mysqli_real_escape_string($con, $_POST['qualification_sub4']);
    $qualification_sub5 = mysqli_real_escape_string($con, $_POST['qualification_sub5']);

    // Update tbl_vacancy
    $query_vacancy = "UPDATE tbl_vacancy SET company_category='$company_category', company_name='$company_name', job_title='$job_title', job_description='$job_description', job_salary='$job_salary', job_nature='$job_nature', location='$location', town ='$town', date_created='$date_created', date_end='$date_end' WHERE job_number='$job_number'";
    $result_vacancy = mysqli_query($con, $query_vacancy);

    // Update tbl_responsibility
    $query_responsibility = "UPDATE tbl_responsibility SET responsibility_detail='$responsibility_detail', responsibility_sub1='$responsibility_sub1', responsibility_sub2='$responsibility_sub2', responsibility_sub3='$responsibility_sub3', responsibility_sub4='$responsibility_sub4', responsibility_sub5='$responsibility_sub5' WHERE job_number='$job_number'";
    $result_responsibility = mysqli_query($con, $query_responsibility);

    // Update tbl_qualification
    $query_qualification = "UPDATE tbl_qualification SET qualification_detail='$qualification_detail', qualification_sub1='$qualification_sub1', qualification_sub2='$qualification_sub2', qualification_sub3='$qualification_sub3', qualification_sub4='$qualification_sub4', qualification_sub5='$qualification_sub5' WHERE job_number='$job_number'";
    $result_qualification = mysqli_query($con, $query_qualification);

    // Check if all updates were successful
    if ($result_vacancy && $result_responsibility && $result_qualification) {
        echo "<script>alert('Vacancy updated successfully');</script>";
        header("Location: page-vacancy.php");
        exit();
    } else {
        echo "<script>alert('Error updating vacancy: " . mysqli_error($con) . "');</script>";
        header("Location: page-edit-vacancy.php?uid=$job_number"); // Redirect back to edit page with error message
        exit();
    }
} else {
    header("Location: page-vacancy.php");
    exit();
}

mysqli_close($con);
?>