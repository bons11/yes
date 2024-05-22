<?php
include '../auth/php/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid']; // Retrieve user ID
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $query = "UPDATE tbl_user SET name='$name', address='$address', contact='$contact', birthday='$birthday', email='$email', role='$role' WHERE uid='$uid'";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('User updated successfully');</script>";
        header("Location: page-user-list.php");
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
    }
} elseif (isset($_GET['uid']) && !empty($_GET['uid'])) { // Check if uid is provided in the URL
    $uid = mysqli_real_escape_string($con, $_GET['uid']); // Retrieve uid from URL
    header("Location: delete-user.php?uid=$uid");
    exit();
} else {
    header("Location: page-user-list.php");
    exit();
}

mysqli_close($con);
?>