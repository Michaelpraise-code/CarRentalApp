<?php
session_start();
require_once '../config/db-connect.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'You must be logged in to access this page.'];
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'], $_POST['car_id'])) {
    $rental_id = (int) $_POST['rental_id'];
    $car_id = (int) $_POST['car_id'];

    $pdo->query("UPDATE rentals SET status = 'returned' WHERE id = $rental_id");
    $pdo->query("UPDATE cars SET status = 'available' WHERE id = $car_id");

    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Rental marked as returned.'];
    header("Location: manage-rentals.php");
    exit();
}

$query = "SELECT r.*, c.first_name, c.last_name, c.phone, c.email, cars.make, cars.model
          FROM rentals r
          JOIN customers c ON r.customer_id = c.id
          JOIN cars ON r.car_id = cars.id
          ORDER BY r.id ASC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);

$earnings = 0;
foreach ($rentals as $rental) {
    if ($rental['status'] === 'active' || $rental['status'] === 'returned') {
        $earnings += $rental['total_cost'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Rentals - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- Bootstrap CSS -->
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/admin.css" />
  <style>
    body {
      background: linear-gradient(to bottom right, lightblue, white);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      max-width: 1100px;
      margin-top: 40px;
      margin-bottom: 40px;
    }
    h2 {
      color: #0d6efd;
      font-weight: 700;
      text-align: center;
      margin-bottom: 30px;
    }
    .earnings {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 30px;
      text-align: center;
    }
    .rental-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 6px 15px rgba(0, 123, 255, 0.15);
      margin-bottom: 25px;
      padding: 20px 25px;
      transition: transform 0.2s ease;
    }
    .rental-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
    }
    .rental-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
    }
    .customer-name {
      font-size: 1.25rem;
      font-weight: 700;
      color: #0d6efd;
    }
    .badge-status {
      padding: 0.4em 0.9em;
      font-weight: 600;
      border-radius: 12px;
      font-size: 0.9rem;
      text-transform: capitalize;
      user-select: none;
    }
    .badge-active {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    .badge-returned {
      background-color: #cfe2ff;
      color: #084298;
    }
    .badge-due {
      background-color: #fff3cd;
      color: #664d03;
    }
    .rental-details {
      margin-top: 12px;
      font-size: 0.95rem;
      color: #555;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 10px 25px;
    }
    .rental-details span {
      font-weight: 600;
      color: #0d6efd;
    }
    .btn-returned {
      background-color: #198754;
      border: none;
      padding: 6px 14px;
      font-weight: 600;
      border-radius: 8px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 0.9rem;
    }
    .btn-returned:hover {
      background-color: #145c32;
    }
    .btn-returned:disabled {
      background-color: #6c757d;
      cursor: not-allowed;
    }
    .no-action-btn {
      background-color: #6c757d;
      color: white;
      border-radius: 8px;
      padding: 6px 14px;
      font-weight: 600;
      font-size: 0.9rem;
      border: none;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Manage Rentals</h2>

  <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($_SESSION['alert']['message']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

  <div class="earnings">Total Earnings: <strong>₦<?= number_format($earnings, 2) ?></strong></div>

  <?php if (count($rentals) === 0): ?>
    <p class="text-center fs-5">No rentals found.</p>
  <?php else: ?>
    <?php foreach ($rentals as $rental):
      $status = $rental['status'];
      $is_due = $status === 'active' && strtotime($rental['return_date']) <= time();
      if ($is_due) $status = 'due';

      // Status badge classes
      $badgeClass = '';
      if ($status === 'active') $badgeClass = 'badge-active';
      elseif ($status === 'returned') $badgeClass = 'badge-returned';
      elseif ($status === 'due') $badgeClass = 'badge-due';
    ?>
      <div class="rental-card">
        <div class="rental-header">
          <div class="customer-name"><?= htmlspecialchars($rental['first_name'] . ' ' . $rental['last_name']) ?></div>
          <div class="badge-status <?= $badgeClass ?>"><?= htmlspecialchars($status) ?></div>
        </div>
        <div class="rental-details">
          <div><span>Email:</span> <?= htmlspecialchars($rental['email']) ?></div>
          <div><span>Phone:</span> <?= htmlspecialchars($rental['phone']) ?></div>
          <div><span>Car:</span> <?= htmlspecialchars($rental['make'] . ' ' . $rental['model']) ?></div>
          <div><span>Rental Date:</span> <?= htmlspecialchars($rental['rental_date']) ?></div>
          <div><span>Return Date:</span> <?= htmlspecialchars($rental['return_date']) ?></div>
          <div><span>Total Cost:</span> ₦<?= number_format($rental['total_cost'], 2) ?></div>
        </div>
        <div class="mt-3 text-end">
          <?php if ($rental['status'] === 'active'): ?>
            <form method="POST" style="display:inline;">
              <input type="hidden" name="rental_id" value="<?= $rental['id'] ?>" />
              <input type="hidden" name="car_id" value="<?= $rental['car_id'] ?>" />
              <button type="submit" class="btn-returned">
                <i class="bi bi-check-lg"></i> Mark as Returned
              </button>
            </form>
          <?php else: ?>
            <button class="no-action-btn" disabled>No Action</button>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
