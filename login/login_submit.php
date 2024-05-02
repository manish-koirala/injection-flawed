<?php
// Requires database connection.
define("CONN_DB", true);
require_once("../inc/connect_db.php");
$db = $conn;

// Variable to store the error message.
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect the values from the login form submission and log the user into the system.
    $continue_ = filter_has_var(INPUT_POST, "submit") && filter_has_var(INPUT_POST, "username") && filter_has_var(INPUT_POST, "password");
    if ($continue_) {
        $username = $_POST["username"];
        $password = md5($_POST["password"]);

        # First verify that the username exists in the system.
        $usernameQuery = "SELECT username FROM users WHERE username='$username'";
        $result = $db->query($usernameQuery);
        if ($result->num_rows > 0) {
            // Continue and verify the password.
            $passwordQuery = "SELECT id, email, creditcard_number, phone_number, username FROM users WHERE username='$username' AND password='$password'";
            $result = $db->query($passwordQuery);
            if ($result->num_rows > 0) {
                # This means that both the email and password are registerd. Hence, we login.
                $data = $result->fetch_object();
                # Save some session variables, to login.
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['email'] = $data->email;
                $_SESSION['credit-card'] = $data->creditcard_number;
                $_SESSION['phone'] = $data->phone_number ;
                $_SESSION['username'] = $data->username;
                $_SESSION['uid'] = $data->id;
                # Redirect to the home page.
                header("Location: ../home/index.php");
            } else {
                $error_msg = "The provided password is invalid.";
            }
        } else {
            $error_msg = "The provided username is invalid.";
        }
    }
}