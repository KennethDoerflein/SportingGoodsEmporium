<?php
//get session data
session_start();
//if already logged in go to homepage
if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
  header('Location: ./adminHomepage.php');
}
// check and display error messages
if (!empty($_SESSION['login_error']) && $_SESSION['login_error']) {
  $notice = 'Please Try Again';
  $_SESSION['login_error'] = '';
} else if (!empty($_SESSION['account_DNE']) && $_SESSION['account_DNE']) {
  $notice = 'Account Does Not Exist';
  $_SESSION['account_DNE'] = '';
} else if (!empty($_SESSION['invalid_password']) && $_SESSION['invalid_password']) {
  $notice = 'Invalid Password, Please Try Again';
  $_SESSION['invalid_password'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <div class="container">
    <h1 class="text-center">Admin Login</h1>
    <center>
      <h1>
        <div style='color: red;'><?php if (!empty($notice)) {
                                    echo $notice;
                                  } ?></div>
      </h1>
    </center>
    <form method="POST" class="form-horizontal" action="./adminScripts/adminLoginCheck.php">
      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
          <input required type="email" class="form-control" id="email" placeholder="example@example.com" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="password">Password:</label>
        <div class="col-sm-10">
          <input required type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 mt-2">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </div>
    </form>

    <div class="offset-sm-2 col-sm-10 mt-2">
      <hr class="mt-5">
      <div class="mt-5">Looking for the customer login?</div>
      <a href="../login.php"><button type="button" class="btn btn-primary mt-2">Customer Login</button></a>
      <div>

      </div>

</body>

</html>