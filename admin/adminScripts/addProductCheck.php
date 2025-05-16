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
$productID = '';
$product_name = trim($_POST['product_name']);
$product_category = trim($_POST['product_category']);
$product_price = trim($_POST['product_price']);
$product_manufacturer = trim($_POST['product_manufacturer']);
$product_description = trim($_POST['product_description']);
$product_quantity = trim($_POST['product_quantity']);
$target_file = trim($_POST['product_image']);

//if generated productID is taken, make a new one
do {
  $productID = random_int(100000, 999999);
  $query = $db->prepare("SELECT * FROM product WHERE productID = :productID");
  $query->bindParam(':productID', $productID);
  $query->execute();
  $result = $query->fetchAll();
} while ($result);

//checks if all required values are not empty
if (empty($product_name) || empty($product_category) || empty($product_price) || empty($product_manufacturer) || empty($product_description) || empty($product_quantity)) {
  //redirects to registration page if all values are not input
  $_SESSION['missing_input'] = true;
  header('Location: ../addProduct.php');
  //closes database connection
  $database = null;
  exit();
}

//prepares insert statement
$query = $db->prepare("INSERT INTO product VALUES (:productID, :product_name, :product_category, :product_price, :product_manufacturer, :product_description, :product_quantity, :target_file)");
$query->bindParam(':productID', $productID);
$query->bindParam(':product_name', $product_name);
$query->bindParam(':product_category', $product_category);
$query->bindParam(':product_price', $product_price);
$query->bindParam(':product_manufacturer', $product_manufacturer);
$query->bindParam(':product_description', $product_description);
$query->bindParam(':product_quantity', $product_quantity);
$query->bindParam(':target_file', $target_file);

if ($query->execute()) {
  //redirects to add product page if successful
  $_SESSION['addProduct_success'] = true;
  header("Location: ../addProduct.php");
} else {
  //redirects to add product page if failed
  $_SESSION['missing_input'] = true;
  header('Location: ../addProduct.php');
}

//closes database connection
$database = null;
exit();
