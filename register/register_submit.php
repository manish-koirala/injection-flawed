<?php
// Connect to the database, and remap the connection to $db.
define("CONN_DB", true);
require("../inc/connect_db.php");
$db = $conn;

// Variable to store the error message.
$error_msg = "";

// Handle registration submission and create new users.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $continue_registration = filter_has_var(INPUT_POST, "submit") && 
        filter_has_var(INPUT_POST, "fname") && 
        filter_has_var(INPUT_POST, "lname") && 
        filter_has_var(INPUT_POST, "email") && 
        filter_has_var(INPUT_POST, "password") && 
        filter_has_var(INPUT_POST, "creditcard") && 
        filter_has_var(INPUT_POST, "phone") &&
        filter_has_var(INPUT_POST, "username");


    // Continue registration
    if ($continue_registration) {
        // Extract all the information
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $phone = $_POST["phone"];
        $creditcard = $_POST["creditcard"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $username = $_POST["username"];

        $usernameQuery = "SELECT username FROM users WHERE email='$email' OR username='$username' LIMIT 1";
        $usernameResults = $db->query($usernameQuery);
        if ($usernameResults->num_rows >= 1) {
            $error_msg = "Account already exists with that username or email.";
        } else {
            // Create a new account with that information.
            $is_admin = false;
            $insert_query = "INSERT INTO users (fname, lname, username, email, password, phone_number, creditcard_number) VALUES ('$fname', '$lname', '$username', '$email', '$password', '$phone', '$creditcard')";
            $insert_query_result = $db->query($insert_query);
            if ($insert_query_result) { // If the insertion was successful.              
                # Save some session variables, to login.
                if (session_status() == PHP_SESSION_NONE) session_start();
                $_SESSION['email'] = $email;
                $_SESSION['credit-card'] = $creditcard;
                $_SESSION['phone'] = $phone ;
                $_SESSION['username'] = $username;

                
                $getUID = "SELECT id FROM users WHERE email=\"$email\"";
                $uid = $db->query($getUID)->fetch_object()->id;
                $_SESSION['uid'] = $uid;
                # Redirect to the home page.
                header("Location: ../home/index.php");
            }
        }       
    }
}