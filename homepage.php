<?php
    session_start();
    if (!isset($_SESSION['logged_in'])) {
		//if not logged in, redirects user to landing page
		header('Location: ./index.php');
	}

    if ((isset($_SESSION['userType']) && $_SESSION['userType'] == 'admin') && (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true)) {
		//if admin, redirects user to admin homepage
		header('Location: ./admin/adminHomepage.php');
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
        <style>
        @media all and (min-width: 992px) {
            .navbar .nav-item .dropdown-menu{ display: none; }
            .navbar .nav-item:hover .dropdown-menu{ display: block; }
        }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="./homepage.php">Home</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                            <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Tops</a></li>
                            <li><a class="dropdown-item" href="#">Bottoms</a></li>
                            <li><a class="dropdown-item" href="#">Shoes</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>         
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success me-3" type="submit">Search</button>
                </form>
                <a class="navbar-brand" href="./account.php">Cart</a>
                <a class="navbar-brand" href="./account.php">Account</a>
                <a class="navbar-brand" href="./scripts/logout.php">Logout</a>
            </div>
        </nav>
        <?php 
            echo"logged in user email: ".$_SESSION['email'];
            echo"<br>logged in user account number: ".$_SESSION['account'];
        ?>
    </body>
</html>
