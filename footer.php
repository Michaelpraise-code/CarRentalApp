<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    
<footer class="footer mt-auto py-4 custom-footer text-white">
  <div class="container">
    <div class="row">

      <!-- Quick Links -->
      <div class="col-md-4 mb-3">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="index.php" class="footer-link">Home</a></li>
          <li><a href="cars.php" class="footer-link">Browse Cars</a></li>
          <li><a href="about.php" class="footer-link">About Us</a></li>
          <li><a href="contact.php" class="footer-link">Contact</a></li>
        </ul>
      </div>

      <!-- Services -->
      <div class="col-md-4 mb-3">
        <h5>Services</h5>
        <ul class="list-unstyled">
          <li><a href="service.php" class="footer-link">Our Services</a></li>
          <li><a href="term.php" class="footer-link">Terms & Conditions</a></li>
          <li><a href="login.php" class="footer-link">User Login</a></li>
          <li><a href="admin/login.php" class="footer-link">Admin Panel</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-md-4 mb-3">
        <h5>Contact Us</h5>
        <p><i class="bi bi-telephone-fill me-2"></i> +234 800 123 4567</p>
        <p><i class="bi bi-geo-alt-fill me-2"></i> 12 Palm Avenue, Ikeja, Lagos</p>
        <p><i class="bi bi-envelope-fill me-2"></i> support@michaelscars.com</p>
        <div class="social-icons">
          <a href="#" class="me-2 text-white"><i class="bi bi-facebook"></i></a>
          <a href="#" class="me-2 text-white"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="me-2 text-white"><i class="bi bi-instagram"></i></a>
        </div>
      </div>

    </div>

    <hr class="border-light">
    <p class="text-center mb-0">© <?= date('Y') ?> Car Rentals. All rights reserved.</p>
  </div>
</footer>

</body>
</html>