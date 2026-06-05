<?php
/**
 * Car Hub - Admin Dashboard
 * Overview: stats, recent bookings, recent contacts
 */
require_once '../config.php';
requireAdminLogin();

// Fetch dashboard statistics
$stats = [];
$stats['cars']     = $conn->query("SELECT COUNT(*) as cnt FROM cars")->fetch_assoc()['cnt'];
$stats['bookings'] = $conn->query("SELECT COUNT(*) as cnt FROM bookings")->fetch_assoc()['cnt'];
$stats['contacts'] = $conn->query("SELECT COUNT(*) as cnt FROM contacts")->fetch_assoc()['cnt'];
$stats['unread']   = $conn->query("SELECT COUNT(*) as cnt FROM contacts WHERE is_read = 0")->fetch_assoc()['cnt'];

// Recent Bookings (5)
$recent_bookings = $conn->query("
    SELECT b.*, c.car_name, c.brand 
    FROM bookings b 
    LEFT JOIN cars c ON b.car_id = c.id 
    ORDER BY b.created_at DESC 
    LIMIT 5
")->fetch_all(MYSQLI_ASSOC);

// Recent Contacts (5)
$recent_contacts = $conn->query("
    SELECT * FROM contacts ORDER BY created_at DESC LIMIT 5
")->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Car Hub Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-body">

<div class="admin-layout">

    <!-- ============================================
         SIDEBAR
    ============================================ -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- ============================================
         MAIN CONTENT
    ============================================ -->
    <div class="admin-content">

        <!-- Top Bar -->
        <div class="admin-topbar">
            <h1><i class="fas fa-tachometer-alt" style="color:var(--red);margin-right:10px;"></i> Dashboard</h1>
            <div style="display:flex;align-items:center;gap:16px;">
                <span style="color:var(--white-dim);font-size:0.85rem;">
                    Welcome, <strong style="color:var(--white);"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong>
                </span>
                <a href="logout.php" class="btn btn-primary btn-sm" style="font-size:0.75rem; padding:8px 16px;">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <div class="admin-main">

            <!-- Stats Cards -->
            <div class="admin-stats-grid">
                <div class="admin-stat-card">
                    <div class="admin-stat-icon"><i class="fas fa-car"></i></div>
                    <div>
                        <div class="admin-stat-num"><?php echo $stats['cars']; ?></div>
                        <div class="admin-stat-label">Total Cars</div>
                    </div>
                </div>
                <div class="admin-stat-card">
                    <div class="admin-stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <div>
                        <div class="admin-stat-num"><?php echo $stats['bookings']; ?></div>
                        <div class="admin-stat-label">Bookings</div>
                    </div>
                </div>
                <div class="admin-stat-card">
                    <div class="admin-stat-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <div class="admin-stat-num"><?php echo $stats['contacts']; ?></div>
                        <div class="admin-stat-label">Messages</div>
                    </div>
                </div>
                <div class="admin-stat-card">
                    <div class="admin-stat-icon" style="background:rgba(255,165,0,0.1); color:orange;">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div>
                        <div class="admin-stat-num" style="color:orange;"><?php echo $stats['unread']; ?></div>
                        <div class="admin-stat-label">Unread Messages</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="admin-card" style="margin-bottom:28px;">
                <div class="admin-card-header">
                    <h3>QUICK ACTIONS</h3>
                </div>
                <div style="padding:20px; display:flex; gap:12px; flex-wrap:wrap;">
                    <a href="add_car.php" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Add New Car</a>
                    <a href="manage_cars.php" class="btn btn-outline btn-sm" style="border-color:var(--black-border);"><i class="fas fa-car"></i> Manage Cars</a>
                    <a href="bookings.php" class="btn btn-outline btn-sm" style="border-color:var(--black-border);"><i class="fas fa-calendar"></i> View Bookings</a>
                    <a href="messages.php" class="btn btn-outline btn-sm" style="border-color:var(--black-border);">
                        <i class="fas fa-envelope"></i> Messages
                        <?php if ($stats['unread'] > 0): ?>
                        <span class="badge badge-danger" style="margin-left:4px;"><?php echo $stats['unread']; ?></span>
                        <?php endif; ?>
                    </a>
                    <a href="../home.php" target="_blank" class="btn btn-outline btn-sm" style="border-color:var(--black-border);"><i class="fas fa-external-link-alt"></i> View Website</a>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

                <!-- Recent Bookings -->
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h3>RECENT BOOKINGS</h3>
                        <a href="bookings.php" style="font-size:0.78rem; color:var(--red);">View All</a>
                    </div>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Car</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_bookings)) : ?>
                            <tr><td colspan="4" style="text-align:center; color:var(--white-dim); padding:30px;">No bookings yet</td></tr>
                            <?php else : ?>
                            <?php foreach ($recent_bookings as $b) : ?>
                            <tr>
                                <td>
                                    <strong style="color:var(--white);"><?php echo htmlspecialchars($b['name']); ?></strong>
                                    <br><small style="color:var(--white-dim);"><?php echo htmlspecialchars($b['phone']); ?></small>
                                </td>
                                <td><?php echo $b['car_name'] ? htmlspecialchars($b['brand'] . ' ' . $b['car_name']) : '<em style="color:var(--white-dim)">Any</em>'; ?></td>
                                <td><?php echo date('M d', strtotime($b['booking_date'])); ?></td>
                                <td>
                                    <?php
                                    $badge_map = ['pending'=>'badge-warning','confirmed'=>'badge-success','cancelled'=>'badge-danger'];
                                    $bc = $badge_map[$b['status']] ?? 'badge-info';
                                    ?>
                                    <span class="badge <?php echo $bc; ?>"><?php echo ucfirst($b['status']); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Recent Messages -->
                <div class="admin-card">
                    <div class="admin-card-header">
                        <h3>RECENT MESSAGES</h3>
                        <a href="messages.php" style="font-size:0.78rem; color:var(--red);">View All</a>
                    </div>
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_contacts)) : ?>
                            <tr><td colspan="4" style="text-align:center; color:var(--white-dim); padding:30px;">No messages yet</td></tr>
                            <?php else : ?>
                            <?php foreach ($recent_contacts as $c) : ?>
                            <tr>
                                <td>
                                    <strong style="color:<?php echo $c['is_read'] ? 'var(--white-muted)' : 'var(--white)'; ?>;">
                                        <?php echo htmlspecialchars($c['name']); ?>
                                    </strong>
                                </td>
                                <td style="font-size:0.8rem;"><?php echo htmlspecialchars($c['email']); ?></td>
                                <td><?php echo date('M d', strtotime($c['created_at'])); ?></td>
                                <td>
                                    <span class="badge <?php echo $c['is_read'] ? 'badge-info' : 'badge-warning'; ?>">
                                        <?php echo $c['is_read'] ? 'Read' : 'New'; ?>
                                    </span>
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
</body>
</html>
