<?php
//includes database connection
require_once '../../db_connect.php';

//includes session info
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ../adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../../homepage.php');
}

$productID = strtolower(trim($_POST['productID']));
$product_name = trim($_POST['product_name']);
$product_category = trim($_POST['product_category']);
$product_price = trim($_POST['product_price']);
$product_manufacturer = trim($_POST['product_manufacturer']);
$product_description = trim($_POST['product_description']);
$product_quantity = trim($_POST['product_quantity']);
$admin_password = trim($_POST['admin_password']);
$adminID = $_SESSION['account'];

$query = $db->prepare("SELECT image FROM product WHERE productID = :productID");
$query->bindParam(':productID', $productID);

//gets any elements from database that has matching email
$query->execute();
$productInfo = $query->fetch();

if (!$productInfo) {
  $_SESSION['missing_input'] = true;
  header('Location: ../modifyProduct.php');

  //closes database connection
  $database = null;
  exit();
}

$image_dir = "assets/";
$target_file = $image_dir . basename($_FILES["product_image"]['name']);
$image = $_FILES['product_image'];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE employeeID = :adminID");
$query->bindParam(':adminID', $adminID);

//gets any elements from database that has matching email
$query->execute();
$result = $query->fetch();


if (password_verify($admin_password, $result['password'])) {
  if (is_uploaded_file($_FILES['product_image']['tmp_name'])) {
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check !== false) {
      // Check if file already exists
      if (file_exists($target_file)) {
        $_SESSION['image_name_exists'] = true;
        $uploadOk = 0;
      }

      // Check file size
      if ($_FILES["product_image"]["size"] > 500000) {
        $_SESSION['file_too_large'] = true;
        $uploadOk = 0;
      }

      // Allow certain file formats
      if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
      ) {
        $_SESSION['invalid_file_type'] = true;
        $uploadOk = 0;
      }

      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
        $_SESSION['unknown_err'] = true;
        // if everything is ok, try to upload file
      } else {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], "../../" . $target_file)) {
          $_SESSION['image_uploaded'] = true;
        } else {
          $_SESSION['error_uploading_image'] = true;
        }
      }

      $query = $db->prepare("UPDATE product SET image = :target_file WHERE productID = :productID");
      $query->bindParam(':target_file', $target_file);
      $query->bindParam(':productID', $productID);
      if ($query->execute()) {
        unlink("../../" . $productInfo['image']);
      }
    }
  }
}

if ($product_name) {
  $query = $db->prepare("UPDATE product SET name = :product_name WHERE productID = :productID");
  $query->bindParam(':product_name', $product_name);
  $query->bindParam(':productID', $productID);
  $query->execute();
}

if ($product_category) {
  $query = $db->prepare("UPDATE product SET category = :product_category WHERE productID = :productID");
  $query->bindParam(':product_category', $product_category);
  $query->bindParam(':productID', $productID);
  $query->execute();
}

if ($product_price) {
  $query = $db->prepare("UPDATE product SET price = :product_price WHERE productID = :productID");
  $query->bindParam(':product_price', $product_price);
  $query->bindParam(':productID', $productID);
  $query->execute();
}

if ($product_manufacturer) {
  $query = $db->prepare("UPDATE product SET manufacturer = :product_manufacturer WHERE productID = :productID");
  $query->bindParam(':product_manufacturer', $product_manufacturer);
  $query->bindParam(':productID', $productID);
  $query->execute();
}

if ($product_description) {
  $query = $db->prepare("UPDATE product SET description = :product_description WHERE productID = :productID");
  $query->bindParam(':product_description', $product_description);
  $query->bindParam(':productID', $productID);
  $query->execute();
}

if ($product_quantity) {
  $query = $db->prepare("UPDATE product SET quantity = :product_quantity WHERE productID = :productID");
  $query->bindParam(':product_quantity', $product_quantity);
  $query->bindParam(':productID', $productID);
  $query->execute();
} else {
  $_SESSION['wrong_pass'] = true;
  header('Location: ../modifyProduct.php');

  //closes database connection
  $database = null;
  exit();
}


$_SESSION['modifyProduct_success'] = true;
header("Location: ../modifyProduct.php");


//closes database connection
$database = null;
exit();
