<?php
define("CONN_DB", true);
require_once("../inc/connect_db.php");
$db = $conn;

$category = $_GET["category"];
$offersQuery = "SELECT offer_id, product_name, product_price, product_image, product_description, is_available FROM offers JOIN categories ON offers.category_id = categories.id WHERE category_name=\"$category\"";

$offersResult = $db->query($offersQuery);

if (session_status() == PHP_SESSION_NONE) session_start();
?>

<main>
    <?php if (isset($_SESSION["uid"])): ?>
        <div class="offers">
            <?php if ($offersResult->num_rows > 0) :?>
                <!-- There are products in the category -->
                <?php while($data = $offersResult->fetch_object()):?>
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
                <?php endwhile;?>
            <?php else: ?> 
                <!-- No products in the category -->
                <p>Sorry, there are no product offers in this category yet.</p>
            <?php endif; ?>     
        </div>
    <?php else: ?>
        <p>You must be logged in to view products in different categories.</p>
    <?php endif; ?>
</main>