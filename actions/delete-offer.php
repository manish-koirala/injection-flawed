<?php
if (isset($_POST["id"])) {
    $offerID = $_POST["id"];

    // Delete the offerID.
    define("CONN_DB", true);
    require_once("../inc/connect_db.php");
    $db = $conn;

    $deleteQuery = "DELETE FROM offers WHERE offer_id=$offerID";
    $db->query($deleteQuery);

    header("Location: ../home/index.php");
}
