<?php
/**
 * Car Hub - Admin Edit Car
 * Edit existing car details and image
 */
require_once '../config.php';
requireAdminLogin();

$car_id = (int)($_GET['id'] ?? 0);
if (!$car_id) redirect('manage_cars.php');

// Fetch car
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->bind_param("i", $car_id);
$stmt->execute();
$car = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$car) {
    redirect('manage_cars.php');
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_name    = sanitize($_POST['car_name'] ?? '');
    $brand       = sanitize($_POST['brand'] ?? '');
    $price       = floatval($_POST['price'] ?? 0);
    $description = sanitize($_POST['description'] ?? '');
    $category    = sanitize($_POST['category'] ?? 'both');
    $is_available = isset($_POST['is_available']) ? 1 : 0;
    $image_name  = $car['image'];

    if (empty($car_name) || empty($brand) || $price <= 0) {
        $error = 'Please fill in all required fields.';
    } else {
        // Handle new image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            $file_type = mime_content_type($_FILES['image']['tmp_name']);
            $file_size = $_FILES['image']['size'];

            if (!in_array($file_type, $allowed_types)) {
                $error = 'Invalid image format.';
            } elseif ($file_size > 5 * 1024 * 1024) {
                $error = 'Image too large (max 5MB).';
            } else {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $new_image = 'car_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
                
                if (move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $new_image)) {
                    // Delete old image
                    if ($car['image'] && file_exists('../uploads/' . $car['image'])) {
                        unlink('../uploads/' . $car['image']);
                    }
                    $image_name = $new_image;
                } else {
                    $error = 'Failed to upload new image.';
                }
            }
        }

        if (empty($error)) {
            $stmt = $conn->prepare("UPDATE cars SET car_name=?, brand=?, price=?, description=?, image=?, category=?, is_available=? WHERE id=?");
            $stmt->bind_param("ssdssiii", $car_name, $brand, $price, $description, $image_name, $category, $is_available, $car_id);
            
            if ($stmt->execute()) {
                $success = 'Car updated successfully!';
                // Refresh car data
                $stmt2 = $conn->prepare("SELECT * FROM cars WHERE id = ?");
                $stmt2->bind_param("i", $car_id);
                $stmt2->execute();
                $car = $stmt2->get_result()->fetch_assoc();
                $stmt2->close();
            } else {
                $error = 'Failed to update car.';
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Car - Car Hub Admin</title>
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
            <h1><i class="fas fa-edit" style="color:var(--red);margin-right:10px;"></i> Edit Car</h1>
            <a href="manage_cars.php" class="btn btn-outline btn-sm" style="border-color:var(--black-border);">
                <i class="fas fa-arrow-left"></i> Back to Cars
            </a>
        </div>
        <div class="admin-main">
            <?php if ($success) : ?>
            <div class="alert alert-success" style="margin-bottom:20px;">
                <i class="fas fa-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>
            <?php if ($error) : ?>
            <div class="alert alert-error" style="margin-bottom:20px;">
                <i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <div class="admin-form-card">
                <form method="POST" enctype="multipart/form-data">
                    <div class="admin-form-grid">
                        <div class="admin-form-group">
                            <label class="form-label">Car Model Name *</label>
                            <input type="text" name="car_name" class="form-control" required value="<?php echo htmlspecialchars($car['car_name']); ?>">
                        </div>
                        <div class="admin-form-group">
                            <label class="form-label">Brand *</label>
                            <select name="brand" class="form-control" required>
                                <?php
                                $brands = ['Ferrari','Lamborghini','Mercedes-Benz','BMW','Audi','Rolls-Royce','Bentley','Porsche','Maserati','McLaren','Bugatti','Aston Martin','Jaguar','Land Rover','Lexus','Cadillac','Other'];
                                foreach ($brands as $b):
                                ?>
                                <option value="<?php echo $b; ?>" <?php echo ($car['brand'] === $b) ? 'selected' : ''; ?>><?php echo $b; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="admin-form-group">
                            <label class="form-label">Price (PKR) *</label>
                            <input type="number" name="price" class="form-control" required value="<?php echo $car['price']; ?>" min="1">
                        </div>
                        <div class="admin-form-group">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-control">
                                <option value="both" <?php echo ($car['category'] === 'both') ? 'selected' : ''; ?>>Rental & Showroom</option>
                                <option value="rental" <?php echo ($car['category'] === 'rental') ? 'selected' : ''; ?>>Rental Only</option>
                                <option value="showroom" <?php echo ($car['category'] === 'showroom') ? 'selected' : ''; ?>>Showroom Only</option>
                            </select>
                        </div>
                        <div class="admin-form-group" style="grid-column:span 2;">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($car['description']); ?></textarea>
                        </div>
                        <div class="admin-form-group" style="grid-column:span 2;">
                            <label class="form-label">Car Image (leave empty to keep current)</label>
                            <?php if (!empty($car['image']) && file_exists('../uploads/' . $car['image'])) : ?>
                            <div style="margin-bottom:12px; display:inline-block; border:1px solid var(--black-border); padding:8px; border-radius:4px;">
                                <img src="../uploads/<?php echo htmlspecialchars($car['image']); ?>" 
                                     alt="Current" style="height:100px; border-radius:4px; display:block;">
                                <small style="color:var(--white-dim); font-size:0.72rem; margin-top:6px; display:block;">Current image</small>
                            </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control" accept="image/jpeg,image/png,image/webp" style="padding:10px;">
                        </div>
                        <div class="admin-form-group" style="grid-column:span 2;">
                            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                                <input type="checkbox" name="is_available" value="1" <?php echo $car['is_available'] ? 'checked' : ''; ?> style="width:18px; height:18px; accent-color:var(--red);">
                                <span class="form-label" style="margin-bottom:0;">Mark as Available</span>
                            </label>
                        </div>
                    </div>
                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Changes</button>
                        <a href="manage_cars.php" class="btn btn-outline" style="border-color:var(--black-border);">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../script.js"></script>
</body>
</html>
