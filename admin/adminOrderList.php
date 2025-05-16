<?php
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
$orderNum = filter_input(INPUT_GET, 'orderNum');
if ($orderNum != NULL || $orderNum != FALSE) {
  $query = $db->prepare("SELECT DISTINCT orderNumber,purchaseDate FROM ORDERS where orderNumber = :orderNum");
  $query->bindValue(':orderNum', $orderNum);
} else {
  $query = $db->prepare("SELECT DISTINCT orderNumber,purchaseDate FROM ORDERS ORDER BY purchaseDate DESC");
}
//run query
$query->execute();
$products = $query->fetchAll();
$query->closeCursor();
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
    <h3 class="text-center mt-3"><u>Previous Orders</u></h3>
    <form class="d-flex mx-auto" role="search" method="get" action="./adminOrderList.php">
      <div class="input-group mx-auto" style="max-width: 300px;">
        <input type="search" class="form-control rounded" placeholder="Search" name="orderNum" />
        <button type="submit" class="btn btn-outline-primary">search</button>
      </div>
    </form>
    <?php if ($query->rowCount() == 0) {
      echo '<h3><div class="mt-2 text-center" >Order Not Found</div></h3>';
    } ?>
    <thead>
      <tr>
        <th scope="col">Order #</th>
        <th scope="col">Date</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) : ?>
        <?php

        echo '
      <tr>
      <td>' . $product['orderNumber'] . '</td>
      <td>' . $product['purchaseDate'] . '</td> ' ?>
        <?php
        echo '<td><a href="./adminOrderDetail.php?orderNumber=' . $product['orderNumber'] . '" class="btn btn-dark">View Details</a></td>
      </tr>
    ';
        ?>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="mb-5"></div>
</body>

</html>