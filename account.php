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

//prepare query for database
$query = $db->prepare("SELECT * FROM customer where accountNumber = :accountNumber");
$query->bindValue(':accountNumber', $_SESSION['account']);

//query database
$query->execute();
$accountInfo = $query->fetch();
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

  <div class="mx-auto container-fluid text-center">
    <?php if ($_SESSION['userType'] == 'customer') {
      echo '<a href="./orderList.php" class="btn btn-dark">View Orders</a>';
    }
    echo '<div class="mb-5"></div>';
    echo '<hr>';
    echo '<div class="mb-5"></div>';
    echo '<h3><u>Account Information</u></h3>';
    echo 'Email: ' . $accountInfo['email'];
    echo '<div class="mb-2"></div>';
    echo 'First Name: ' . $accountInfo['Fname'];
    echo '<div class="mb-2"></div>';
    echo 'Last Name: ' . $accountInfo['Lname'];
    echo '<div class="mb-2"></div>';
    echo 'Address: ' . $accountInfo['address'];
    echo '<div class="mb-2"></div>';
    echo 'Phone Number: ' . $accountInfo['phoneNumber'];
    echo '<div class="mb-2"></div>';
    ?>

  </div>

  <div class="mb-5"></div>

  </div>
</body>

</html>