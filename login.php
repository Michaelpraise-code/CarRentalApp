<?php
session_start();
require_once 'config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: login.php");
        exit();
    }

    $sql = "SELECT * FROM customers WHERE last_name = ? AND email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$last_name, $email]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($customer) {
        $_SESSION['customer_id'] = $customer['id'];
        $_SESSION['customer_name'] = $customer['first_name'] . ' ' . $customer['last_name'];
        header("Location: rentals.php");
        exit();
    } else {
        $_SESSION['error'] = "Login failed. Please check your last name and email.";
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Customer Login</title>
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="assets/css/login.css" />
</head>
<body style="background: linear-gradient(to right, lightblue, white);">
<div class="container py-5">
  <h2 class="text-center mb-4">Customer Login</h2>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <form action="login.php" method="POST" class="col-md-6 offset-md-3 shadow p-4 rounded bg-white">
    <div class="mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email Address</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
</div>
<script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
