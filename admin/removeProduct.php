<?php
//get session variables
session_start();
if (!isset($_SESSION['logged_in'])) {
  //if not logged in, redirects admin to login page
  header('Location: ./adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  //if customer, redirects user to customer homepage
  header('Location: ../homepage.php');
}
// check notices
if (!empty($_SESSION['missing_input']) && $_SESSION['missing_input']) {
  $notice = 'Please Try Again';
  $_SESSION['missing_input'] = '';
} else if (!empty($_SESSION['removeProduct_success']) && $_SESSION['removeProduct_success']) {
  $notice = 'Product Was Removed';
  $_SESSION['removeProduct_success'] = '';
} else if (!empty($_SESSION['invalidPass']) && $_SESSION['invalidPass']) {
  $notice = 'Invalid Password';
  $_SESSION['invalidPass'] = '';
} else if (!empty($_SESSION['product_DNE']) && $_SESSION['product_DNE']) {
  $notice = 'Product Does Not Exist';
  $_SESSION['product_DNE'] = '';
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

  <div class="container">
    <h1 class="text-center">Remove Product</h1>
    <center>
      <h1>
        <div style='color: red;'><?php if (!empty($notice)) {
                                    echo $notice;
                                  } ?></div>
      </h1>
    </center>

    <form method="POST" class="form-horizontal" action="./adminScripts/removeProductCheck.php">
      <div class="form-group row mb-2">
        <label class="col-form-label col-sm-2" for="productID">Product ID:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="productID" name="productID">
        </div>
      </div>

      <div class="form-group row mb-2">
        <label class="col-form-label col-sm-2" for="admin_password">Admin Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="admin_password" name="admin_password">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 mt-2">
          <button type="submit" class="btn btn-dark" name="submit">Remove Product</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </div>
      </div>
    </form>
  </div>

  <div class="mb-5"></div>
</body>

</html>