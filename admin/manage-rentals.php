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
  <link rel="stylesheet" href="../assets/css/admin.css" />
</head>
<body>

<div class="container">
  <h2>Manage Rentals</h2>
  <a href="dashboard.php" class="back-dashboard">← Back to Dashboard</a>

  <?php if (isset($_SESSION['alert'])): ?>
    <div class="alert alert-<?= $_SESSION['alert']['type'] ?> alert-dismissible fade show" role="alert">
      <?= htmlspecialchars($_SESSION['alert']['message']) ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['alert']); ?>
  <?php endif; ?>

  <div class="earnings">Total Earnings: ₦<?= number_format($earnings, 2) ?></div>

  <?php if (count($rentals) === 0): ?>
    <p class="text-center fs-5">No rentals found.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th class="customer-col">Customer Name</th>
          <th class="email-col">Email</th>
          <th class="phone-col">Phone</th>
          <th class="car-col">Car</th>
          <th class="date-col">Rental Date</th>
          <th class="date-col">Return Date</th>
          <th class="cost-col">Total Cost</th>
          <th class="status-col">Status</th>
          <th class="action-col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rentals as $r): ?>
          <tr>
            <td class="customer-col" data-label="Customer">
              <?= htmlspecialchars($r['first_name'] . ' ' . $r['last_name']) ?>
            </td>
            <td class="email-col" data-label="Email">
              <?= htmlspecialchars($r['email']) ?>
            </td>
            <td class="phone-col" data-label="Phone">
              <?= htmlspecialchars($r['phone']) ?>
            </td>
            <td class="car-col" data-label="Car">
              <?= htmlspecialchars($r['make'] . ' ' . $r['model']) ?>
            </td>
            <td class="date-col" data-label="Rental Date">
              <?= date('d M Y', strtotime($r['rental_date'])) ?>
            </td>
            <td class="date-col" data-label="Return Date">
              <?= date('d M Y', strtotime($r['return_date'])) ?>
            </td>
            <td class="cost-col" data-label="Cost">$<?= number_format($r['total_cost'], 2) ?></td>
            <td class="status-col" data-label="Status">
              <?php
                $status = strtolower($r['status']);
                $badgeClass = '';
                switch ($status) {
                  case 'active':
                    $badgeClass = 'badge-active';
                    break;
                  case 'returned':
                    $badgeClass = 'badge-returned';
                    break;
                  case 'due':
                    $badgeClass = 'badge-due';
                    break;
                  default:
                    $badgeClass = 'badge-secondary';
                    break;
                }
              ?>
              <span class="badge-status <?= $badgeClass ?>" title="<?= ucfirst($status) ?>">
                <?= ucfirst($status) ?>
              </span>
            </td>
            <td class="action-col" data-label="Actions">
              <?php if ($status !== 'returned'): ?>
                <form method="POST" style="margin: 0;">
                  <input type="hidden" name="rental_id" value="<?= (int) $r['id'] ?>">
                  <input type="hidden" name="car_id" value="<?= (int) $r['car_id'] ?>">
                  <button type="submit" class="btn-returned" title="Mark as Returned">
                    Return
                  </button>
                </form>
              <?php else: ?>
                <button class="no-action-btn" disabled title="Already Returned">
                  Done
                </button>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>

<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
