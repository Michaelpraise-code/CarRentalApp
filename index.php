<?php include 'components/NavBar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home | Car Rental</title>

  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
</head>
<body>

  <header class="hero-section text-center text-white">
    <div class="container">
      <h1>Welcome to Michael's Car Rental</h1>
      <p>Your trusted partner for reliable, affordable, and stylish cars on the go.</p>
      <a href="cars.php" class="btn btn-primary mt-3">Browse Cars</a>
    </div>
  </header>

  <section class="features container text-center my-5">
    <h2>Why Choose Us</h2>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="feature-box">
          <h5>Flexible Rentals</h5>
          <p>Choose daily, weekly or monthly options that fit your schedule.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h5>Well-Maintained Cars</h5>
          <p>Our cars are regularly inspected and cleaned before every trip.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-box">
          <h5>Customer Support</h5>
          <p>We’re here for you 24/7—before, during, and after your rental.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials text-white py-5">
    <div class="container text-center">
      <h2 class="mb-4">What Our Customers Say</h2>
      <div class="row">
        <div class="col-md-4">
          <blockquote>
            <p>"The car was clean, the booking was fast, and I got excellent support!"</p>
            <footer>— Sarah A.</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote>
            <p>"I used Michael’s Car Store for my business trip, and I’ll use them again."</p>
            <footer>— James O.</footer>
          </blockquote>
        </div>
        <div class="col-md-4">
          <blockquote>
            <p>"Booking was easy, and the car I got was perfect for my road trip."</p>
            <footer>— Lola M.</footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>


  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>