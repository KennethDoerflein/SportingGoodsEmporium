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

//get data from form
$productID = strtolower(trim($_POST['productID']));
$product_name = trim($_POST['product_name']);
$product_category = trim($_POST['product_category']);
$product_price = trim($_POST['product_price']);
$product_manufacturer = trim($_POST['product_manufacturer']);
$product_description = trim($_POST['product_description']);
$product_quantity = trim($_POST['product_quantity']);
$admin_password = trim($_POST['admin_password']);
$adminID = $_SESSION['account'];
$errFree = true;

//check if product exists
$query = $db->prepare("SELECT * FROM product WHERE productID = :productID");
$query->bindParam(':productID', $productID);

//gets any elements from database that has matching email
$query->execute();
$productInfo = $query->fetch();

if (!$productID || !$productInfo) {
  $_SESSION['missing_input'] = true;
  header('Location: ../modifyProduct.php');

  //closes database connection
  $database = null;
  exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE employeeID = :adminID");
$query->bindParam(':adminID', $adminID);

//gets any elements from database that has matching id
$query->execute();
$result = $query->fetch();

//check if admin password is correct
if (password_verify($admin_password, $result['password'])) {
  //update product name if provided
  if ($product_name) {
    $query = $db->prepare("UPDATE product SET name = :product_name WHERE productID = :productID");
    $query->bindParam(':product_name', $product_name);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
  //update product category if provided
  if ($product_category) {
    $query = $db->prepare("UPDATE product SET category = :product_category WHERE productID = :productID");
    $query->bindParam(':product_category', $product_category);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
  //update price if provided
  if ($product_price) {
    $query = $db->prepare("UPDATE product SET price = :product_price WHERE productID = :productID");
    $query->bindParam(':product_price', $product_price);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
  //update manufacturer if provided
  if ($product_manufacturer) {
    $query = $db->prepare("UPDATE product SET manufacturer = :product_manufacturer WHERE productID = :productID");
    $query->bindParam(':product_manufacturer', $product_manufacturer);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
  //update description if provided
  if ($product_description) {
    $query = $db->prepare("UPDATE product SET description = :product_description WHERE productID = :productID");
    $query->bindParam(':product_description', $product_description);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
  //update quantity if provided
  if ($product_quantity) {
    $query = $db->prepare("UPDATE product SET quantity = :product_quantity WHERE productID = :productID");
    $query->bindParam(':product_quantity', $product_quantity);
    $query->bindParam(':productID', $productID);
    if (!$query->execute()) {
      $errFree = false;
    }
  }
} else {
  $_SESSION['invalidPass'] = true;
  header('Location: ../modifyProduct.php');
  //closes database connection
  $database = null;
  exit();
}

if ($errFree) {
  //redirects to modify product page if successful
  $_SESSION['modifyProduct_success'] = true;
  header('Location: ../modifyProduct.php');
} else {
  //redirects to modify product page if failed
  $_SESSION['missing_input'] = true;
  header('Location: ../modifyProduct.php');
}

//closes database connection
$database = null;
exit();
