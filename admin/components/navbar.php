<div class="alert alert-info text-center mb-0" role="alert" style="border-radius:0;">
  <strong>Educational Use Only:</strong> This site is for educational purposes. All content, data, and entities are entirely fictitious.
</div>

<?php
// Only show full navbar if admin is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['userType'] == 'admin') : ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
      <a class="navbar-brand" href="./adminHomepage.php">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNavbar">
        <form class="d-flex mx-lg-auto my-3 my-lg-0" role="search" method="get" action="./adminProducts.php">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchQuery">
          <button class="btn btn-outline-success me-3" type="submit">Search</button>
        </form>

        <ul class="navbar-nav ms-lg-auto text-center">
          <li class="nav-item">
            <a class="navbar-brand" href="./adminProducts.php">Products</a>
          <li class="nav-item">
            <a class="navbar-brand" href="./adminAccount.php">Account</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="../scripts/logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php else : ?>
  <nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand mx-auto" href="../index.php">Sporting Goods Emporium</a>
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