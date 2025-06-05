<?php
session_start();
require_once '../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email.';
        header('Location: login.php');
        exit();
    }

    if ($username === '') {
        $_SESSION['error'] = 'Username is required.';
        header('Location: login.php');
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_user'] = $admin['username'];
        header('Location: dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Invalid login credentials.';
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Login - Car Rental</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/admin-login.css" />
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body style="background: linear-gradient(to right, lightblue, white); font-family: 'Poppins', sans-serif;">
  <div style="position: absolute; top: 20px; left: 20px;">
    <a href="../index.php" class="btn btn-primary">Home</a>
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 bg-white p-4 rounded shadow">
        <h2 class="text-center text-primary mb-4">Admin Login</h2>

        <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control" required />
          </div>
          <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>