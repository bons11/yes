<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $status = $_POST['statusSelect'];

    $sql = "UPDATE tbl_inquiry SET status = '$status' WHERE uid = $uid";

    if (mysqli_query($con, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>