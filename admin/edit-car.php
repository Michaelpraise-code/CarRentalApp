<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please log in as admin.'];
    header('Location: login.php');
    exit();
}

require_once '../config/db-connect.php';

// Get car ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid car ID'];
    header('Location: manage-cars.php');
    exit();
}

$car_id = (int)$_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = trim($_POST['make']);
    $model = trim($_POST['model']);
    $year = (int)$_POST['year'];
    $daily_rate = (float)$_POST['daily_rate'];

    // Validate inputs (basic)
    if ($make === '' || $model === '' || $year < 2000 || $year > (int)date('Y') || $daily_rate <= 0) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please fill all fields correctly.'];
    } else {
        $sql = "UPDATE cars SET make = ?, model = ?, year = ?, daily_rate = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $updated = $stmt->execute([$make, $model, $year, $daily_rate, $car_id]);

        if ($updated) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Car updated successfully.'];
            header('Location: manage-cars.php');
            exit();
        } else {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to update car.'];
        }
    }
}

// Fetch car data to populate form
$sql = "SELECT * FROM cars WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$car_id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Car not found.'];
    header('Location: manage-cars.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit Car | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/admin.css" />
</head>
<body>

<div class="container">
  <h1 class="mb-4">Edit Car #<?= htmlspecialchars($car['id']) ?></h1>

  <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
      <?= $_SESSION['alert']['message'] ?>
    </div>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

  <form action="edit-car.php?id=<?= $car['id'] ?>" method="POST" class="row g-3">
    <div class="col-md-6">
      <label for="make" class="form-label">Make</label>
      <input type="text" name="make" id="make" class="form-control" value="<?= htmlspecialchars($car['make']) ?>" required />
    </div>
    <div class="col-md-6">
      <label for="model" class="form-label">Model</label>
      <input type="text" name="model" id="model" class="form-control" value="<?= htmlspecialchars($car['model']) ?>" required />
    </div>
    <div class="col-md-4">
      <label for="year" class="form-label">Year</label>
      <input type="number" name="year" id="year" class="form-control" value="<?= htmlspecialchars($car['year']) ?>" min="2000" max="<?= date('Y') ?>" required />
    </div>
    <div class="col-md-4">
      <label for="daily_rate" class="form-label">Daily Rate ($)</label>
      <input type="number" step="0.01" name="daily_rate" id="daily_rate" class="form-control" value="<?= htmlspecialchars($car['daily_rate']) ?>" required />
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-success">Update Car</button>
      <a href="manage-cars.php" class="btn btn-secondary">Cancel</a>
    </div>
  </form>
</div>

<script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
