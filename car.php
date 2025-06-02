<?php
require_once 'config/db-connect.php';

// Validate ID from GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: cars.php?error=Invalid+car+ID");
    exit();
}

$selectedcarId = $_GET['id'];

if ($selectedcarId > 1000) {
    header("Location: cars.php?error=Car+ID+out+of+range");
    exit();
}

$sql = "SELECT * FROM cars WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$selectedcarId]);
$selectedcar = $stmt->fetch(PDO::FETCH_ASSOC); 

if (!$selectedcar) {
    header("Location: cars.php?error=Car+not+found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Car Rental - Car Details</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    

    .container {
      background: rgba(60, 127, 172, 0.95);
      max-width: 640px;
      width: 100%;
      padding: 50px 40px;
      border-radius: 32px;
      box-shadow: 0 8px 28px rgba(0, 0, 0, 0.55);
      border: 1.5px solid rgba(255, 255, 255, 0.18);
      text-align: center;
    }

    h2 {
      font-family: 'Merriweather', serif;
      font-weight: 700;
      font-size: 3rem;
      margin-bottom: 40px;
      color: #aad4ff;
      text-shadow: 0 0 12px rgba(170, 212, 255, 0.9);
      letter-spacing: 0.03em;
    }

    .details-grid {
      display: grid;
      grid-template-columns: 35% 65%;
      row-gap: 18px;
      column-gap: 25px;
      text-align: left;
      margin-bottom: 45px;
    }

    .details-grid .value {
      font-weight: 600;
      font-size: 1.25rem;
      color: #d9e6f2;
      align-self: center;
      word-wrap: break-word;
    }

    .available {
      background-color: #3ecf8e;
      color: #0b2f1a;
      padding: 8px 20px;
      border-radius: 20px;
      display: inline-block;
      font-weight: 700;
    }

    .rented {
      background-color: #fc6868;
      color: #4d0000;
      padding: 8px 20px;
      border-radius: 20px;
      display: inline-block;
      font-weight: 700;
    }

    a.btn-primary {
      display: inline-block;
      padding: 14px 46px;
      font-weight: 700;
      font-size: 1.2rem;
      border-radius: 36px;
      background-color: #2f79d3;
      border: none;
      box-shadow: 0 8px 26px rgba(47, 121, 211, 0.75);
      color: #e6ebf1;
      text-decoration: none;
      letter-spacing: 0.05em;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
      margin-bottom: 30px;
    }

    a.btn-primary:hover {
      background-color: #1d5cb3;
      box-shadow: 0 10px 32px rgba(29, 92, 179, 0.9);
      color: #f0f6fc;
      text-decoration: none;
    }

    form {
      text-align: left;
    }

    .alert {
      margin-bottom: 20px;
    }

    @media (max-width: 600px) {
      .container {
        padding: 30px 25px;
      }
      h2 {
        font-size: 2.2rem;
        margin-bottom: 30px;
      }
      .details-grid {
        grid-template-columns: 1fr;
        text-align: left;
      }
      .details-grid .label {
        text-align: left;
        padding-right: 0;
        margin-bottom: 6px;
      }
      .details-grid .value {
        font-size: 1.1rem;
        margin-bottom: 18px;
      }
      a.btn-primary {
        padding: 12px 36px;
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Car Details</h2>

    <!-- Show success or error messages -->
    <?php if (isset($_GET['success'])): ?>
      <div class="alert alert-success"><?=($_GET['success']) ?></div>
    <?php elseif (isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?=($_GET['error']) ?></div>
    <?php endif; ?>

    <div class="details-grid">
      <div class="label">ID:</div>
      <div class="value"><?=($selectedcar['id']) ?></div>

      <div class="label">Make:</div>
      <div class="value"><?=($selectedcar['make']) ?></div>

      <div class="label">Model:</div>
      <div class="value"><?=($selectedcar['model']) ?></div>

      <div class="label">Year Created:</div>
      <div class="value"><?=($selectedcar['year']) ?></div>

      <div class="label">Daily Rate:</div>
      <div class="value">$<?= number_format($selectedcar['daily_rate'], 2) ?></div>

      <div class="label">Status:</div>
      <div class="value">
        <?php 
          $statusClass = strtolower($selectedcar['status']) === 'available' ? 'available' : 'rented';
          echo '<div class="' . $statusClass . '">' . ucfirst($selectedcar['status']) . '</div>';
        ?>
      </div>
    </div>

    <a href="cars.php" class="btn btn-primary">← Back to Car List</a>

    <h4 class="text-white mt-4">Enter Your Details To Hire Desired Car</h4>

    <form method="POST" action="processes/hire-process.php" class="mt-3 text-start">
        <input type="number" name="daily_rate" value="<?= $selectedcar['daily_rate']; ?>" hidden required class="form-select mb-3">
        <input type="date" name="return_date" required class="form-select mb-3" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime('+7 days')); ?>"> 
        <input type="text" name="first_name" required placeholder="Enter your first name" class="form-select mb-3"> 
        <input type="text" name="last_name" required placeholder="Enter your last name" class="form-select mb-3"> 
        <input type="email" name="email" required placeholder="Enter your email" class="form-select mb-3"> 
        <input type="tel" name="phone" required placeholder="Enter your phone" class="form-select mb-3">
        <input type="number" name="car_id" value="<?= $selectedcarId ?>" hidden class="form-select mb-3">
        
        <button type="submit" class="btn btn-success mt-2">Hire</button>
    </form>
  </div>

  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
