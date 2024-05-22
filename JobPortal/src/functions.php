<?php
function getUserFullName($userId, $con) {
    $query = "SELECT name FROM tbl_user WHERE uid = '$userId'";
    $result = mysqli_query($con, $query);
    $userData = mysqli_fetch_assoc($result);
    return $userData['name'];
}
?>