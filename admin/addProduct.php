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

// check notices
if (!empty($_SESSION['missing_input']) && $_SESSION['missing_input']) {
  $notice = 'Please Try Again';
  $_SESSION['missing_input'] = '';
} else if (!empty($_SESSION['image_name_exists']) && $_SESSION['image_name_exists']) {
  $notice = 'Please Rename Image';
  $_SESSION['image_name_exists'] = '';
} else if (!empty($_SESSION['file_too_large']) && $_SESSION['file_too_large']) {
  $notice = 'Please Use a Smaller Image';
  $_SESSION['file_too_large'] = '';
} else if (!empty($_SESSION['invalid_file_type']) && $_SESSION['invalid_file_type']) {
  $notice = 'Invalid File Type';
  $_SESSION['invalid_file_type'] = '';
} else if (!empty($_SESSION['addProduct_success']) && $_SESSION['addProduct_success']) {
  $notice = 'Product Was Added';
  $_SESSION['addProduct_success'] = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Add Product</title>
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
    <h1 class="text-center"><strong>Add a Product</strong></h1>
    <center>
      <h1>
        <div style='color: red;'><?php if (!empty($notice)) {
                                    echo $notice;
                                  } ?></div>
      </h1>
    </center>
    <div class="text-center mb-3">Enter the product information below:</div>
    <form enctype="multipart/form-data" method="POST" class="form-horizontal" action="./adminScripts/addProductCheck.php">

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_name">Product Name/Title:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="product_name" name="product_name">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_category">Product Category:</label>
        <div class="col-sm-10">
          <select class="form-control" name="product_category" id="product_category">
            <option value="Tops">Tops</option>
            <option value="Bottoms">Bottoms</option>
            <option value="Shoes">Shoes</option>
            <option value="Hats">Hats</option>
            <option value="Socks">Socks</option>
            <option value="Exercise Equipment">Exercise Equipment</option>
          </select>
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_price">Product Price:</label>
        <div class="col-sm-10">
          <input required type="number" class="form-control" id="product_price" placeholder="Ex: xx.xx" name="product_price" pattern="\d?\d\.\d\d" maxlength=5 size=5 min=0.01 step=0.01>
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_manufacturer">Product Manufacturer:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="product_manufacturer" name="product_manufacturer">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_description">Product Description:</label>
        <div class="col-sm-10">
          <input required type="text" class="form-control" id="product_description" name="product_description">
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_quantity">Product Quantity:</label>
        <div class="col-sm-10">
          <input required type="number" class="form-control" id="product_quantity" name="product_quantity" min=1>
        </div>
      </div>

      <div class=" form-group row mb-2">
        <label class="col-form-label col-sm-2" for="product_image">Product Image:</label>
        <div class="col-sm-10">
          <input required type="file" class="form-control" id="product_image" name="product_image">
        </div>
      </div>

      <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 mt-2">
          <button type="submit" class="btn btn-dark" name="submit">Add Product</button>
          <button type="reset" class="btn btn-danger">Clear</button>
        </div>
      </div>
    </form>
</body>

</html>