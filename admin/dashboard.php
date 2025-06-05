<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please log in as admin.'];
    header('Location: login.php');
    exit();
}

require_once '../config/db-connect.php';

// Count summaries
$total_customers = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
$total_cars = $pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn();
$total_rentals = $pdo->query("SELECT COUNT(*) FROM rentals")->fetchColumn();
$total_rented = $pdo->query("SELECT COUNT(*) FROM cars WHERE status = 'rented'")->fetchColumn();
$total_available = $pdo->query("SELECT COUNT(*) FROM cars WHERE status = 'available'")->fetchColumn();

// Fetch latest 5 rentals
$query = "
    SELECT c.first_name, c.last_name, r.*, cars.make, cars.model, cars.daily_rate
    FROM rentals r
    JOIN customers c ON r.customer_id = c.id
    JOIN cars ON r.car_id = cars.id
    ORDER BY r.rental_date DESC LIMIT 5
";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container mt-4">
  <h1 class="mb-4">Admin Dashboard</h1>

  <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?>">
      <?= $_SESSION['alert']['message'] ?>
    </div>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card p-3 text-center bg-light">
        <h5>Total Customers</h5>
        <p class="fs-4"><?= $total_customers ?></p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 text-center bg-light">
        <h5>Total Cars</h5>
        <p class="fs-4"><?= $total_cars ?></p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 text-center bg-light">
        <h5>Total Rentals</h5>
        <p class="fs-4"><?= $total_rentals ?></p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 text-center bg-light">
        <h5>Cars Rented</h5>
        <p class="fs-4"><?= $total_rented ?></p>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card p-3 text-center bg-light">
        <h5>Cars Available</h5>
        <p class="fs-4"><?= $total_available ?></p>
      </div>
    </div>
  </div>

  <h2 class="mt-4">Recent Rentals</h2>
  <table class="table table-bordered table-striped">
    <thead class="table-primary">
      <tr>
        <th>Customer</th>
        <th>Car</th>
        <th>Daily Rate</th>
        <th>Rental Date</th>
        <th>Return Date</th>
        <th>Total Cost</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rentals as $rental): ?>
        <?php
          $status = $rental['status'];
          if ($status === 'active' && strtotime($rental['return_date']) <= time()) {
              $status = 'due for return';
          }
        ?>
        <tr>
          <td><?= htmlspecialchars($rental['first_name'] . ' ' . $rental['last_name']) ?></td>
          <td><?= htmlspecialchars($rental['make'] . ' ' . $rental['model']) ?></td>
          <td>$<?= number_format($rental['daily_rate'], 2) ?></td>
          <td><?= $rental['rental_date'] ?></td>
          <td><?= $rental['return_date'] ?></td>
          <td>$<?= number_format($rental['total_cost'], 2) ?></td>
          <td><?= $status ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <div class="mt-4 mb-5">
    <a href="manage-cars.php" class="btn btn-primary me-2">Manage Cars</a>
    <a href="manage-rentals.php" class="btn btn-primary me-2">Manage Rentals</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
</div>

</body>
</html>
