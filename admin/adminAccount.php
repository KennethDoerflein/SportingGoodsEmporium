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
//prepare query
$query = $db->prepare("SELECT * FROM employee where employeeID = :employeeID");
$query->bindValue(':employeeID', $_SESSION['account']);
//execute query
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
    <div class="fs-5">Name: <?php echo $accountInfo['Fname'] . " " . $accountInfo['Lname']; ?></div>
    <div class="fs-5">Email: <?php echo $accountInfo['email']; ?></div>
    <div class="fs-5">Phone: <?php echo $accountInfo['phoneNumber']; ?></div>
    <div class="fs-5">Salary: $<?php echo $accountInfo['salary']; ?></div>
  </div>

</body>

</html>