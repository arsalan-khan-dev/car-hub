<?php
/**
 * Car Hub - Admin Messages
 * View contact form submissions
 */
require_once '../config.php';
requireAdminLogin();

// Mark all as read
if (isset($_GET['read_all'])) {
    $stmt = $conn->prepare("UPDATE contacts SET is_read = 1");
    $stmt->execute();
    $stmt->close();
    redirect('messages.php');
}

// Mark single as read
if (isset($_GET['read']) && is_numeric($_GET['read'])) {
    $mid = (int)$_GET['read'];
    $stmt = $conn->prepare("UPDATE contacts SET is_read = 1 WHERE id = ?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $stmt->close();
}

// Delete message
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $mid = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $stmt->close();
    redirect('messages.php?deleted=1');
}

$deleted = isset($_GET['deleted']) ? true : false;

// Fetch all messages
$messages = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);
$unread_count = $conn->query("SELECT COUNT(*) as cnt FROM contacts WHERE is_read = 0")->fetch_assoc()['cnt'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Car Hub Admin</title>
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
            <h1>
                <i class="fas fa-envelope" style="color:var(--red);margin-right:10px;"></i> Messages
                <?php if ($unread_count > 0) : ?>
                <span class="badge badge-danger" style="font-size:0.7rem; margin-left:8px;"><?php echo $unread_count; ?> New</span>
                <?php endif; ?>
            </h1>
            <?php if ($unread_count > 0) : ?>
            <a href="messages.php?read_all=1" class="btn btn-outline btn-sm" style="border-color:var(--black-border);">
                <i class="fas fa-check-double"></i> Mark All Read
            </a>
            <?php endif; ?>
        </div>
        <div class="admin-main">

            <?php if ($deleted) : ?>
            <div class="alert alert-success" style="margin-bottom:20px;">
                <i class="fas fa-trash"></i> Message deleted.
            </div>
            <?php endif; ?>

            <div class="admin-card">
                <div class="admin-card-header">
                    <h3>ALL MESSAGES (<?php echo count($messages); ?>)</h3>
                </div>

                <?php if (empty($messages)) : ?>
                <div style="text-align:center; padding:60px; color:var(--white-dim);">
                    <i class="fas fa-inbox" style="font-size:2.5rem; color:var(--red); display:block; margin-bottom:12px;"></i>
                    <p>No messages yet.</p>
                </div>
                <?php else : ?>

                <?php foreach ($messages as $msg) : ?>
                <div style="padding:24px; border-bottom:1px solid var(--black-border); 
                            background:<?php echo $msg['is_read'] ? 'transparent' : 'rgba(204,0,0,0.03)'; ?>;
                            border-left:3px solid <?php echo $msg['is_read'] ? 'transparent' : 'var(--red)'; ?>;">
                    <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px;">
                        <div style="flex:1;">
                            <div style="display:flex; align-items:center; gap:10px; margin-bottom:8px; flex-wrap:wrap;">
                                <strong style="color:var(--white); font-size:1rem;"><?php echo htmlspecialchars($msg['name']); ?></strong>
                                <?php if (!$msg['is_read']) : ?>
                                <span class="badge badge-warning">New</span>
                                <?php endif; ?>
                                <span style="color:var(--white-dim); font-size:0.78rem;">
                                    <i class="fas fa-clock" style="color:var(--red);"></i>
                                    <?php echo date('M d, Y — H:i', strtotime($msg['created_at'])); ?>
                                </span>
                            </div>
                            <div style="display:flex; gap:20px; margin-bottom:12px; flex-wrap:wrap;">
                                <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>" style="color:var(--red); font-size:0.85rem;">
                                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($msg['email']); ?>
                                </a>
                                <?php if ($msg['phone']) : ?>
                                <a href="tel:<?php echo htmlspecialchars($msg['phone']); ?>" style="color:var(--white-muted); font-size:0.85rem;">
                                    <i class="fas fa-phone"></i> <?php echo htmlspecialchars($msg['phone']); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <div style="background:rgba(255,255,255,0.03); border:1px solid var(--black-border); border-radius:4px; padding:14px 16px;">
                                <p style="color:var(--white-muted); font-size:0.88rem; line-height:1.7;">
                                    <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
                                </p>
                            </div>
                        </div>
                        <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                            <?php if (!$msg['is_read']) : ?>
                            <a href="messages.php?read=<?php echo $msg['id']; ?>" class="action-btn btn-edit">
                                <i class="fas fa-eye"></i> Mark Read
                            </a>
                            <?php endif; ?>
                            <a href="mailto:<?php echo htmlspecialchars($msg['email']); ?>" class="action-btn" 
                               style="background:rgba(0,180,100,0.1); color:#00b464; border:1px solid rgba(0,180,100,0.2);">
                                <i class="fas fa-reply"></i> Reply
                            </a>
                            <a href="messages.php?delete=<?php echo $msg['id']; ?>" class="action-btn btn-delete confirm-delete">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script src="../script.js"></script>
</body>
</html>
