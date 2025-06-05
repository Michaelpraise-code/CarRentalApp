<?php
require_once 'config/db-connect.php';
include 'components/NavBar.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: cars.php");
  exit();
}

$car_id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$car_id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
  header("Location: cars.php");
  exit();
}

$imageFolder = "carimages/";
$imageName = $car['carimages'] ?? 'default.jpg';
$imagePath = $imageFolder . $imageName;
$fullLocalPath = $_SERVER['DOCUMENT_ROOT'] . '/carrentalapp/' . $imagePath;

if (!file_exists($fullLocalPath) || empty($car['carimages'])) {
  $imagePath = $imageFolder . 'default.jpg';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?> | Car Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/car.css" />
</head>
<body>
  <?php include 'components/NavBar.php'; ?>

  <?php if (isset($_SESSION['rental_success'])): ?>
    <div class="container mt-3">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['rental_success']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
    <?php unset($_SESSION['rental_success']); ?>
  <?php endif; ?>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Car Details</h2>

    <div class="row justify-content-center">
      <!-- Car Image and Details -->
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <img src="carimages/<?= $car['images'] ?? 'default.jpg' ?>" class="card-img-top" alt="<?= htmlspecialchars($car['make'] . ' ' . $car['model']) ?>" style="height: 250px; object-fit: cover;">
          <div class="card-body">
            <h3 class="card-title"><?= htmlspecialchars($car['make'] . ' ' . $car['model']); ?></h3>
            <p class="card-text"><strong>Year:</strong> <?= htmlspecialchars($car['year']); ?></p>
            <p class="card-text"><strong>Daily Rate:</strong> $<?= htmlspecialchars(number_format($car['daily_rate'], 2)); ?></p>
            <p class="card-text"><strong>Status:</strong> <?= htmlspecialchars(ucfirst($car['status'])); ?></p>
          </div>
        </div>
      </div>

      <!-- Booking Form -->
      <div class="col-md-6">
        <?php if ($car['status'] === 'available'): ?>
          <form action="processes/hire-process.php" method="POST" class="shadow-sm p-4 border rounded bg-light">
            <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
            <input type="hidden" name="daily_rate" value="<?= $car['daily_rate'] ?>">

            <h4 class="mb-3 text-center">Rent This Car</h4>

            <div class="mb-3">
              <label for="return_date" class="form-label">Return Date</label>
              <input type="date" id="return_date" name="return_date" class="form-control" required
                     min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+7 days')) ?>">
            </div>
            <div class="mb-3">
              <input type="text" name="first_name" placeholder="First Name" required class="form-control">
            </div>
            <div class="mb-3">
              <input type="text" name="last_name" placeholder="Last Name" required class="form-control">
            </div>
            <div class="mb-3">
              <input type="email" name="email" placeholder="Email" required class="form-control">
            </div>
            <div class="mb-3">
              <input type="tel" name="phone" placeholder="Phone Number" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">Book Now</button>
          </form>
        <?php else: ?>
          <div class="alert alert-warning text-center">This car is currently unavailable for booking.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
