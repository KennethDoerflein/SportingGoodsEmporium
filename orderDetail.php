<?php
//includes database connection
require_once './db_connect.php';
//get session data
session_start();

if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./index.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if admin, redirects user to admin homepage
  header('Location: ./admin/adminHomepage.php');
}

//get order id and prepare to query database
$orderNumber = filter_input(INPUT_GET, 'orderNumber');
$query = $db->prepare("SELECT PRODUCT.productID, ORDERS.price, ORDERS.shippingAddress, ORDERS.billingAddress, PRODUCT.name, PRODUCT.image, ORDERS.quantity FROM ORDERS INNER JOIN PRODUCT ON PRODUCT.productID = ORDERS.productID WHERE ORDERS.orderNumber = :orderNumber");
$query->bindValue(':orderNumber', $orderNumber);

//query database and fetch results
$query->execute();
$products = $query->fetchAll();
$query->closeCursor();
$total = 0.0;
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
    <h3 class="text-center"><u>Order # <?php echo $orderNumber ?></u></h3>
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col">Product</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Subtotal</th>
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
        echo '</tr>'; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="mx-auto container-fluid text-center">
    <h4><?php if ($query->rowCount() != 0) {
          echo 'Order Total: $' . $total;
          echo '<br><br><u>Shipping Address</u><br>' . $product['shippingAddress'];
          echo '<br><br><u>Billing Address</u><br>' . $product['billingAddress'];
        } ?></h4>
  </div>

  <div class="mb-5"></div>
</body>

</html>