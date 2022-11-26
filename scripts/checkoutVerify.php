<?php
//includes database connection
require_once '../db_connect.php';

//includes session info
session_start();


date_default_timezone_set("America/New_York");
$date = date("Y/m/d H:i:s");

//takes input and assigns them to variables
$firstNameBilling = trim($_POST['firstNameBilling']);
$lastNameBilling = trim($_POST['lastNameBilling']);
$addressBilling = trim($_POST['addressBilling']) . ' ' . trim($_POST['cityBilling']) . ' ' .  trim($_POST['stateBilling']) . ' ' . ($_POST['zipBilling']);
$firstNameShipping = trim($_POST['firstNameShipping']);
$lastNameShipping = trim($_POST['lastNameShipping']);
$addressShipping = trim($_POST['addressShipping']) . ' ' . trim($_POST['cityShipping']) . ' ' .  trim($_POST['stateShipping']) . ' ' . ($_POST['zipShipping']);
$ccName = trim($_POST['cc-name']);
$ccExpiration = trim($_POST['cc-expiration']);
$ccCvv = trim($_POST['cc-cvv']);


//checks if all required values are not empty
if (empty($firstNameBilling) || empty($lastNameBilling) || empty($addressBilling) || empty($firstNameShipping) || empty($lastNameShipping) || empty($addressShipping) || empty($ccName) || empty($ccExpiration) || empty($ccCvv)) {

  //redirects to registration page if all values are not input
  $_SESSION['checkout_error'] = true;
  header('Location: ../cart.php');

  //closes database connection
  $database = null;
  exit();
}

//if generated orderID is taken, make a new one
do {
  $orderID = mt_rand(500001, 900000);
  $query = $db->prepare("SELECT * FROM orders WHERE orderNumber = :orderID");
  $query->bindParam(':orderID', $orderID);
  $query->execute();
  $result = $query->fetchAll();
} while ($result);

//if generated ID is taken, make a new one
do {
  $id = mt_rand(100000, 500000);
  $query = $db->prepare("SELECT * FROM orders WHERE id = :id");
  $query->bindParam(':id', $id);
  $query->execute();
  $result = $query->fetchAll();
} while ($result);

$query = $db->prepare("SELECT CART.productID, PRODUCT.price, CART.quantity, PRODUCT.quantity as inStock FROM CART INNER JOIN PRODUCT ON PRODUCT.productID = CART.productID WHERE CART.accountNumber = :accountNumber ORDER BY dateAdded DESC");
$query->bindValue(':accountNumber', $_SESSION['account']);

$query->execute();
$products = $query->fetchAll();
$query->closeCursor();

foreach ($products as $product) :
  //prepares insert statement
  $query = $db->prepare("INSERT INTO orders VALUES (:id, :accountNumber, :orderID, :productID, :price, :quantity, :date, :addressShipping, :addressBilling)");
  $query->bindParam(':id', $id);
  $query->bindParam(':accountNumber', $_SESSION['account']);
  $query->bindParam(':orderID', $orderID);
  $query->bindParam(':productID', $product['productID']);
  $query->bindParam(':price', $product['price']);
  $query->bindParam(':quantity', $product['quantity']);
  $query->bindParam(':date', $date);
  $query->bindParam(':addressBilling', $addressBilling);
  $query->bindParam(':addressShipping', $addressShipping);
  $query->execute();
  do {
    $id = mt_rand(100000, 500000);
    $query = $db->prepare("SELECT * FROM orders WHERE id = :id");
    $query->bindParam(':id', $id);
    $query->execute();
    $result = $query->fetchAll();
  } while ($result);
  $query = $db->prepare("UPDATE product set quantity = quantity-:quantity where productID = :productID");
  $query->bindParam(':productID', $product['productID']);
  $query->bindParam(':quantity', $product['quantity']);
  $query->execute();
endforeach;

$query = $db->prepare("DELETE FROM cart WHERE accountNumber = :accountNumber");
$query->bindParam(':accountNumber', $_SESSION['account']);

//checks if insert was successful
if ($query->execute()) {
  //redirects to homepage if successful
  $_SESSION['checkout_success'] = true;
  header("Location: ../cart.php");
} else {
  //redirects to registration page if failed
  $_SESSION['checkout_err'] = true;
  header('Location: ../cart.php');
}

//closes database connection
$database = null;
exit();
