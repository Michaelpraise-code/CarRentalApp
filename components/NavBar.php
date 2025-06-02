<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom Navbar Styles -->
<link rel="stylesheet" href="assets/css/navbar.css">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm custom-navbar">
  <div class="container-fluid mb-3">

    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <i class="bi bi-steering-wheel me-2 fs-4 text-success"></i>
      <strong>Car Rentals</strong>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link" href="index.php"><i class="bi bi-house-door me-1"></i> Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="cars.php"><i class="bi bi-car-front me-1"></i> Browse Cars</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="about.php"><i class="bi bi-info-circle me-1"></i> About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php"><i class="bi bi-envelope me-1"></i> Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="service.php"><i class="bi bi-gear me-1"></i> Services</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="term.php"><i class="bi bi-file-earmark-text me-1"></i> Terms</a>
        </li>

        <!-- Login/Admin Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> Account
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
            <li><a class="dropdown-item" href="login.php"><i class="bi bi-box-arrow-in-right me-2"></i> Login</a></li>
            <li><a class="dropdown-item" href="admin/login.php"><i class="bi bi-shield-lock me-2"></i> Admin</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </div>
</nav>
