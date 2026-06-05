<?php
/**
 * Car Hub - Configuration File
 * Database connection settings
 * Update credentials before deployment
 */

// ============================================
// Database Configuration
// ============================================
define('DB_HOST', 'localhost');
define('DB_USER', 'root');          // Change to your MySQL username
define('DB_PASS', '');              // Change to your MySQL password
define('DB_NAME', 'carhub');

// ============================================
// Site Configuration
// ============================================
define('SITE_NAME', 'Car Hub');
define('SITE_URL', 'http://localhost/carhub');  // Change to your domain
define('SITE_PHONE', '0322323232');
define('SITE_EMAIL', 'info@carhub.pk');
define('SITE_ADDRESS', 'University Road, Peshawar, KPK, Pakistan');

// ============================================
// Database Connection
// ============================================
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        die('<div style="background:#000;color:#ff0000;padding:20px;font-family:Arial;text-align:center;">
            <h2>Database Connection Failed</h2>
            <p>' . $conn->connect_error . '</p>
            <p>Please check your database settings in config.php</p>
        </div>');
    }
    
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    die('<div style="background:#000;color:#ff0000;padding:20px;font-family:Arial;text-align:center;">
        <h2>Connection Error</h2><p>' . $e->getMessage() . '</p>
    </div>');
}

// ============================================
// Session Start
// ============================================
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ============================================
// Helper Functions
// ============================================

/**
 * Sanitize user input
 */
function sanitize($data) {
    global $conn;
    return htmlspecialchars(strip_tags(trim($conn->real_escape_string($data))));
}

/**
 * Redirect helper
 */
function redirect($url) {
    header("Location: " . $url);
    exit();
}

/**
 * Format currency in PKR
 */
function formatPrice($price) {
    return 'PKR ' . number_format($price, 0);
}

/**
 * Check if admin is logged in
 */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']);
}

/**
 * Require admin login
 */
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        redirect('../admin/login.php');
    }
}
?>
