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
$admin_password = trim($_POST['admin_password']);
$adminID = $_SESSION['account'];


//checks if all required values are not empty
if (empty($productID) || empty($admin_password) || empty($adminID)) {

  //redirects to registration page if all values are not input
  $_SESSION['missing_input'] = true;
  header('Location: ../removeProduct.php');

  //closes database connection
  $database = null;
  exit();
}

//prepares query statement
$query = $db->prepare("SELECT * FROM employee WHERE employeeID = :adminID");
$query->bindParam(':adminID', $adminID);

//gets any elements from database that has matching email
$query->execute();
$result = $query->fetch();

//check if admin password is valid and remove product
if (password_verify($admin_password, $result['password'])) {
  $query = $db->prepare("SELECT image FROM product WHERE productID = :productID");
  $query->bindParam(':productID', $productID);

  $query->execute();
  $result = $query->fetch();
  unlink("../../" . $result['image']);

  $query = $db->prepare("DELETE FROM product WHERE productID = :productID");
  $query->bindParam(':productID', $productID);
  $query->execute();
  $remove = $db->prepare("DELETE FROM cart WHERE productID = :productID");
  $remove->bindParam(':productID', $productID);
  $remove->execute();
} else {
  //redirects to remove page if failed
  $_SESSION['invalidPass'] = true;
  header('Location: ../removeProduct.php');
}
if ($query->rowCount() > 0) {
  //redirects to remove product page if successful
  $_SESSION['removeProduct_success'] = true;
  header("Location: ../removeProduct.php");
} else {
  //redirects to remove page if failed
  $_SESSION['product_DNE'] = true;
  header('Location: ../removeProduct.php');
}

//closes database connection
$database = null;
exit();
