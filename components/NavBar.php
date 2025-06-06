<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm" style="background: linear-gradient(90deg, #0f3c61, #145e85);">
  <div class="container-fluid">
    <!-- Brand -->
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <i class="bi bi-steering-wheel me-2 fs-4 text-success"></i>
      <strong><i class="bi bi-car-front me-1"></i>EdMic Car Rentals</strong>
      
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <!-- Home -->
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>" href="index.php">
            <i class="bi bi-house-door me-1"></i> Home
          </a>
        </li>

        <!-- Browse Cars -->
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'cars.php' ? 'active' : '' ?>" href="cars.php">
            <i class="bi bi-car-front me-1"></i> Browse Cars
          </a>
        </li>

        <!-- About -->
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>" href="about.php">
            <i class="bi bi-info-circle me-1"></i> About Us
          </a>
        </li>

        <!-- More Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array(basename($_SERVER['PHP_SELF']), ['contact.php','service.php','term.php']) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-grid me-1"></i> More
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="contact.php"><i class="bi bi-envelope me-2"></i> Contact</a></li>
            <li><a class="dropdown-item" href="service.php"><i class="bi bi-gear me-2"></i> Services</a></li>
            <li><a class="dropdown-item" href="term.php"><i class="bi bi-file-earmark-text me-2"></i> Terms & Conditions</a></li>
          </ul>
        </li>

        <!-- Login -->
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : '' ?>" href="login.php">
            <i class="bi bi-box-arrow-in-right me-1"></i> Login
          </a>
        </li>

        <!-- Admin -->
        <li class="nav-item">
          <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'admin/login.php' ? 'active' : '' ?>" href="admin/login.php">
            <i class="bi bi-shield-lock me-1"></i> Admin
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
