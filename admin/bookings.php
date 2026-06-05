<?php
/**
 * Car Hub - Admin Bookings
 * View and manage all car rental bookings
 */
require_once '../config.php';
requireAdminLogin();

// Update booking status
if (isset($_GET['status']) && isset($_GET['id'])) {
    $bid = (int)$_GET['id'];
    $status = sanitize($_GET['status']);
    if (in_array($status, ['pending','confirmed','cancelled'])) {
        // Use a prepared statement to safely update the booking status
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $bid);
        $stmt->execute();
    }
    redirect('bookings.php');
}

// Fetch all bookings with car info
$bookings = $conn->query("
    SELECT b.*, c.car_name, c.brand 
    FROM bookings b 
    LEFT JOIN cars c ON b.car_id = c.id 
    ORDER BY b.created_at DESC
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Car Hub Admin</title>
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
            <h1><i class="fas fa-calendar-check" style="color:var(--red);margin-right:10px;"></i> Bookings</h1>
            <span style="color:var(--white-dim); font-size:0.85rem;">Total: <?php echo count($bookings); ?></span>
        </div>
        <div class="admin-main">
            <div class="admin-card">
                <div class="admin-card-header">
                    <h3>ALL BOOKING REQUESTS</h3>
                    <input type="text" id="searchBookings" placeholder="Search..." class="form-control" style="width:200px; padding:8px 14px; font-size:0.82rem;">
                </div>
                <div style="overflow-x:auto;">
                    <table class="admin-table" id="bookingsTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Car</th>
                                <th>Pickup Date</th>
                                <th>Return Date</th>
                                <th>Submitted</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bookings)) : ?>
                            <tr><td colspan="8" style="text-align:center; padding:40px; color:var(--white-dim);">No bookings yet.</td></tr>
                            <?php else : ?>
                            <?php foreach ($bookings as $b) : ?>
                            <tr>
                                <td style="color:var(--white-dim);"><?php echo $b['id']; ?></td>
                                <td>
                                    <strong style="color:var(--white); display:block;"><?php echo htmlspecialchars($b['name']); ?></strong>
                                    <small style="color:var(--white-dim);"><?php echo htmlspecialchars($b['email']); ?></small><br>
                                    <small style="color:var(--red);"><?php echo htmlspecialchars($b['phone']); ?></small>
                                </td>
                                <td style="color:var(--white-muted);">
                                    <?php echo $b['car_name'] ? htmlspecialchars($b['brand'] . '<br>' . $b['car_name']) : '<em style="color:var(--white-dim)">No specific car</em>'; ?>
                                </td>
                                <td style="color:var(--white);"><?php echo date('M d, Y', strtotime($b['booking_date'])); ?></td>
                                <td style="color:var(--white-muted);"><?php echo $b['return_date'] ? date('M d, Y', strtotime($b['return_date'])) : '—'; ?></td>
                                <td style="font-size:0.78rem; color:var(--white-dim);"><?php echo date('M d, Y H:i', strtotime($b['created_at'])); ?></td>
                                <td>
                                    <?php
                                    $badge_map = ['pending'=>'badge-warning','confirmed'=>'badge-success','cancelled'=>'badge-danger'];
                                    $bc = $badge_map[$b['status']] ?? 'badge-info';
                                    ?>
                                    <span class="badge <?php echo $bc; ?>"><?php echo ucfirst($b['status']); ?></span>
                                </td>
                                <td>
                                    <div style="display:flex; gap:4px; flex-wrap:wrap;">
                                        <?php if ($b['status'] !== 'confirmed') : ?>
                                        <a href="bookings.php?id=<?php echo $b['id']; ?>&status=confirmed" class="action-btn btn-edit" style="font-size:0.7rem;">
                                            <i class="fas fa-check"></i> Confirm
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($b['status'] !== 'cancelled') : ?>
                                        <a href="bookings.php?id=<?php echo $b['id']; ?>&status=cancelled" class="action-btn btn-delete confirm-delete" style="font-size:0.7rem;">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                        <?php endif; ?>
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
</div>
<script src="../script.js"></script>
<script>
document.getElementById('searchBookings').addEventListener('input', function() {
    const term = this.value.toLowerCase();
    document.querySelectorAll('#bookingsTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
});
</script>
</body>
</html>
