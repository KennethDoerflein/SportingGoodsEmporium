<?php
//includes database connection
require_once '../db_connect.php';
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../homepage.php');
}

$productID = filter_input(INPUT_GET, 'productID');
if ($productID == NULL || $productID == FALSE) {
  header('Location: ./homepage.php');
} else {
  $query = $db->prepare("SELECT * FROM product where productID = :productID");
  $query->bindValue(':productID', $productID);
}

$query->execute();
$products = $query->fetchAll();
$query->closeCursor();
if (!empty($_SESSION['addCart']) && $_SESSION['addCart'] == 'MissingInput') {
  $notice = 'There was an error adding to the cart. Please try again.';

  $_SESSION['addCart'] = '';
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
<nav class="navbar navbar-dark bg-dark mb-5">
  <div class="container-fluid">
    <a class="navbar-brand" href="./adminHomepage.php">Home</a>
    <a class="navbar-brand" href="./adminProducts.php">Products</a>
    <form class="d-flex mx-auto" role="search" method="get" action="./adminProducts.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
      <button class="btn btn-outline-success me-3" type="submit">Search</button>
    </form>
    <a class="navbar-brand" href="./adminAccount.php">Account</a>
    <a class="navbar-brand" href="../scripts/logout.php">Logout</a>
  </div>
</nav>
  <?php
  // echo "logged in user email: " . $_SESSION['email'];
  // echo "<br>logged in user account number: " . $_SESSION['account'];
  ?>
  <center>
    <h1>
      <div style='color: red;'><?php if (!empty($notice)) {
                                  echo $notice;
                                } ?></div>
    </h1>
  </center>
  <div class="container-fluid mx-auto text-center">
    <?php foreach ($products as $product) : ?>
      <?php
      echo '<img width="250px" src="../' . $product['image'] . '">';
      echo '<div class="mt-4">';
      echo '<p><strong>Product ID: </strong>' . $product['productID'] . '</p>';
      echo '<h4><strong>' . $product['name'] . '</strong></h4>';
      echo '<p class="mt-3"><strong>Price: </strong>$' . $product['price'] . '</p>';
      echo '<p> <strong>Description: </strong>' . $product['category'] . '</p>';
      echo '<p> <strong>Description: </strong>' . $product['description'] . '</p>';
      echo '<p><strong>Manufacturer: </strong>' . $product['manufacturer'] . '</p>';
      echo '<p><strong>Quantity: </strong>' . $product['quantity'] . '</p>';
      ?>
    <?php endforeach; ?>
  </div>
  <div class="mb-5"></div>
</body>

</html>