<?php
//includes database connection
require_once './db_connect.php';
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./index.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if admin, redirects user to admin homepage
  header('Location: ./admin/adminHomepage.php');
}
$query = $db->prepare("SELECT PRODUCT.productID, PRODUCT.price, PRODUCT.name, PRODUCT.image, CART.quantity, CART.dateAdded FROM CART INNER JOIN PRODUCT ON PRODUCT.productID = CART.productID WHERE CART.accountNumber = :accountNumber ORDER BY dateAdded DESC");
$query->bindValue(':accountNumber', $_SESSION['account']);

$query->execute();
$products = $query->fetchAll();
$query->closeCursor();
$total = 0.0;

if ($_SESSION['addCart'] == 'added') {
  $notice = 'Item Was Added to Your Cart';

  $_SESSION['addCart'] = '';
} else if ($_SESSION['addCart'] == 'failed') {
  $notice = 'Item was not added to your cart';

  $_SESSION['addCart'] = '';
} else if ($_SESSION['inSuffStock']) {
  $notice = 'Insufficient Stock, Quantity Updated';

  $_SESSION['inSuffStock'] = '';
} else if ($_SESSION['placeOrder'] == 'success') {
  $notice = 'Order Received';

  $_SESSION['placeOrder'] = '';
} else if ($_SESSION['itemRemoved']) {
  $notice = 'Item Was Removed';

  $_SESSION['itemRemoved'] = '';
} else if ($_SESSION['removalErr']) {
  $notice = 'Item Was Not Removed';

  $_SESSION['removalErr'] = '';
} else if ($_SESSION['addCart'] == 'insuffStock') {
  $notice = 'Insufficient Stock';

  $_SESSION['removalErr'] = '';
} else if ($_SESSION['checkout_error']) {
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
  <style>
    @media all and (min-width: 992px) {
      .navbar .nav-item .dropdown-menu {
        display: none;
      }

      .navbar .nav-item:hover .dropdown-menu {
        display: block;
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand navbar-dark bg-dark mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="./homepage.php">Home</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./homepage.php?category_id=All">All Products</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Tops">Tops</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Bottoms">Bottoms</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Shoes">Shoes</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Hats">Hats</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Socks">Socks</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Exercise Equipment">Exercise Equipment</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search" method="get" action="./homepage.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
        <button class="btn btn-outline-success me-3" type="submit">Search</button>
      </form>
      <a class="navbar-brand" href="./cart.php">Cart</a>
      <a class="navbar-brand" href="./account.php">Account</a>
      <a class="navbar-brand" href="./scripts/logout.php">Logout</a>
    </div>
  </nav>

  <table class="table text-center align-middle mx-auto container-fluid" style="max-width: 90%;">
    <center>
      <h1>
        <div style='color: red;'><?php if (!empty($notice)) {
                                    echo $notice;
                                  } ?></div>
      </h1>
    </center>
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