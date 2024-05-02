<?php
# Require the database connection.
define("CONN_DB", true);
require_once("../inc/connect_db.php");
$db = $conn;

// See if the id is available in the database.
$offer_id = $_GET["id"];
$idQuery = "SELECT user_id, product_name, product_description, product_price, product_image, fname, lname, phone_number, email FROM offers JOIN users ON offers.user_id = users.id WHERE offer_id=$offer_id";
$idResult = $db->query($idQuery);
?>



<?php if ($idResult->num_rows > 0): ?>
    <!-- Get the data -->
    <?php $data = $idResult->fetch_object(); ?>
    <!-- If the provided id is available, then fetch the product offer and show it in detail. -->
    <div class="offer-detailed-box">
        <div class="offer-detailed-left">
            <img src="<?php echo $data->product_image; ?>" alt="product-image">
        </div>
        <div class="offer-detailed-right">
            <h1><?php echo $data->product_name; ?></h1>
            <h2>Price: $<?php echo $data->product_price; ?></h2>
            <div class="offer-detailed-user-info">
                <p><b>Offered By:</b> <?php echo $data->fname. " " . $data->lname; ?> <br><b>Contact:</b> <?php echo $data->phone_number; ?><br><b>Mail:</b> <?php echo $data->email; ?></p>
            </div>
            <div class="offer-detailed-desc">
                <p><?php echo $data->product_description; ?></p>
            </div>
            <div class="offer-detailed-order-btn">
                <?php if (isset($_SESSION['uid']) && $data->user_id != $_SESSION['uid']):?>
                <form action="../actions/order.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $offer_id ?>">
                    <input type="submit" name="submit" value="Order Now">
                </form>
                <?php elseif ($data->user_id == $_SESSION["uid"]): ?>
                <form action="../actions/delete-offer.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $offer_id ?>">
                    <input type="submit" name="submit" value="Delete Offer">
                </form>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
    
<?php else: ?>
    <!-- Otherwise, redirect to the list view page. -->
    <?php header("Location: ../home/index.php"); ?>
<?php endif; ?>