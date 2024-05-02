<?php
$target_dir = "../resources/images/uploads/";
$target_file = $target_dir . time() . "_" . basename($_FILES["product-image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error_msg = ""; // Variable to store the error message.

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["product-image"]["tmp_name"]);
  if($check !== false) {
    $error_msg = "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $error_msg = "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk) {
  if (!move_uploaded_file($_FILES["product-image"]["tmp_name"], $target_file)) {
    $error_msg = "Sorry, there was an error uploading your file.";
  }
}
?>