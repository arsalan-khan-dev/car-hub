<?php
/**
 * Car Hub - Admin Manage Cars
 * View, edit, delete all cars in database
 */
require_once '../config.php';
requireAdminLogin();

// Handle toggle availability
if (isset($_GET['toggle']) && is_numeric($_GET['toggle'])) {
    $car_id = (int)$_GET['toggle'];
    $stmt = $conn->prepare("UPDATE cars SET is_available = NOT is_available WHERE id = ?");
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $stmt->close();
    redirect('manage_cars.php?msg=updated');
}

$success = '';
if (isset($_GET['msg'])) {
    $msgs = ['deleted' => 'Car deleted successfully.', 'updated' => 'Car updated successfully.'];
    $msg_key = sanitize($_GET['msg']);
    $success = $msgs[$msg_key] ?? '';
}

// Fetch all cars
$cars = $conn->query("SELECT * FROM cars ORDER BY brand ASC, car_name ASC")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Cars - Car Hub Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-body">
<div class="admin-layout">

    <?php include 'includes/sidebar.php'; ?>

    <div class="admin-content">
        <div class="admin-topbar">
            <h1><i class="fas fa-car" style="color:var(--red);margin-right:10px;"></i> Manage Cars</h1>
            <a href="add_car.php" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Car
            </a>
        </div>

        <div class="admin-main">

            <?php if ($success) : ?>
            <div class="alert alert-success" style="margin-bottom:20px;">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>

            <div class="admin-card">
                <div class="admin-card-header">
                    <h3>ALL VEHICLES (<?php echo count($cars); ?>)</h3>
                    <input type="text" id="searchCars" placeholder="Search cars..." 
                           class="form-control" style="width:220px; padding:8px 14px; font-size:0.82rem;">
                </div>

                <table class="admin-table" id="carsTable">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Car</th>
                            <th>Price/Day</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($cars)) : ?>
                        <tr>
                            <td colspan="7" style="text-align:center; padding:40px; color:var(--white-dim);">
                                <i class="fas fa-car" style="font-size:2rem; color:var(--red); display:block; margin-bottom:10px;"></i>
                                No cars in database. <a href="add_car.php" style="color:var(--red);">Add your first car</a>
                            </td>
                        </tr>
                        <?php else : ?>
                        <?php foreach ($cars as $car) : ?>
                        <tr>
                            <td>
                                <?php if (!empty($car['image']) && file_exists('../uploads/' . $car['image'])) : ?>
                                    <img src="../uploads/<?php echo htmlspecialchars($car['image']); ?>" 
                                         alt="<?php echo htmlspecialchars($car['car_name']); ?>">
                                <?php else : ?>
                                    <div style="width:60px;height:45px;background:var(--black-border);border-radius:3px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-car" style="color:var(--red);"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong style="color:var(--white);display:block;"><?php echo htmlspecialchars($car['car_name']); ?></strong>
                                <small style="color:var(--red);"><?php echo htmlspecialchars($car['brand']); ?></small>
                            </td>
                            <td style="color:var(--white);"><?php echo formatPrice($car['price']); ?></td>
                            <td>
                                <span class="badge badge-info"><?php echo ucfirst($car['category']); ?></span>
                            </td>
                            <td>
                                <a href="manage_cars.php?toggle=<?php echo $car['id']; ?>" 
                                   style="text-decoration:none;">
                                    <span class="badge <?php echo $car['is_available'] ? 'badge-success' : 'badge-danger'; ?>">
                                        <?php echo $car['is_available'] ? '✓ Available' : '✗ Unavailable'; ?>
                                    </span>
                                </a>
                            </td>
                            <td style="font-size:0.8rem; color:var(--white-dim);">
                                <?php echo date('M d, Y', strtotime($car['created_at'])); ?>
                            </td>
                            <td>
                                <div style="display:flex; gap:6px; flex-wrap:wrap;">
                                    <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="action-btn btn-edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="delete_car.php?id=<?php echo $car['id']; ?>" 
                                       class="action-btn btn-delete confirm-delete">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="../script.js"></script>
<script>
// Live search filter
document.getElementById('searchCars').addEventListener('input', function() {
    const term = this.value.toLowerCase();
    document.querySelectorAll('#carsTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
});
</script>
</body>
</html>
