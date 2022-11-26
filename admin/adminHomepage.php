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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="./adminHomepage.php">Home</a>
            <a class="navbar-brand" href="adminProducts.php">Products</a>
            <form class="d-flex mx-auto" role="search" method="get" action="./adminProducts.php">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
                <button class="btn btn-outline-success me-3" type="submit">Search</button>
            </form>
            <a class="navbar-brand" href="./adminAccount.php">Account</a>
            <a class="navbar-brand" href="../scripts/logout.php">Logout</a>
        </div>
    </nav>
    <?php
    // echo "logged in user email: " . $_SESSION['email'];
    // echo "<br>logged in user account number: " . $_SESSION['account'];
    ?>
    <div class="text-center container-fluid p-2 mt-4">
        <h3 class="mx-auto">Admin Panel</h3>
    </div>

    <hr class="mx-auto mb-4">

    <div class="d-grid gap-4 col-4 mx-auto">
        <a href="./adminOrderList.php" class="btn btn-dark" role="button">View Orders</a>
        <a href="./adminRegister.php" class="btn btn-dark" role="button">Add Admin</a>
        <a href="./addProduct.php" class="btn btn-dark" role="button">Add Product</a>
        <a href="./modifyProduct.php" class="btn btn-dark" role="button">Modify Product</a>
        <a href="./removeProduct.php" class="btn btn-dark" role="button">Remove Product</a>
    </div>

</body>

</html>