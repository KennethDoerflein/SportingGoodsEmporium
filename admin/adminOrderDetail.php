<?php
//connect to database
require_once '../db_connect.php';
//get session data
session_start();
if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to landing page
  header('Location: ./adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../homepage.php');
}
//get order number and prepare query
$orderNumber = filter_input(INPUT_GET, 'orderNumber');
$query = $db->prepare("SELECT product.productID, orders.price, orders.shippingAddress, orders.billingAddress, product.name, product.image, orders.quantity FROM orders INNER JOIN product ON product.productID = orders.productID WHERE orders.orderNumber = :orderNumber");
$query->bindValue(':orderNumber', $orderNumber);
//run query
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
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <table class="table text-center align-middle mx-auto container-fluid" style="max-width: 90%;">
    <h3 class="text-center mt-3"><u>Order # <?php echo $orderNumber ?></u></h3>
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
      <th scope="row"><img src="../' . $product['image'] . '"class="img-fluid rounded-start" style="max-width: 80px;"></th>
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