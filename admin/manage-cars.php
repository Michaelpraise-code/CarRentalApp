<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

require_once '../config/db-connect.php';

function alert($type, $message) {
    $_SESSION['alert'] = ['type' => $type, 'message' => $message];
    header('Location: manage-cars.php');
    exit();
}

// Handle car add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = trim($_POST['make'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year = intval($_POST['year'] ?? 0);
    $daily_rate = floatval($_POST['daily_rate'] ?? 0);

    if (!$make || !$model || $year < 2000 || $daily_rate <= 0 || !isset($_FILES['carimages'])) {
        alert('danger', 'Please fill in all fields correctly.');
    }

    $imgTmp = $_FILES['carimages']['tmp_name'];
    $imgName = basename($_FILES['carimages']['name']);
    $imgType = mime_content_type($imgTmp);
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($imgType, $allowedTypes)) {
        alert('danger', 'Only JPG, PNG, or GIF images are allowed.');
    }

    $targetDir = '../carimages/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    $targetFile = $targetDir . $imgName;
    $counter = 1;
    while (file_exists($targetFile)) {
        $imgName = pathinfo($imgName, PATHINFO_FILENAME) . "_$counter." . pathinfo($imgName, PATHINFO_EXTENSION);
        $targetFile = $targetDir . $imgName;
        $counter++;
    }

    if (!move_uploaded_file($imgTmp, $targetFile)) {
        alert('danger', 'Image upload failed.');
    }

    $stmt = $pdo->prepare("INSERT INTO cars (make, model, year, daily_rate, status, images) VALUES (?, ?, ?, ?, 'available', ?)");
    if ($stmt->execute([$make, $model, $year, $daily_rate, $imgName])) {
        alert('success', 'New car added successfully.');
    } else {
        unlink($targetFile);
        alert('danger', 'Database insert failed.');
    }
}

// Fetch cars
$stmt = $pdo->prepare("SELECT * FROM cars ORDER BY id ASC");
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Cars - Admin Panel</title>
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <style>
    .car-thumb {
      width: 80px;
      height: 50px;
      object-fit: cover;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
  </style>
</head>
<body class="bg-light">
<div class="container py-5">
  <h2 class="text-center mb-4">Manage Cars</h2>

  <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
      <?= $_SESSION['alert']['message'] ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

  <div class="card mb-5 p-4">
    <h4>Add New Car</h4>
    <form action="manage-cars.php" method="POST" enctype="multipart/form-data" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Make</label>
        <input type="text" name="make" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Model</label>
        <input type="text" name="model" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Year</label>
        <input type="number" name="year" min="2000" max="<?= date('Y') ?>" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Daily Rate ($)</label>
        <input type="number" name="daily_rate" step="0.01" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Car Image</label>
        <input type="file" name="carimages" class="form-control" required>
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary w-100">Add Car</button>
      </div>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-hover bg-white">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Make</th>
          <th>Model</th>
          <th>Year</th>
          <th>Rate</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($cars)): ?>
          <tr><td colspan="8" class="text-center text-muted">No cars found.</td></tr>
        <?php else: ?>
          <?php foreach ($cars as $car): ?>
          <tr>
            <td><?= $car['id'] ?></td>
            <td>
              <?php if (!empty($car['images'])): ?>
                <img src="../carimages/<?= htmlspecialchars($car['images']) ?>" alt="Car" class="car-thumb">
              <?php else: ?>
                <span class="text-muted small">No Image</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($car['make']) ?></td>
            <td><?= htmlspecialchars($car['model']) ?></td>
            <td><?= $car['year'] ?></td>
            <td>$<?= number_format($car['daily_rate'], 2) ?></td>
            <td><?= ucfirst($car['status']) ?></td>
            <td>
              <a href="edit-car.php?id=<?= $car['id'] ?>" class="btn btn-sm btn-warning me-1">Edit</a>
              <?php if ($car['status'] === 'rented'): ?>
                <button class="btn btn-sm btn-secondary" disabled>Rented</button>
              <?php else: ?>
                <a href="delete_car.php?id=<?= $car['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this car?')">Delete</a>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<a href="dashboard.php" class="back-dashboard">← Back to Dashboard</a>
<script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
