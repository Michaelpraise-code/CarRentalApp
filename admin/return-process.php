<?php
session_start();
require_once '../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rental_id = $_POST['rental_id'];
    $car_id = $_POST['car_id'];

    $pdo->exec("UPDATE rentals SET rental_status = 'returned' WHERE id = $rental_id");
    $pdo->exec("UPDATE cars SET status = 'available' WHERE id = $car_id");

    $_SESSION['alert'] = ['type' => 'success', 'message' => 'Rental marked as returned.'];
    header('Location: manage-rentals.php');
    exit();
}
    
    else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid request.'];
        header('Location: manage-rentals.php');
        exit();
    }
    // Redirect to login if admin_id is not set in session

    $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Unauthorized access.'];
    header('Location: login.php');
    exit();
?>
