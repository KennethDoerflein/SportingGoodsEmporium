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


$productID = filter_input(INPUT_GET, 'productID');

if (empty($productID)) {
  $_SESSION['addCart'] = 'MissingInput';
  header('Location: javascript:history.back()');
  //closes db connection
  $db = null;
  exit();
}

//prepare query for database
$query = $db->prepare("DELETE FROM cart WHERE productID = :productID AND accountNumber = :accountNumber");
$query->bindValue(':accountNumber', $_SESSION['account']);
$query->bindValue(':productID', $productID);

//check if query was successful
if ($query->execute()) {
  $_SESSION['itemRemoved'] = true;
  header('Location: ../cart.php');
  exit();
} else {
  $_SESSION['removalErr'] = true;
  header('Location: ../cart.php');
  exit();
}


//closes db connection
$db = null;
exit();
