<?php include("../login/login_submit.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Manish Koirala">
    <title>Login Portal</title>
    <link rel="stylesheet" href="../resources/css/base.css?<?php time() ?>">
    <link rel="stylesheet" href="../resources/css/login.css?<?php time() ?>">
</head>
<body>
    <!-- Include the header. -->
    <?php include("../inc/header.php") ?>

    <!-- Include the main part. -->
    <?php include("../login/login_form.php") ?>

    <!-- Include the footer. -->
    <?php include("../inc/footer.php") ?>
</body>
</html>