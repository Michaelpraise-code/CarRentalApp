<?php
session_start();
require_once '../config/db-connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $make = trim($_POST['make'] ?? '');
    $model = trim($_POST['model'] ?? '');
    $year = (int)($_POST['year'] ?? 0);
    $daily_rate = floatval($_POST['daily_rate'] ?? 0);

    if (!$make || !$model || $year < 2000 || $year > (int)date('Y') || $daily_rate <= 0) {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please fill all fields correctly.'];
        header('Location: manage-cars.php');
        exit();
    }

    if (isset($_FILES['carimages']) && $_FILES['carimages']['error'] === UPLOAD_ERR_OK) {
        $imgTmp = $_FILES['carimages']['tmp_name'];
        $imgName = basename($_FILES['carimages']['name']);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($imgTmp);

        if (!in_array($fileType, $allowedTypes)) {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Invalid image format. Allowed: JPG, PNG, GIF'];
            header('Location: manage-cars.php');
            exit();
        }

        $targetDir = '../carimages/';
        $targetFile = $targetDir . $imgName;

        // Avoid overwrite by renaming file if exists
        $fileExt = pathinfo($imgName, PATHINFO_EXTENSION);
        $baseName = pathinfo($imgName, PATHINFO_FILENAME);
        $counter = 1;
        while (file_exists($targetFile)) {
            $imgName = $baseName . '_' . $counter . '.' . $fileExt;
            $targetFile = $targetDir . $imgName;
            $counter++;
        }

        if (!move_uploaded_file($imgTmp, $targetFile)) {
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Failed to upload image. Check folder permissions.'];
            header('Location: manage-cars.php');
            exit();
        }

        $sql = "INSERT INTO cars (make, model, year, daily_rate, status, images) VALUES (?, ?, ?, ?, 'available', ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$make, $model, $year, $daily_rate, $imgName]);

        if ($result) {
            $_SESSION['alert'] = ['type' => 'success', 'message' => 'Car added successfully.'];
        } else {
            unlink($targetFile); // Delete file if DB insert fails
            $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Database error while adding car.'];
        }
    } else {
        $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Please upload a car image.'];
    }
    header('Location: manage-cars.php');
    exit();
} else {
    header('Location: manage-cars.php');
    exit();
}
