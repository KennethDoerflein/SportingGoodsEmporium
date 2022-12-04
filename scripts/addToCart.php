<?php
// connect to the db
require_once '../db_connect.php';

// start session
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./index.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if admin, redirects user to admin homepage
  header('Location: ./admin/adminHomepage.php');
}

//get input and make cartID
$cartID = mt_rand(30000000, 40000000);
$productID = trim($_POST['productID']);
$quantity = trim($_POST['product_quantity']);
$accountNumber = $_SESSION['account'];
date_default_timezone_set("America/New_York");
$date = date("Y/m/d H:i:s");

//check if we received needed data
if (!$productID || !$quantity) {
  $_SESSION['addCart'] = 'MissingInput';
  header('Location: javascript:history.back()');
  //closes db connection
  $db = null;
  exit();
}

//if generated cartID is taken, make a new one
do {
  $cartID = random_int(100000, 999999);
  $query = $db->prepare("SELECT * FROM cart WHERE id = :cartID");
  $query->bindParam(':cartID', $cartID);
  $query->execute();
  $result = $query->fetchAll();
} while ($result);

//if the item is already in their cart update the quantity
$query = $db->prepare("SELECT * FROM cart where productID = :productID AND accountNumber = :accountNumber");
$query->bindValue(':accountNumber', $accountNumber);
$query->bindValue(':productID', $productID);

$query->execute();

$numOfItems = $query->rowCount();
$currentEntry = $query->fetch();
$currentQTY = $currentEntry['quantity'];
$newQTY = $currentQTY + $quantity;
if ($numOfItems > 0) {
  $quantity = $newQTY;
}

// make sure we have enough in stock
$query = $db->prepare("SELECT * FROM product where productID = :productID");
$query->bindValue(':productID', $productID);
$query->execute();
$productsInfo = $query->fetch();

if ($productsInfo['quantity'] < $quantity) {
  $_SESSION['addCart'] = 'insuffStock';
  header('Location: ../cart.php');
  //closes db connection
  $db = null;
  exit();
} else if ($numOfItems > 0) {
  // update cart if item is already there
  $inputToCart = $db->prepare("UPDATE cart SET quantity = :quantity where productID = :productID AND accountNumber = :accountNumber");
  $inputToCart->bindValue(':accountNumber', $accountNumber);
  $inputToCart->bindValue(':quantity', $quantity);
  $inputToCart->bindValue(':productID', $productID);
} else {
  //insert new item into cart table
  $inputToCart = $db->prepare("INSERT INTO cart VALUES (:cartID, :accountNumber, :productID, :quantity, :date)");
  $inputToCart->bindParam(':cartID', $cartID);
  $inputToCart->bindValue(':accountNumber', $accountNumber);
  $inputToCart->bindValue(':productID', $productID);
  $inputToCart->bindValue(':quantity', $quantity);
  $inputToCart->bindValue(':date', $date);
}

//check if query was successful
if ($inputToCart->execute()) {
  $_SESSION['addCart'] = 'added';
  header('Location: ../cart.php');
  exit();
} else {
  $_SESSION['addCart'] = 'failed';
  header('Location: ../cart.php');
  exit();
}


//closes db connection
$db = null;
exit();
