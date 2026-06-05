<?php
/**
 * Car Hub - Admin Sidebar Include
 * Navigation for admin panel
 */
$current_admin_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="admin-sidebar">
    <!-- Mobile toggle button (appears on small screens) -->
    <button id="adminMenuToggle" class="admin-toggle-btn" aria-label="Toggle sidebar" aria-expanded="false">
        <i class="fas fa-bars"></i>
    </button>
    <!-- Sidebar Logo -->
    <div class="admin-sidebar-logo">
        <div class="logo">
            <span class="logo-icon"><i class="fas fa-car"></i></span>
            <div class="logo-text">
                <span class="logo-main">CAR HUB</span>
                <span class="logo-sub">Admin Panel</span>
            </div>
        </div>
    </div>

    <!-- Admin Navigation -->
    <nav class="admin-nav">

        <div class="admin-nav-section">Main</div>
        <a href="dashboard.php" class="admin-nav-link <?php echo ($current_admin_page === 'dashboard.php') ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="admin-nav-section">Cars</div>
        <a href="manage_cars.php" class="admin-nav-link <?php echo ($current_admin_page === 'manage_cars.php') ? 'active' : ''; ?>">
            <i class="fas fa-car"></i> Manage Cars
        </a>
        <a href="add_car.php" class="admin-nav-link <?php echo ($current_admin_page === 'add_car.php') ? 'active' : ''; ?>">
            <i class="fas fa-plus-circle"></i> Add New Car
        </a>

        <div class="admin-nav-section">Bookings</div>
        <a href="bookings.php" class="admin-nav-link <?php echo ($current_admin_page === 'bookings.php') ? 'active' : ''; ?>">
            <i class="fas fa-calendar-check"></i> All Bookings
        </a>

        <div class="admin-nav-section">Messages</div>
        <a href="messages.php" class="admin-nav-link <?php echo ($current_admin_page === 'messages.php') ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i> Messages
            <?php
            require_once '../config.php';
            $unread = $conn->query("SELECT COUNT(*) as cnt FROM contacts WHERE is_read = 0")->fetch_assoc()['cnt'];
            if ($unread > 0) echo '<span class="badge badge-danger" style="margin-left:auto;">' . $unread . '</span>';
            ?>
        </a>

        <div class="admin-nav-section">Account</div>
        <a href="../home.php" target="_blank" class="admin-nav-link">
            <i class="fas fa-external-link-alt"></i> View Website
        </a>
        <a href="logout.php" class="admin-nav-link" style="color:var(--red);">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>

    </nav>
</aside>
