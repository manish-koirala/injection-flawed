<?php
// Require database connection
define("CONN_DB", true);
require_once("../inc/connect_db.php");
$db = $conn;

// Current User ID
if (isset($_SESSION["uid"])) {
    $currentUID = $_SESSION["uid"];
} else {
    $currentUID = 0;
}

// Get offers from the database.
$offerQuery = "SELECT offer_id, product_name, product_price, product_image, product_description, is_available FROM offers";

// Get the user history from the database.
$purchasesQuery = "SELECT product_name, product_price, purchase_date FROM transaction_list JOIN offers ON transaction_list.offer_id = offers.offer_id WHERE buyer_id=$currentUID ORDER BY offers.offer_id DESC";
$salesQuery = "SELECT product_name, product_price, purchase_date FROM transaction_list JOIN offers ON transaction_list.offer_id = offers.offer_id WHERE seller_id=$currentUID ORDER BY offers.offer_id DESC";
$categoriesQuery = "SELECT category_name FROM categories";
$categoriesResult = $db->query($categoriesQuery);

$welcomeMessage = "";

// See if the user has a tracking id.
if (isset($_COOKIE["tracking-id"])) {
    // Check the database if the tracking-id is correct.
    $tracking_id = $_COOKIE["tracking-id"];
    $checkTrackingID = "SELECT * FROM tracking WHERE tracking_id=\"$tracking_id\"";
    if ($db->query($checkTrackingID)->num_rows) {
        $welcomeMessage = "Welcome Back!";
    }
} else {
    // Generate a new tracking id cookie in the database and set the cookie for the user.
    $tracking_id = substr(base64_encode(sha1(mt_rand())), 0, 10);
    $insertTrackingId = "INSERT INTO tracking (tracking_id) VALUES (\"$tracking_id\")";
    $db->query($insertTrackingId);

    // Set the cookie for tracking id.
    setcookie("tracking-id", $tracking_id, time()+86400);
}
?>
<?php if($welcomeMessage != ""): ?>
    <div class="welcome-message">
        <p><?php echo $welcomeMessage ?></p>
    </div>
<?php endif; ?>

<div class="categories-nav">
<?php while($catdata = $categoriesResult->fetch_object()) :?>
    <a href="../categories/categories.php?category=<?php echo $catdata->category_name?>"><?php echo $catdata->category_name?></a>
<?php endwhile; ?>
</div>

<!-- Offers -->
<div class="main-body">
    <div class="offers">
        <?php if (isset($_SESSION["uid"])): ?>
            <?php $offerResult = $db->query($offerQuery); ?>
            <?php if($offerResult->num_rows > 0): ?>
                <?php while($data = $offerResult->fetch_object()): ?>
                    <!-- OFFER CONTAINER -->
                    <div class="offer">
                        <h3 class="offer-name"><?php echo strtoupper($data->product_name) ?></h3>
                        <div class="offer-img">
                            <img src="<?php echo $data->product_image ?>" alt="product-image">
                        </div>
                        <p class="offer-price"><b>Price:</b> $<?php echo $data->product_price ?></p>
                        <?php if($data->is_available): ?>
                        <div class="buy-btn">
                            <a href="../home/index.php?id=<?php echo $data->offer_id ?>">Check Out</a>
                        </div>
                        <?php else: ?>
                        <div class="sold-out">
                            <p>SOLD OUT</p>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                    <p>There are no offers available at the moment.</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                <p> You must be logged in to view all the available offers. </p>
            </div>
        <?php endif; ?>
    </div>

<!-- Sidebar -->
    <div class="sidebar">
        <?php if(isset($_SESSION["uid"])): ?>
            <div class="create-offer">
                <a href="../home/create-view.php" style="font-size: 1.5rem;">Sell an item</a>
            </div>
        <?php endif; ?>
        <div>
            <?php if (isset($_SESSION["uid"])): ?>
                <?php 
                    $purchasesResult = $db->query($purchasesQuery);
                    $salesResult = $db->query($salesQuery); 
                ?>
                <h1>Your History</h1>
                <section class="bought-list">
                    <h2>Bought:</h2>
                    <ul>
                        <?php if ($purchasesResult->num_rows > 0): ?>
                            <?php while ($purchaseData = $purchasesResult->fetch_object()):?>
                                <li><?php echo $purchaseData->product_name . "  |  " . $purchaseData->product_price . "  |  " . $purchaseData->purchase_date?><hr></li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>You haven't purchased anything yet.</p>
                        <?php endif; ?>
                    </ul>

                </section>
                <section class="sold-list">
                    <h2>Sold:</h2>
                    <ul>
                        <?php if ($salesResult->num_rows > 0): ?>
                            <?php while ($salesData = $salesResult->fetch_object()):?>
                                <li><?php echo $salesData->product_name . "  |  " . $salesData->product_price . "  |  " . $salesData->purchase_date?><hr></li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>You haven't sold anything yet.</p>
                        <?php endif; ?>
                    </ul>
                </section>
            <?php else: ?>
                <p>To view your history, and sell products, first please create an account. You can create an account in the <a href="../register/register.php">register</a> page.<br><br> If you already have an account, Login In <a href="../login/login.php">here</a>.</p>
            <?php endif; ?>
        </div>
    </div>
</div>