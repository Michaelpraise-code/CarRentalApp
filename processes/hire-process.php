<?php 
session_start();
require "../config/db-connect.php";

// Collect and sanitize form data
$first_name = trim($_POST["first_name"]);
$last_name = trim($_POST["last_name"]);
$phone = trim($_POST["phone"]);
$email = trim($_POST["email"]);
$return_date = $_POST["return_date"];
$daily_rate = (float)$_POST["daily_rate"];
$rental_date = date('Y-m-d');
$car_id = (int)$_POST['car_id'];

// Store in session
$_SESSION["first_name"] = $first_name;
$_SESSION["last_name"] = $last_name;
$_SESSION["phone"] = $phone;
$_SESSION["email"] = $email;
$_SESSION["return_date"] = $return_date;

// Calculate total cost
$rental_date_object = new DateTime($rental_date);
$return_date_object = new DateTime($return_date);
$interval = $rental_date_object->diff($return_date_object);
$days = $interval->days ?: 1; // Ensure at least one day
$total_cost = $days * $daily_rate;

// Check if the customer already exists
$sql = "SELECT * FROM customers WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if ($customer) {
    // Existing customer
    $customer_id = $customer['id'];
} else {
    // New customer
    $sql = "INSERT INTO customers (first_name, last_name, phone, email) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$first_name, $last_name, $phone, $email]);

    // Get the new customer ID
    $sql = "SELECT * FROM customers WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $customer = $stmt->fetch(PDO::FETCH_ASSOC);
    $customer_id = $customer['id'];
}

// Insert rental
$sql = "INSERT INTO rental (customer_id, car_id, rental_date, return_date, total_cost) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$customer_id, $car_id, $rental_date, $return_date, $total_cost]);

// Update car status
$sql = "UPDATE cars SET status = 'rented' WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$car_id]);

// Redirect to cars page
header("Location: ../cars.php");
exit();
