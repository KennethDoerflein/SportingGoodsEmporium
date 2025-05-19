<div class="alert alert-info text-center mb-0" role="alert" style="border-radius:0;">
  <strong>Educational Use Only:</strong> This site is for educational purposes. All content, data, and entities are entirely fictitious.
</div>

<?php
// Only show full navbar if user is logged in
if (isset($_SESSION['logged_in'])) : ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
      <!-- Home link styled as brand -->
      <a class="navbar-brand" href="./homepage.php">Home</a>

      <!-- Toggler for mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="userNavbar">
        <!-- Categories dropdown -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="navbar-brand nav-link dropdown-toggle" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
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

        <!-- Search form -->
        <form class="d-flex my-2 my-lg-0 me-lg-3" role="search" method="get" action="./homepage.php">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <!-- Right-side links styled as navbar-brand for consistency -->
        <div class="d-flex flex-column flex-lg-row">
          <a class="navbar-brand" href="./cart.php">Cart</a>
          <a class="navbar-brand" href="./account.php">Account</a>
          <a class="navbar-brand" href="./scripts/logout.php">Logout</a>
        </div>
      </div>
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