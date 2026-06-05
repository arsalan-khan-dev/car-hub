<?php
/**
 * Car Hub - Admin Delete Car
 * Safely deletes car and its image
 */
require_once '../config.php';
requireAdminLogin();

$car_id = (int)($_GET['id'] ?? 0);
if (!$car_id) redirect('manage_cars.php');

// Fetch car image before deleting
$stmt = $conn->prepare("SELECT image FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$car = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($car) {
    // Delete image file
    if (!empty($car['image']) && file_exists('../uploads/' . $car['image'])) {
        unlink('../uploads/' . $car['image']);
    }

    // Delete from database (bookings will be set to NULL via FK constraint)
    $del = $conn->prepare("DELETE FROM cars WHERE id = ?");
    $del->bind_param("i", $car_id);
    $del->execute();
    $del->close();
}

redirect('manage_cars.php?msg=deleted');
