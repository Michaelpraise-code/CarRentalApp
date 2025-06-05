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

<header class="hero-section text-white text-center d-flex align-items-center">
  <div class="container">
    <h1>Drive Your Dream</h1>
    <p>Affordable, Reliable & Stylish Car Rentals Across Nigeria</p>
    <a href="cars.php" class="btn btn-primary mt-3">Browse Our Fleet</a>
  </div>
</header>

<section class="why-us text-center py-5">
  <div class="container">
    <h2>Why Choose Michael's Car Store?</h2>
    <div class="row mt-4">
      <div class="col-md-4">
        <i class="bi bi-car-front-fill fs-2 mb-2 text-primary"></i>
        <h5>Diverse Fleet</h5>
        <p>From compact to luxury, we have the perfect car.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-shield-check fs-2 mb-2 text-primary"></i>
        <h5>Trust & Safety</h5>
        <p>Vehicles maintained to the highest standards.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-telephone-inbound fs-2 mb-2 text-primary"></i>
        <h5>24/7 Support</h5>
        <p>We're here to help before and during your trip.</p>
      </div>
    </div>
  </div>
</section>

<section class="latest-cars py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4">Latest Arrivals</h2>
    <div class="row">
      <?php if(!empty($cars)): ?>
        <?php foreach($cars as $car): ?>
          <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
          <!-- Image Handling -->
          <img src="carimages/<?= $car['images'] ?>" class="card-img-top" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" style="height: 150px; object-fit: cover;">

              <h6><?= htmlspecialchars($car['make']) ?> <?= htmlspecialchars($car['model']) ?></h6>
              <p><?= htmlspecialchars($car['year']) ?> • $<?= number_format($car['daily_rate']) ?>/day</p>
              <a href="car.php?id=<?= intval($car['id']) ?>" class="btn btn-outline-primary btn-sm">View</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center">
          <p>No cars available at the moment.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="testimonials text-white py-5">
  <div class="container text-center">
    <h2>What Our Customers Say</h2>
    <div class="row mt-4">
      <div class="col-md-4">
        <blockquote>"Excellent service and clean cars!"<footer>— Sarah A.</footer></blockquote>
      </div>
      <div class="col-md-4">
        <blockquote>"Affordable and convenient, 10/10."<footer>— Emeka T.</footer></blockquote>
      </div>
      <div class="col-md-4">
        <blockquote>"I got value for every Naira spent."<footer>— Bisi K.</footer></blockquote>
      </div>
    </div>
  </div>
</section>

<section class="faq-section py-5">
  <div class="container text-center">
    <h2 class="faq-title">Frequently Asked Questions</h2>
    <p class="faq-subtitle">Everything you need to know about our car rental service</p>

    <div class="accordion mx-auto" id="faqAccordion">
      <!-- FAQ 1 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
            <i class="bi bi-card-text me-2 faq-icon"></i>Do I need a driver's license?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Yes, a valid driver's license is required for all rentals. We accept both local and international driving permits. Your license must be valid for at least one year and you must be 21 years or older.
          </div>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
            <i class="bi bi-clock me-2 faq-icon"></i>Can I rent for just one day?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            Absolutely! Our rentals start from a minimum 24-hour period. We also offer flexible hourly rentals for shorter trips within the city. Weekend and weekly packages are available with special discounts.
          </div>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
            <i class="bi bi-shield-check me-2 faq-icon"></i>What insurance coverage is included?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
          <div class="accordion-body">
            All our vehicles come with comprehensive insurance coverage including third-party liability, collision damage waiver, and theft protection. Additional coverage options are available for peace of mind.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'footer.php'; ?>
</body>
</html>
