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
//prepare query
$query = $db->prepare("SELECT DISTINCT orderNumber,purchaseDate FROM ORDERS WHERE accountNumber = :accountNumber ORDER BY purchaseDate DESC");
$query->bindValue(':accountNumber', $_SESSION['account']);

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
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <table class="table text-center align-middle mx-auto container-fluid" style="max-width: 90%;">
    <h3 class="text-center"><u>Previous Orders</u></h3>
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
        echo '<td><a href="./orderDetail.php?orderNumber=' . $product['orderNumber'] . '" class="btn btn-dark">View Details</a></td>
      </tr>
    ';
        ?>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="mb-5"></div>
</body>

</html>