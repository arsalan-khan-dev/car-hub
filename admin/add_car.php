<?php
/**
 * Car Hub - Admin Add Car
 * Upload new car to database with image
 */
require_once '../config.php';
requireAdminLogin();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $car_name    = sanitize($_POST['car_name'] ?? '');
    $brand       = sanitize($_POST['brand'] ?? '');
    $price       = floatval($_POST['price'] ?? 0);
    $description = sanitize($_POST['description'] ?? '');
    $category    = sanitize($_POST['category'] ?? 'both');
    $is_available = isset($_POST['is_available']) ? 1 : 0;
    
    $image_name = '';

    // Validation
    if (empty($car_name) || empty($brand) || $price <= 0) {
        $error = 'Please fill in all required fields with valid values.';
    } else {
        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            $file_type = mime_content_type($_FILES['image']['tmp_name']);
            $file_size = $_FILES['image']['size'];

            if (!in_array($file_type, $allowed_types)) {
                $error = 'Invalid image format. Please upload JPG, PNG, or WebP.';
            } elseif ($file_size > 5 * 1024 * 1024) {
                $error = 'Image too large. Maximum size is 5MB.';
            } else {
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $image_name = 'car_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
                $upload_path = '../uploads/' . $image_name;

                if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                    $error = 'Failed to upload image. Check uploads/ directory permissions (chmod 755).';
                    $image_name = '';
                }
            }
        }

        // Insert into database if no errors
        if (empty($error)) {
            $stmt = $conn->prepare("INSERT INTO cars (car_name, brand, price, description, image, category, is_available) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdsssi", $car_name, $brand, $price, $description, $image_name, $category, $is_available);

            if ($stmt->execute()) {
                $success = 'Car "' . htmlspecialchars($car_name) . '" added successfully!';
            } else {
                $error = 'Database error: Could not save car. ' . $conn->error;
                // Delete uploaded image if DB fails
                if ($image_name && file_exists('../uploads/' . $image_name)) {
                    unlink('../uploads/' . $image_name);
                }
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
    <title>Add Car - Car Hub Admin</title>
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
            <h1><i class="fas fa-plus-circle" style="color:var(--red);margin-right:10px;"></i> Add New Car</h1>
            <a href="manage_cars.php" class="btn btn-outline btn-sm" style="border-color:var(--black-border);">
                <i class="fas fa-list"></i> All Cars
            </a>
        </div>

        <div class="admin-main">

            <?php if ($success) : ?>
            <div class="alert alert-success" style="margin-bottom:24px;">
                <i class="fas fa-check-circle"></i>
                <?php echo $success; ?>
                <a href="manage_cars.php" style="color:inherit; margin-left:8px; text-decoration:underline;">View all cars</a>
            </div>
            <?php endif; ?>

            <?php if ($error) : ?>
            <div class="alert alert-error" style="margin-bottom:24px;">
                <i class="fas fa-exclamation-circle"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
            <?php endif; ?>

            <div class="admin-form-card">
                <form method="POST" action="add_car.php" enctype="multipart/form-data">

                    <div class="admin-form-grid">

                        <!-- Car Name -->
                        <div class="admin-form-group">
                            <label class="form-label">Car Model Name *</label>
                            <input type="text" name="car_name" class="form-control" 
                                   placeholder="e.g. 488 GTB" required
                                   value="<?php echo isset($_POST['car_name']) ? htmlspecialchars($_POST['car_name']) : ''; ?>">
                        </div>

                        <!-- Brand -->
                        <div class="admin-form-group">
                            <label class="form-label">Brand *</label>
                            <select name="brand" class="form-control" required>
                                <option value="">-- Select Brand --</option>
                                <?php
                                $brands = ['Ferrari','Lamborghini','Mercedes-Benz','BMW','Audi','Rolls-Royce','Bentley','Porsche','Maserati','McLaren','Bugatti','Aston Martin','Jaguar','Land Rover','Lexus','Cadillac','Other'];
                                foreach ($brands as $b):
                                    $selected = (isset($_POST['brand']) && $_POST['brand'] === $b) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $b; ?>" <?php echo $selected; ?>><?php echo $b; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="admin-form-group">
                            <label class="form-label">Price (PKR) *</label>
                            <input type="number" name="price" class="form-control" 
                                   placeholder="e.g. 85000" min="1" step="1" required
                                   value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
                        </div>

                        <!-- Category -->
                        <div class="admin-form-group">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-control">
                                <option value="both" <?php echo (isset($_POST['category']) && $_POST['category'] === 'both') ? 'selected' : ''; ?>>Rental & Showroom</option>
                                <option value="rental" <?php echo (isset($_POST['category']) && $_POST['category'] === 'rental') ? 'selected' : ''; ?>>Rental Only</option>
                                <option value="showroom" <?php echo (isset($_POST['category']) && $_POST['category'] === 'showroom') ? 'selected' : ''; ?>>Showroom Only</option>
                            </select>
                        </div>

                        <!-- Description -->
                        <div class="admin-form-group admin-form-group-full" style="grid-column: span 2;">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="4" 
                                      placeholder="Describe the car — engine, performance, features, experience..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="admin-form-group admin-form-group-full" style="grid-column: span 2;">
                            <label class="form-label">Car Image</label>
                            <div style="border:2px dashed var(--black-border); border-radius:6px; padding:32px; text-align:center; cursor:pointer; transition:var(--transition);" 
                                 id="dropZone"
                                 onclick="document.getElementById('imageInput').click();">
                                <i class="fas fa-cloud-upload-alt" style="font-size:2rem; color:var(--red); margin-bottom:10px; display:block;"></i>
                                <p style="color:var(--white-muted); font-size:0.9rem;">Click to upload image or drag & drop</p>
                                <p style="color:var(--white-dim); font-size:0.78rem; margin-top:4px;">JPG, PNG, WebP — Max 5MB</p>
                                <div id="imagePreview" style="margin-top:16px; display:none;">
                                    <img id="previewImg" src="" alt="Preview" style="max-height:200px; border-radius:6px; display:inline-block;">
                                    <p id="previewName" style="color:var(--white-muted); font-size:0.8rem; margin-top:8px;"></p>
                                </div>
                            </div>
                            <input type="file" id="imageInput" name="image" accept="image/jpeg,image/png,image/webp" style="display:none;">
                        </div>

                        <!-- Availability -->
                        <div class="admin-form-group" style="grid-column: span 2;">
                            <label style="display:flex; align-items:center; gap:10px; cursor:pointer;">
                                <input type="checkbox" name="is_available" value="1" 
                                       <?php echo (!isset($_POST['submit']) || isset($_POST['is_available'])) ? 'checked' : ''; ?>
                                       style="width:18px; height:18px; accent-color:var(--red);">
                                <span class="form-label" style="margin-bottom:0;">Mark as Available</span>
                            </label>
                        </div>

                    </div>

                    <div style="display:flex; gap:12px; margin-top:8px;">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Car to Fleet
                        </button>
                        <a href="manage_cars.php" class="btn btn-outline" style="border-color:var(--black-border);">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Image preview on file select
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
            document.getElementById('previewImg').src = evt.target.result;
            document.getElementById('previewName').textContent = file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + 'MB)';
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

// Drag and drop
const dropZone = document.getElementById('dropZone');
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--red)';
    dropZone.style.background = 'rgba(204,0,0,0.05)';
});
dropZone.addEventListener('dragleave', () => {
    dropZone.style.borderColor = 'var(--black-border)';
    dropZone.style.background = '';
});
dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.style.borderColor = 'var(--black-border)';
    dropZone.style.background = '';
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        document.getElementById('imageInput').files = files;
        document.getElementById('imageInput').dispatchEvent(new Event('change'));
    }
});
</script>
</body>
</html>
