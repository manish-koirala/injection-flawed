<?php
define("CONN_DB", true);
require_once("../inc/connect_db.php");
$db = $conn;
if (session_status() == PHP_SESSION_NONE) session_start();

// If the user is logged in, then make the transaction.
if (isset($_SESSION["uid"]) && isset($_POST["id"])) {
    # First make sure that the same user cannot buy and sell his own item.
    $id = $_POST["id"];
    $offerQuery = "SELECT user_id FROM offers JOIN users on offers.user_id = users.id WHERE offers.offer_id=$id";
    $offerResult = $db->query($offerQuery);

    $data = $offerResult->fetch_object();
    $buyerID = $_SESSION["uid"];
    $sellerID = $data->user_id;
    if ($sellerID != $buyerID) {
        // Add to the buy list of the current user.
        $transactionInsert = "INSERT into transaction_list (offer_id, buyer_id, seller_id) VALUES ($id, $buyerID, $sellerID)";

        // Remove the offer from the market. (Set is_available of offer to false. )
        $updateOffer = "UPDATE offers SET is_available=0 WHERE offer_id=$id";

        // Run the insert and update queries.
        $db->query($transactionInsert);
        $db->query($updateOffer);

        // Go to the home page.
        header("Location: ../home/index.php"); 
    } else {
        die("HELP");
    }
}