<?php
session_start();
require_once '../config/db-connect.php';

if (!isset($_SESSION['admin_id'])) {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please log in as admin.'];
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $carId = (int) $_GET['id'];

    // Step 1: Get car info to check status and image
    $stmt = $pdo->prepare("SELECT status, images FROM cars WHERE id = ?");
    $stmt->execute([$carId]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($car) {
        if ($car['status'] === 'rented') {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Cannot delete a car that is currently rented.'];
        } else {
            // Step 2: Remove the car image file if it exists
            if (!empty($car['images'])) {
                $imagePath = '../carimages/' . $car['images'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Step 3: Delete car from the database
            $deleteStmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
            $deleteStmt->execute([$carId]);

            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Car deleted successfully.'];
        }
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Car not found.'];
    }
} else {
    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid car ID.'];
}

// Always redirect back to manage-cars page
header("Location: manage-cars.php");
exit();
