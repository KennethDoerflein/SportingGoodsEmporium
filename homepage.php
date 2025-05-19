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

//get category id or search query
$category_id = filter_input(INPUT_GET, 'category_id');
$searchReq = filter_input(INPUT_GET, 'searchQuery');

//prepare query based on input received
if ($searchReq != NULL || $searchReq != FALSE) {
  $query = $db->prepare("SELECT * FROM product WHERE name like :search OR description like :search OR manufacturer like :search OR category like :search ORDER BY category DESC");
  $query->bindValue(':search', "%" . $searchReq . "%");
} else if ($category_id == NULL || $category_id == FALSE || $category_id == "All") {
  $query = $db->prepare("SELECT * FROM product");
} else {
  $query = $db->prepare("SELECT * FROM product where category = :category");
  $query->bindValue(':category', $category_id);
}

//query database
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

  <div class="mx-auto container-fluid row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4 g-4 text-center">
    <?php foreach ($products as $product) : ?>
      <?php
      echo '<div class="col">';
      echo '<div class="border border-dark border-3 mx-auto card h-100 text-center" style="width: 20rem;">';
      echo '<img style="max-height: 450px;" src="./' . $product['image'] . '" class="card-img-top mt-auto">';
      echo '<div class="card-footer mt-auto d-flex flex-column">';
      echo '<strong class="card-title">' . $product['name'] . '</strong>';
      echo '<p class="card-text">$' . $product['price'] . '</p>';
      echo '<a href="./productView.php?productID=' . $product['productID'] . '" class="btn btn-dark mt-auto">View Product</a>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      ?>
    <?php endforeach; ?>
  </div>
  <div class="mb-5"></div>
</body>

</html>