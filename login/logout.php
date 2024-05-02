<?php
// Log the user out of the system.
if (session_status() == PHP_SESSION_NONE) session_start();
// UNSET SPECIFIC SESSION VARIABLES.
unset($_SESSION['email']);
unset($_SESSION['credit-card']);
unset($_SESSION['phone']);
unset($_SESSION['username']);
unset($_SESSION['uid']);

header("Location: ../home/index.php");