<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    //if not logged in, redirects user to landing page
    header('Location: ./adminLogin.php');
}

if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'customer') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
    //if customer, redirects user to customer homepage
    header('Location: ../homepage.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./adminHomepage.php">Home</a>
      <a class="navbar-brand" href="./adminProducts.php">Products</a>
      <form class="d-flex mx-auto" role="search" method="get" action="./adminProducts.php">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
                <button class="btn btn-outline-success me-3" type="submit">Search</button>
            </form>
      <a class="navbar-brand" href="./adminAccount.php">Account</a>
      <a class="navbar-brand" href="../scripts/logout.php">Logout</a>
    </div>
  </nav>
  <div class="container">
    <h1 class="text-center"><strong>Admin Registration</strong></h1>
    <div class="text-center mb-3">Enter the information below:</div>
    <form method="POST" class="form-horizontal" action="./adminScripts/adminRegistrationCheck.php" oninput='repassword.setCustomValidity(repassword.value != password.value ? "Passwords do not match." : "")'>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
          <input required type="email" class="form-control" id="email" placeholder="example@example.com" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="password">Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="repassword">Retype Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="repassword" placeholder="Reenter Password" name="repassword">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="first_name">First Name:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="firstName">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="last_name">Last Name:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="lastName">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="phone_num">Phone Number:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="phone_num" placeholder="999-999-9999" name="phoneNum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 mt-2">
          <button type="submit" class="btn btn-success">Create Account</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </div>
      </div>
    </form>
</body>

</html>