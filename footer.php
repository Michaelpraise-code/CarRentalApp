<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="assets/css/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    
<footer class="footer mt-auto py-4 text-white text-center" >
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
        <p><i class="bi bi-telephone-fill me-2"></i> +234 906 012 8141</p>
        <p><i class="bi bi-geo-alt-fill me-2"></i> 12 Palm Avenue, Ikeja, Lagos</p>
        <p><i class="bi bi-envelope-fill me-2"></i> okohmick24@gmail.com</p>
       <div class="social-icons">
          <a href="https://web.facebook.com/mickel.obi.7923?_rdc=1&_rdr" target="_blank" class="me-2 text-white">
          <i class="bi bi-facebook"></i>
          </a>
          <a href="https://x.com/omichael24" target="_blank" class="me-2 text-white">
          <i class="bi bi-twitter-x">X</i>
          </a>
          <a href="instagram.com" target="_blank" class="me-2 text-white">
            <i class="bi bi-instagram"></i>
          </a>
</div>

      </div>

    </div>

    <hr class="border-light">
    <p class="text-center mb-0">© <?= date('Y') ?> Car Rentals. All rights reserved.</p>
  </div>
</footer>

</body>
</html>