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

$searchReq = filter_input(INPUT_GET, 'searchQuery');
if ($searchReq != NULL || $searchReq != FALSE) {
  $query = $db->prepare("SELECT * FROM PRODUCT WHERE name like :search OR description like :search OR manufacturer like :search OR category like :search ORDER BY category DESC");
  $query->bindValue(':search', "%" . $searchReq . "%");
} else {
  $query = $db->prepare("SELECT * FROM product");
}
$query->execute();
$products = $query->fetchAll();
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
<div class="mx-auto container-fluid row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-4 text-center">
  <?php foreach ($products as $product) : ?>
    <?php
    echo '<div class="col mx-auto">';
    echo '<div class="border border-dark border-3 mx-auto card h-100 text-center" style="width: 20rem;">';
    echo '<img height="450"src="../' . $product['image'] . '" class="card-img-top">';
    echo '<div class="card-body">';
    echo '<strong class="card-title">' . $product['name'] . '</strong>';
    echo '<p class="card-text">Price: $' . $product['price'] . '</p>';
    echo '<p class="card-text">Product ID: ' . $product['productID'] . '</p>';
    echo '<p class="card-text">Quantity: ' . $product['quantity'] . '</p>';
    echo '<a href="#" class="btn btn-dark">View Product</a>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    ?>
  <?php endforeach; ?>
</div>
<div class="mb-5"></div>
</body>

</html>