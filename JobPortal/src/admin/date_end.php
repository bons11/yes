<?php

include '../auth/php/config.php';

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get current date
$current_date = date("Y-m-d");

// SQL query to fetch job numbers of rows to be deleted from tbl_vacancy
$sql_select_job_numbers = "SELECT job_number FROM tbl_vacancy WHERE date_end <= '$current_date'";
$result_select_job_numbers = $con->query($sql_select_job_numbers);

if ($result_select_job_numbers->num_rows > 0) {
    // Loop through the result and delete corresponding rows from tbl_responsibility and tbl_qualification
    while ($row = $result_select_job_numbers->fetch_assoc()) {
        $job_number = $row['job_number'];
        
        // SQL query to delete rows from tbl_responsibility
        $sql_delete_responsibility = "DELETE FROM tbl_responsibility WHERE job_number = '$job_number'";
        $con->query($sql_delete_responsibility);
        
        // SQL query to delete rows from tbl_qualification
        $sql_delete_qualification = "DELETE FROM tbl_qualification WHERE job_number = '$job_number'";
        $con->query($sql_delete_qualification);
    }
}

// SQL query to delete rows from tbl_vacancy
$sql_delete_vacancy = "DELETE FROM tbl_vacancy WHERE date_end <= '$current_date'";
if ($con->query($sql_delete_vacancy) === TRUE)

// Close connection
$con->close();

?>
