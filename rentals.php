<?php
session_start();
require_once 'config/db-connect.php';

if (!isset($_SESSION['customer_id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please login to view your rentals.'];
    header('Location: login.php');
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Fetch customer info
$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$customer_id]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch rentals
$query = "SELECT r.*, c.make, c.model, c.daily_rate 
          FROM rentals r
          JOIN cars c ON r.car_id = c.id
          WHERE r.customer_id = ?
          ORDER BY r.rental_date DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$customer_id]);
$rentals = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Rentals - Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/rentals.css">
</head>
<body>
<?php include 'components/NavBar.php'; ?>

<div class="container py-5">
  <h2 class="mb-4 text-center text-dark">Welcome, <?= htmlspecialchars($customer['first_name']) ?></h2>

  <div class="card mb-4">
    <div class="card-header bg-primary text-white"><strong>Your Information</strong></div>
    <div class="card-body">
      <p><strong>Full Name:</strong> <?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($customer['email']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($customer['phone']) ?></p>
    </div>
  </div>

  <h4 class="text-dark mb-3">Rental History</h4>
  <div class="table-responsive">
    <table class="table table-bordered table-striped bg-white">
      <thead class="table-primary">
        <tr>
          <th>Car</th>
          <th>Rate/Day</th>
          <th>Rental Date</th>
          <th>Return Date</th>
          <th>Total Cost</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($rentals) > 0): ?>
          <?php foreach ($rentals as $rental): 
            $status = $rental['status']; // ✅ correct column name
            if ($status === 'active' && strtotime($rental['return_date']) <= time()) {
              $status = 'due for return';
            }
          ?>
          <tr>
            <td><?= htmlspecialchars($rental['make'] . ' ' . $rental['model']) ?></td>
            <td>$<?= number_format($rental['daily_rate'], 2) ?></td>
            <td><?= htmlspecialchars($rental['rental_date']) ?></td>
            <td><?= htmlspecialchars($rental['return_date']) ?></td>
            <td>$<?= number_format($rental['total_cost'], 2) ?></td>
            <td class="<?= $status === 'due for return' ? 'text-danger' : 'text-success' ?>"><?= ucfirst($status) ?></td>
          </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" class="text-center">No rental history found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <a href="processes/logout.php" class="btn btn-secondary mt-3">Logout</a>
</div>

<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
