<div class="alert alert-info text-center mb-0" role="alert" style="border-radius:0;">
  <strong>Educational Use Only:</strong> This site is for educational purposes. All content, data, and entities are entirely fictitious.
</div>
<?php
// Only show full navbar if user is logged in
if (isset($_SESSION['logged_in'])) : ?>
  <nav class="navbar navbar-expand navbar-dark bg-dark mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="./homepage.php">Home</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="navbar-brand dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./homepage.php?category_id=All">All Products</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Tops">Tops</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Bottoms">Bottoms</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Shoes">Shoes</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Hats">Hats</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Socks">Socks</a></li>
              <li><a class="dropdown-item" href="./homepage.php?category_id=Exercise Equipment">Exercise Equipment</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <form class="d-flex" role="search" method="get" action="./homepage.php">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
        <button class="btn btn-outline-success me-3" type="submit">Search</button>
      </form>
      <a class="navbar-brand" href="./cart.php">Cart</a>
      <a class="navbar-brand" href="./account.php">Account</a>
      <a class="navbar-brand" href="./scripts/logout.php">Logout</a>
    </div>
  </nav>
<?php else : ?>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="./index.php">Sporting Goods Emporium</a>
    </div>
  </nav>
<?php endif; ?>

<style>
  @media all and (min-width: 992px) {
    .navbar .nav-item .dropdown-menu {
      display: none;
    }

    .navbar .nav-item:hover .dropdown-menu {
      display: block;
    }
  }
</style>