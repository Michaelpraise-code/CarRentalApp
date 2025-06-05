<?php 
require_once 'config/db-connect.php';
include 'components/NavBar.php';

// Fetch all cars
$sql = 'SELECT * FROM cars';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cars | Michael's Car Store</title>

  <!-- Bootstrap + Icons -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="assets/css/cars.css">
</head>
<body>

<div class="container py-5">
  <h2 class="text-center text-light mt-5">Explore Our Cars</h2>
  <p class="text-center text-white mb-5">Select from our available fleet. Book your ride in minutes!</p>

  <div class="row g-4">
    <?php foreach ($cars as $car): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm h-100">
          <!-- Image Handling -->
          <img src="carimages/<?= $car['images'] ?>" class="card-img-top" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" style="height: 200px; object-fit: cover;">

          <div class="card-body">
            <h5 class="card-title"><?= $car['make'] . ' ' . $car['model'] ?></h5>
            <p><strong>Year:</strong> <?= $car['year'] ?></p>
            <p><strong>Daily Rate:</strong> $<?= number_format($car['daily_rate'], 2) ?></p>
            <p><strong>Status:</strong> 
              <span class="badge bg-<?= $car['status'] === 'available' ? 'success' : 'danger' ?>">
                <?= ucfirst($car['status']) ?>
              </span>
            </p>
          </div>

          <div class="card-footer bg-transparent border-0 text-center pb-3">
            <?php if ($car['status'] === 'available'): ?>
              <a href="car.php?id=<?= $car['id'] ?>" class="btn btn-primary w-75">View Car</a>
            <?php else: ?>
              <button class="btn btn-secondary w-75" disabled>Unavailable</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
