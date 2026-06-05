<?php
/**
 * Car Hub - Admin Login
 * Secure admin authentication
 */
require_once '../config.php';

// Redirect if already logged in
if (isAdminLoggedIn()) {
    redirect('dashboard.php');
}

$error = '';

// Process login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $admin = $result->fetch_assoc();
        $stmt->close();

        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            redirect('dashboard.php');
        } else {
            $error = 'Invalid username or password. Please try again.';
            // Rate limiting hint - in production add proper brute force protection
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Car Hub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body class="admin-body">

<div class="admin-login-page">
    <div class="admin-login-card">

        <!-- Logo -->
        <div class="logo" style="justify-content:center; margin-bottom:8px;">
            <span class="logo-icon"><i class="fas fa-car"></i></span>
            <div class="logo-text">
                <span class="logo-main">CAR HUB</span>
                <span class="logo-sub">Luxury & Performance</span>
            </div>
        </div>

        <h2>ADMIN PANEL</h2>

        <?php if ($error) : ?>
        <div class="alert alert-error" style="margin-bottom:20px;">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="form-group">
                <label class="form-label"><i class="fas fa-user"></i> Username</label>
                <input type="text" name="username" class="form-control" 
                       placeholder="Enter username" required autocomplete="username"
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
            </div>
            <div class="form-group">
                <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="passwordInput" class="form-control" 
                           placeholder="Enter password" required autocomplete="current-password"
                           style="padding-right:46px;">
                    <button type="button" onclick="togglePassword()" 
                            style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--white-dim);cursor:pointer;font-size:0.9rem;">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; margin-top:8px;">
                <i class="fas fa-sign-in-alt"></i> Login to Admin
            </button>
        </form>

        <div style="text-align:center; margin-top:24px; padding-top:20px; border-top:1px solid var(--black-border);">
            <a href="../home.php" style="color:var(--white-dim); font-size:0.82rem; display:inline-flex; align-items:center; gap:6px;">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>

        <div style="text-align:center; margin-top:16px;">
            <p style="font-size:0.72rem; color:rgba(255,255,255,0.2); letter-spacing:1px;">
                Default: admin / admin123
            </p>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('passwordInput');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</body>
</html>
