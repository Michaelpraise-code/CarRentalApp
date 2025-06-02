<?php include 'components/NavBar.php'; ?>
<?php require 'config/db-connect.php'; ?>

<?php
$stmt = $pdo->prepare("SELECT * FROM cars ORDER BY id DESC LIMIT 4");
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home | Car Rentals</title>
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/index.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>

<header class="hero-section text-white text-center">
  <div class="container">
    <h1>Drive Your Dream</h1>
    <p>Affordable, Reliable & Stylish Car Rentals Across Nigeria</p>
    <a href="cars.php" class="btn btn-primary">Browse Our Fleet</a>
  </div>
</header>

<section class="why-us text-center py-5">
  <div class="container">
    <h2>Why Choose Michael's Car Store?</h2>
    <div class="row mt-4">
      <div class="col-md-4"><i class="bi bi-car-front-fill fs-2 mb-2"></i><h5>Diverse Fleet</h5><p>From compact to luxury, we have the perfect car.</p></div>
      <div class="col-md-4"><i class="bi bi-shield-check fs-2 mb-2"></i><h5>Trust & Safety</h5><p>Vehicles maintained to the highest standards.</p></div>
      <div class="col-md-4"><i class="bi bi-telephone-inbound fs-2 mb-2"></i><h5>24/7 Support</h5><p>We’re here to help before and during your trip.</p></div>
    </div>
  </div>
</section>

<section class="latest-cars py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Latest Arrivals</h2>
    <div class="row">
      <?php foreach($cars as $car): ?>
        <div class="col-md-3 mb-4">
          <div class="car-box p-3 rounded shadow-sm bg-white">
            <img src="<?= $car['image'] ?? 'assets/images/default-car.jpg' ?>" class="img-fluid mb-2" alt="Car Image">
            <h6><?= $car['make'] ?> <?= $car['model'] ?></h6>
            <p><?= $car['year'] ?> • ₦<?= number_format($car['daily_rate']) ?>/day</p>
            <a href="car.php?id=<?= $car['id'] ?>" class="btn btn-outline-primary btn-sm">View</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="testimonials text-white py-5">
  <div class="container text-center">
    <h2>What Our Customers Say</h2>
    <div class="row mt-4">
      <div class="col-md-4"><blockquote>"Excellent service and clean cars!"<footer>— Sarah A.</footer></blockquote></div>
      <div class="col-md-4"><blockquote>"Affordable and convenient, 10/10."<footer>— Emeka T.</footer></blockquote></div>
      <div class="col-md-4"><blockquote>"I got value for every Naira spent."<footer>— Bisi K.</footer></blockquote></div>
    </div>
  </div>
</section>

<section class="faq-section py-5 bg-white">
  <div class="container">
    <h2 class="text-center mb-4">FAQs</h2>
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Do I need a driver's license?</button></h2>
        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body">Yes, a valid driver's license is required for all rentals.</div></div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Can I rent for just one day?</button></h2>
        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Yes, our rentals start from a 24-hour period.</div></div>
      </div>
    </div>
  </div>
</section>

<section class="contact-info py-5 text-white bg-dark text-center">
  <div class="container">
    <h2>Get In Touch</h2>
    <p><i class="bi bi-envelope-fill me-2"></i> support@michaelscars.com</p>
    <p><i class="bi bi-telephone-fill me-2"></i> +234 800 123 4567</p>
    <p><i class="bi bi-geo-alt-fill me-2"></i> 12 Palm Avenue, Ikeja, Lagos</p>
  </div>
</section>

<?php include 'footer.php'; ?>
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
