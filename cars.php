<?php 
// $cars = [
//     [
//         'id'=>1,
//         'make'=>'Lamborgini',
//         'model'=>'Urus',
//         'description'=>'Best in use',
//         'year'=>2025,
//         'daily_rate'=>5500,
//         'status'=>'Available',
//         'image'=>'assets/images/urus.jpg'
//     ],
//     [
//         'id'=>2,
//         'make'=>'Nissan',
//         'model'=>'Sentra',
//         'description'=>'Beats your imagination',
//         'year'=>2024,
//         'daily_rate'=>700,
//         'status'=>'Rented'
//     ],
//     [
//         'id'=>3,
//         'make'=>'Rolls-Royce',
//         'model'=>'Phantom',
//         'description'=>'best in the cruising',
//         'year'=>2023,
//         'daily_rate'=>4000,
//         'status'=>'Available'
//     ],
//     [
//         'id'=>4,
//         'make'=>'Lamborgini',
//         'model'=>'Hurican',
//         'description'=>'Just as the name implies, it moves like hurican',
//         'year'=>2022,
//         'daily_rate'=>6000,
//         'status'=>'Rented'
//     ],
//     [
//         'id'=>5,
//         'make'=>'Mercedes-Benz',
//         'model'=>'AMG GT 63',
//         'description'=>'just as your dream',
//         'year'=>2024,
//         'daily_rate'=>800,
//         'status'=>'Available'
//     ],
//     [
//         'id'=>6,
//         'make'=>'Ferrari',
//         'model'=>'GTB',
//         'description'=>'Just like flash',
//         'year'=>2022,
//         'daily_rate'=>5000,
//         'status'=>'Rented'
//     ],
//     [
//         'id'=>7,
//         'make'=>'Dodge',
//         'model'=>'Charger',
//         'description'=>'Lightens you with extreme speed',
//         'year'=>2023,
//         'daily_rate'=>600,
//         'status'=>'Rented'
//     ],
//     [
//         'id'=>8,
//         'make'=>'Lexus',
//         'model'=>'ES-570',
//         'description'=>'Latest model',
//         'year'=>2025,
//         'daily_rate'=>2000,
//         'status'=>'Available'
//     ],
// ]
require_once 'config/db-connect.php';

$sql = 'SELECT * FROM cars';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Car Rental Service</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/bootstrap/dist/css/bootstrap.min.css" />


  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <?php include 'components/NavBar.php'; ?>


  <div class="container">
    <h2>Car Rental</h2>
    <h4>Welcome To Michael's Car Store</h4>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Make</th>
          <th>Model</th>
          <th>Year</th>
          <th>Daily Rate</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cars as $car) { ?>
          <tr>
            <td><?php echo $car['id']; ?></td>
            <td><?php echo htmlspecialchars($car['make']); ?></td>
            <td><?php echo htmlspecialchars($car['model']); ?></td>
            <td><?php echo $car['year']; ?></td>
            <td>$<?php echo number_format($car['daily_rate'], 2); ?></td>
            <td>
              <?php if ($car['status'] === 'available') { ?>
                <div class="btn-status available"><?php echo ucfirst($car['status']); ?></div>
              <?php } else { ?>
                <div class="btn-status rented"><?php echo ucfirst($car['status']); ?></div>
              <?php } ?>
            </td>
            <td>
              <?php if ($car['status'] === 'available') { ?>
                <a href="car.php?id=<?php echo $car['id']; ?>" class="btn-action btn-primary">View Car</a>
              <?php } else { ?>
                <button class="btn-action btn-secondary" disabled>Unavailable</button>
              <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- Bootstrap JS -->
  <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
