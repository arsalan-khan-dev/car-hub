<?php
/**
 * Car Hub - Contact Page
 * Features: Contact form, PHP backend, MySQL storage
 */
require_once 'config.php';

$success = false;
$error = '';
$car_name = '';

// Pre-fill car name if coming from booking button
if (isset($_GET['car_name'])) {
    $car_name = sanitize($_GET['car_name']);
}

// ============================================
// Process Contact Form Submission
// ============================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
    
    $name    = sanitize($_POST['name'] ?? '');
    $email   = sanitize($_POST['email'] ?? '');
    $phone   = sanitize($_POST['phone'] ?? '');
    $message = sanitize($_POST['message'] ?? '');
    $car_req = sanitize($_POST['car_request'] ?? '');

    // Validation
    if (empty($name) || strlen($name) < 2) {
        $error = 'Please enter your full name.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (empty($phone) || strlen($phone) < 10) {
        $error = 'Please enter a valid phone number.';
    } elseif (empty($message) || strlen($message) < 10) {
        $error = 'Please write a message (at least 10 characters).';
    } else {
        // Insert into database
        $full_message = !empty($car_req) ? "[Car: {$car_req}] {$message}" : $message;
        
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $full_message);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = 'There was a problem sending your message. Please try again or call us directly.';
        }
        $stmt->close();
    }
}

// Process Booking Form
$booking_success = false;
$booking_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
    
    $b_name  = sanitize($_POST['b_name'] ?? '');
    $b_email = sanitize($_POST['b_email'] ?? '');
    $b_phone = sanitize($_POST['b_phone'] ?? '');
    $b_car   = (int)($_POST['car_id'] ?? 0);
    $b_date  = sanitize($_POST['booking_date'] ?? '');
    $b_return= sanitize($_POST['return_date'] ?? '');

    if (empty($b_name) || empty($b_email) || empty($b_phone) || empty($b_date)) {
        $booking_error = 'Please fill in all required fields.';
    } else {
        $stmt = $conn->prepare("INSERT INTO bookings (name, email, phone, car_id, booking_date, return_date) VALUES (?, ?, ?, ?, ?, ?)");
        $car_id_val = $b_car ?: null;
        $stmt->bind_param("sssiss", $b_name, $b_email, $b_phone, $car_id_val, $b_date, $b_return);
        
        if ($stmt->execute()) {
            $booking_success = true;
        } else {
            $booking_error = 'Booking could not be submitted. Please call us directly.';
        }
        $stmt->close();
    }
}

// Fetch cars for booking dropdown
$cars_dropdown = $conn->query("SELECT id, car_name, brand FROM cars WHERE is_available = 1 ORDER BY brand, car_name");
$dropdown_cars = $cars_dropdown ? $cars_dropdown->fetch_all(MYSQLI_ASSOC) : [];
?>
<?php include 'header.php'; ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">CONTACT <span>US</span></h1>
            <div class="breadcrumb">
                <a href="home.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>Contact</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     CONTACT SECTION
============================================ -->
<section class="contact-section">
    <div class="container">

        <div class="section-header reveal">
            <span class="section-label"><i class="fas fa-envelope"></i> Get In Touch</span>
            <h2 class="section-title">LET'S <span>CONNECT</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                Have a question, a booking request, or just want to talk cars? Our team is ready to assist you.
            </p>
        </div>

        <div class="contact-grid">

            <!-- Left: Contact Info -->
            <div class="contact-info reveal-left">

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-text">
                        <h4>Our Location</h4>
                        <p>University Road, Peshawar<br>KPK, Pakistan</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-info-text">
                        <h4>Phone Number</h4>
                        <a href="tel:0322323232">0322 323232</a>
                        <p style="margin-top:4px; font-size:0.78rem; color:var(--white-dim);">Mon–Sat: 9:00 AM – 9:00 PM</p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-text">
                        <h4>Email Address</h4>
                        <a href="mailto:info@carhub.pk">info@carhub.pk</a>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div class="contact-info-text">
                        <h4>WhatsApp</h4>
                        <a href="https://wa.me/920322323232" target="_blank">0322 323232</a>
                        <p style="margin-top:4px; font-size:0.78rem; color:var(--white-dim);">Available 24/7</p>
                    </div>
                </div>

                <!-- Social Icons -->
                <div style="margin-top:8px;">
                    <h4 style="font-family:var(--font-display);letter-spacing:2px;color:var(--white);font-size:0.9rem;margin-bottom:14px;">FOLLOW US</h4>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="contact-form-wrap reveal-right">
                
                <h3 style="font-family:var(--font-display);font-size:1.4rem;letter-spacing:2px;color:var(--white);margin-bottom:28px;">
                    SEND US A MESSAGE
                </h3>

                <?php if ($success) : ?>
                <div class="alert alert-success" id="formSuccess">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Message Sent!</strong><br>
                        <span style="font-size:0.82rem;">Thank you for contacting Car Hub. Our team will reach out within 30 minutes.</span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($error) : ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="contact.php" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="name">Full Name *</label>
                            <input type="text" id="name" name="name" class="form-control" 
                                   placeholder="Your full name" required
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" 
                                   placeholder="your@email.com" required
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-control" 
                                   placeholder="03XX XXXXXXX" required
                                   value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="car_request">Car of Interest</label>
                            <input type="text" id="car_request" name="car_request" class="form-control" 
                                   placeholder="e.g. Ferrari, Lamborghini..."
                                   value="<?php echo $car_name ?: (isset($_POST['car_request']) ? htmlspecialchars($_POST['car_request']) : ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="message">Your Message *</label>
                        <textarea id="message" name="message" class="form-control" 
                                  placeholder="Tell us about your requirements, preferred dates, special requests..." required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>

                    <button type="submit" name="submit_contact" class="btn btn-primary w-full" style="width:100%; justify-content:center;">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>

        </div>

        <!-- ============================================
             BOOKING FORM
        ============================================ -->
        <div style="margin-top: 80px;">
            <div class="section-header centered reveal">
                <span class="section-label"><i class="fas fa-calendar-check"></i> Quick Booking</span>
                <h2 class="section-title">BOOK YOUR <span>CAR</span></h2>
                <div class="divider-line"></div>
            </div>

            <div class="contact-form-wrap reveal" style="max-width:800px; margin:0 auto;">

                <?php if ($booking_success) : ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Booking Received!</strong><br>
                        <span style="font-size:0.82rem;">We'll confirm your booking within 30 minutes via phone or WhatsApp.</span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($booking_error) : ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo htmlspecialchars($booking_error); ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="contact.php">
                    <div class="admin-form-grid" style="display:grid; grid-template-columns:1fr 1fr; gap:18px;">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="b_name" class="form-control" placeholder="Your name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="b_email" class="form-control" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone *</label>
                            <input type="tel" name="b_phone" class="form-control" placeholder="03XX XXXXXXX" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Car</label>
                            <select name="car_id" class="form-control">
                                <option value="">-- Any Car --</option>
                                <?php foreach ($dropdown_cars as $c) : ?>
                                <option value="<?php echo $c['id']; ?>" 
                                    <?php echo (isset($_GET['car_id']) && (int)$_GET['car_id'] === (int)$c['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($c['brand'] . ' ' . $c['car_name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pickup Date *</label>
                            <input type="date" name="booking_date" class="form-control" 
                                   min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Return Date</label>
                            <input type="date" name="return_date" class="form-control"
                                   min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                        </div>
                    </div>
                    <button type="submit" name="submit_booking" class="btn btn-primary" style="width:100%; justify-content:center; margin-top:8px;">
                        <i class="fas fa-car"></i> Submit Booking Request
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>
