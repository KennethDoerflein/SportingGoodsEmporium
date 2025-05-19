<?php
//includes database connection
require_once './db_connect.php';
//get session variables
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./index.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if admin, redirects user to admin homepage
  header('Location: ./admin/adminHomepage.php');
}

//prepare query for database
$query = $db->prepare("SELECT product.productID, product.price, product.name, product.image, cart.quantity, cart.dateAdded FROM cart INNER JOIN product ON product.productID = cart.productID WHERE cart.accountNumber = :accountNumber ORDER BY dateAdded DESC");
$query->bindValue(':accountNumber', $_SESSION['account']);

//query database
$query->execute();
$products = $query->fetchAll();
$query->closeCursor();
$total = 0.0;

if (!empty($_SESSION['addCart']) && $_SESSION['addCart'] == 'added') {
  $notice = 'Item Was Added to Your Cart';
  $_SESSION['addCart'] = '';
} else if (!empty($_SESSION['addCart']) && $_SESSION['addCart'] == 'failed') {
  $notice = 'Item was not added to your cart';
  $_SESSION['addCart'] = '';
} else if (!empty($_SESSION['inSuffStock']) && $_SESSION['inSuffStock']) {
  $notice = 'Insufficient Stock, Quantity Updated';
  $_SESSION['inSuffStock'] = '';
} else if (!empty($_SESSION['placeOrder']) && $_SESSION['placeOrder'] == 'success') {
  $notice = 'Order Received';
  $_SESSION['placeOrder'] = '';
} else if (!empty($_SESSION['itemRemoved']) && $_SESSION['itemRemoved']) {
  $notice = 'Item Was Removed';
  $_SESSION['itemRemoved'] = '';
} else if (!empty($_SESSION['removalErr']) && $_SESSION['removalErr']) {
  $notice = 'Item Was Not Removed';
  $_SESSION['removalErr'] = '';
} else if (!empty($_SESSION['addCart']) && $_SESSION['addCart'] == 'insuffStock') {
  $notice = 'Insufficient Stock';
  $_SESSION['removalErr'] = '';
} else if (!empty($_SESSION['checkout_error']) && $_SESSION['checkout_error']) {
  $notice = 'An Error Occurred, Please Try Again';
  $_SESSION['checkout_error'] = '';
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>SGE</title>
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <center>
    <h1>
      <div style='color: red;'><?php if (!empty($notice)) {
                                  echo $notice;
                                } ?></div>
    </h1>
  </center>

  <table class="table text-center align-middle mx-auto container-fluid" style="max-width: 90%;">
    <h3 class="text-center"><u>Cart</u></h3>
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Subtotal</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <?php
        echo '
      <tr>
      <th scope="row"><img src="./' . $product['image'] . '"class="img-fluid rounded-start" style="max-width: 80px;"></th>
      <td>' . $product['name'] . '</td>
      <td>$' . $product['price'] . '</td>
      <td>' . $product['quantity'] . '</td>
      <td>$' . $product['quantity'] * $product['price'] . '</td>' ?>
        <?php $total += doubleval($product['quantity'] * $product['price']); ?>
        <?php
        echo '<td><a href="./scripts/removeFromCart.php?productID=' . $product['productID'] . '" class="btn btn-danger">Remove</a></td>
      </tr>
    ';
        ?>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="mx-auto container-fluid text-center">
    <h4><?php if ($query->rowCount() != 0) {
          echo 'Total: $' . $total;
        } else {
          echo 'Shopping Cart Is Empty';
        } ?></h4>
    <a href="./checkoutPage.php" class="btn btn-dark btn-lg <?php if ($query->rowCount() == 0) {
                                                              echo 'disabled';
                                                            } ?>">Checkout</a>
  </div>

  <div class="mb-5"></div>
</body>

</html>