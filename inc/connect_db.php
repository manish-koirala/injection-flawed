<?php
// Connect to the database.

if (defined("CONN_DB")) {
    // Define constants to connect to the database.
    define("HOST_ADDR", "localhost");


    define("DB_DBNAME", "sql-injection");
    define("DB_USERNAME", "root");
    define("DB_PASS", "");

    // Connect to the database.
    $conn = mysqli_connect(HOST_ADDR, DB_USERNAME, DB_PASS, DB_DBNAME);

    if ($conn->errno) {
        die("Internal Error");
    }

} else {
    die("Page Not Found.");
}