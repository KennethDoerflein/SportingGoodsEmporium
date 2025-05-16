<?php
//includes database connection
require_once './db_connect.php';
//start session
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./index.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if admin, redirects user to admin homepage
  header('Location: ./admin/adminHomepage.php');
}

//get product id and prepare to query database
$productID = filter_input(INPUT_GET, 'productID');
if ($productID == NULL || $productID == FALSE) {
  header('Location: ./homepage.php');
} else {
  $query = $db->prepare("SELECT * FROM product where productID = :productID");
  $query->bindValue(':productID', $productID);
}
//query database and fetch results
$query->execute();
$products = $query->fetchAll();
$query->closeCursor();

//check for session for errors and display messages if needed
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
  <div class="container-fluid mx-auto text-center">
    <?php foreach ($products as $product) : ?>
      <?php
      echo '<img width="250px" src="./' . $product['image'] . '">';
      echo '<div class="mt-4">';
      echo '<h4><strong>' . $product['name'] . '</strong></h4>';
      echo '<p class="mt-3">$' . $product['price'] . '</p>';
      echo '<p> <strong>Description: </strong>' . $product['description'] . '</p>';
      echo '<p><strong>Manufacturer: </strong>' . $product['manufacturer'] . '</p>';
      echo '<form method="POST" class = "form-horizontal" action="./scripts/addToCart.php">';
      echo '<div class="col-sm-1 mx-auto mb-3 text-center">
        <input required type="number" class="form-control" id="product_quantity" name="product_quantity" value=1 min=1 max=' . $product['quantity'] . '>
    </div>';
      echo '<button type="submit" name="productID" value=' . $product['productID'] . ' class="btn btn-success">Add to Cart</button>';
      echo '</form>';
      echo '</br>';
      ?>
    <?php endforeach; ?>
  </div>
  <div class="mb-5"></div>
</body>

</html>