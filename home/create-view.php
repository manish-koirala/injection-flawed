<?php include("../actions/create-offer.php"); ?> <!-- It will auto redirect users who are not logged in, to the login page.. -->
<?php define("CONN_DB", true) ?>
<?php require_once("../inc/connect_db.php"); ?>
<?php
    $db = $conn;
    $categories_query = "SELECT * FROM categories;";
    $categories_result = $db->query($categories_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Manish Koirala">
    <title>Create a new offer.</title>
    <link rel="stylesheet" href="../resources/css/base.css">
    <link rel="stylesheet" href="../resources/css/create-view.css">
</head>
<body>
    <!-- Include the header. -->
    <?php include("../inc/header.php") ?>

    <!-- The main form. -->
    <main>
        <form action="../home/create-view.php" method="POST" enctype="multipart/form-data">
            <p style="font-size: 1.5rem; color: red; text-align:center;"><?php if (isset($error_msg)) echo $error_msg; ?></p>
            <h1 style="text-align: center; margin-bottom: 1rem;">Create a new sale: </h1>
            <label for="product-name">Product Name: </label>
            <input type="text" name="product-name" id="product-name">
            <label for="product-image">Upload an image of your product: </label>
            <input type="file" name="product-image" id="product-image">
            <label for="product-price">Product Price (USD): </label>
            <input type="text" name="product-price" id="product-price">
            <label for="product-description">Product Description: </label>
            <textarea name="product-description" id="product-description" cols="30" rows="10"></textarea>
            <label for="category">Choose a category:</label>
            <select name="category" id="category">
            <?php while($data = $categories_result->fetch_object()): ?>
                <option value="<?php echo $data->id ?>"><?php echo $data->category_name ?></option>
            <?php endwhile; ?>
            <input type="submit" value="Create offer" name="submit">
            </select>
        </form>
    </main>

    <!-- Include the footer. -->
    <?php include("../inc/footer.php") ?>
</body>
</html>