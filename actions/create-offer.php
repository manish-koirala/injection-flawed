<?php
if (session_status() == PHP_SESSION_NONE) session_start();
// If the user is logged in, then only he is able to create a new offer, otherwise it isn't possible to create one.
if (isset($_SESSION["uid"])){
    // Check is the server method is POST and then only create the new offer.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {       
        // Require the database connection.
        define("CONN_DB", true);
        require_once("../inc/connect_db.php");
        $db = $conn;

        $continue_ = filter_has_var(INPUT_POST, "product-name") && filter_has_var(INPUT_POST, "product-price") && filter_has_var(INPUT_POST, "product-description") && filter_has_var(INPUT_POST, "category");
        if ($continue_) {
            // Create a new offer here.
            include("../actions/upload-image.php");
            $currentUID = $_SESSION["uid"];
            $product_name = $_POST['product-name'];
            $product_price = $_POST['product-price'];
            $product_image = $target_file;
            $product_description = $_POST['product-description'];
            $category_id = $_POST['category'];
            if ($uploadOk) {
                $createOfferQuery = "INSERT INTO offers (user_id, product_name, product_price, product_image, product_description, category_id) VALUES (\"$currentUID\", \"$product_name\", \"$product_price\", \"$product_image\", \"$product_description\", \"$category_id\")";
                $db->query($createOfferQuery);
                header("Location: ../home/index.php");
            }     
        }
    }
} else {
    // Lead to the login page.
    header("Location: ../login/login.php");
}