<?php
//get session data
session_start();
if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects user to login page
  header('Location: ./adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../homepage.php');
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

  <div class="text-center container-fluid">
    <h3 class="mx-auto">Admin Panel</h3>
    <hr class="mx-auto mb-4">
  </div>

  <div class="mx-auto container-fluid row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4 g-4 text-center">
    <div class="d-grid gap-4 col-4 mx-auto">
      <a href="./adminOrderList.php" class="btn btn-dark" role="button">View Orders</a>
      <a href="./adminRegister.php" class="btn btn-dark" role="button">Add Admin</a>
      <a href="./addProduct.php" class="btn btn-dark" role="button">Add Product</a>
      <a href="./modifyProduct.php" class="btn btn-dark" role="button">Modify Product</a>
      <a href="./removeProduct.php" class="btn btn-dark" role="button">Remove Product</a>
    </div>
  </div>

  <div class="mb-5"></div>
</body>

</html>