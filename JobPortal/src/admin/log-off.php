<?php
session_start();

// Function to log off the user by destroying the session
function logOff() {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page
    header("Location: index.php");
    exit();
}

// Call the log off function
logOff();
?>