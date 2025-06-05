<?php
session_start();
require_once '../config/db-connect.php';

$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $_SESSION['login_error'] = "Invalid email format.";
  header("Location: ../login.php");
  exit();
}

$sql = "SELECT * FROM customers WHERE last_name = ? AND email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$last_name, $email]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

if ($customer) {
  $_SESSION['customer_id'] = $customer['id'];
  $_SESSION['customer_name'] = $customer['first_name'] . ' ' . $customer['last_name'];
  $_SESSION['success'] = "Welcome back, " . htmlspecialchars($customer['first_name']) . "!";
  header("Location: ../myrentals.php");
} else {
  $_SESSION['login_error'] = "Login failed. Customer not found.";
  header("Location: ../login.php");
}
