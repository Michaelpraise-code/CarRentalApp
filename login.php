<?php include 'components/NavBar.php'; ?>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/login.css"> <!-- You can move the internal CSS into this file -->
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <div class="login-icon">
          <i class="fas fa-user-circle"></i>
        </div>
        <h1 class="login-title">Welcome Back</h1>
        <p class="login-subtitle">Sign in to access your account</p>
      </div>

      <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-triangle me-2"></i>
          <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
          ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn-login">
          Login
        </button>
      </form>
    </div>
  </div>
</body>
</html>
