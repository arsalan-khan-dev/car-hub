<?php
/**
 * Car Hub - Cars / Fleet Page
 * Displays all cars from MySQL database with filter
 */
require_once 'config.php';

// Fetch all available cars
$cars_query = "SELECT * FROM cars WHERE is_available = 1 ORDER BY brand ASC, car_name ASC";
$cars_result = $conn->query($cars_query);
$all_cars = $cars_result ? $cars_result->fetch_all(MYSQLI_ASSOC) : [];
?>
<?php include 'header.php'; ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">OUR <span>FLEET</span></h1>
            <div class="breadcrumb">
                <a href="home.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>Our Fleet</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     CARS SECTION
============================================ -->
<section class="cars-page">
    <div class="container">

        <div class="section-header reveal">
            <span class="section-label"><i class="fas fa-car-side"></i> Available Now</span>
            <h2 class="section-title">SELECT YOUR <span>MACHINE</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                Every car in our fleet is hand-picked, professionally maintained, and ready to deliver an unforgettable driving experience.
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="cars-filter reveal">
            <button class="filter-btn active" data-filter="all">All Vehicles</button>
            <button class="filter-btn" data-filter="rental">For Rental</button>
            <button class="filter-btn" data-filter="showroom">Showroom</button>
        </div>

        <!-- Cars Grid -->
        <?php if (!empty($all_cars)) : ?>
        <div class="cars-grid">
            <?php foreach ($all_cars as $index => $car) : ?>
            <div class="car-card reveal delay-<?php echo ($index % 3) + 1; ?>" 
                 data-category="<?php echo htmlspecialchars($car['category']); ?>">
                
                <div class="car-image-wrap">
                    <?php if (!empty($car['image']) && file_exists('uploads/' . $car['image'])) : ?>
                        <img src="uploads/<?php echo htmlspecialchars($car['image']); ?>" 
                             alt="<?php echo htmlspecialchars($car['car_name']); ?>"
                             loading="lazy">
                    <?php else : ?>
                        <div class="car-img-placeholder">
                            <i class="fas fa-car"></i>
                            <span><?php echo htmlspecialchars($car['brand']); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <div class="car-badge">
                        <?php 
                        $cat_labels = ['rental' => 'Rental', 'showroom' => 'For Sale', 'both' => 'Rental & Sale'];
                        echo $cat_labels[$car['category']] ?? ucfirst($car['category']);
                        ?>
                    </div>
                </div>

                <div class="car-card-body">
                    <div class="car-brand"><?php echo htmlspecialchars($car['brand']); ?></div>
                    <h3 class="car-name"><?php echo htmlspecialchars($car['car_name']); ?></h3>
                    <p class="car-desc"><?php echo htmlspecialchars($car['description']); ?></p>
                    <div class="car-footer">
                        <div class="car-price">
                            <?php echo formatPrice($car['price']); ?>
                            <span><?php echo ($car['category'] === 'showroom') ? 'total price' : 'per day'; ?></span>
                        </div>
                        <a href="contact.php?car_id=<?php echo (int)$car['id']; ?>&car_name=<?php echo urlencode($car['car_name']); ?>" 
                           class="btn btn-primary btn-sm">
                            <?php echo ($car['category'] === 'showroom') ? 'Inquire' : 'Book Now'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php else : ?>
        <div class="no-cars">
            <i class="fas fa-car"></i>
            <h3 style="font-family:var(--font-display);letter-spacing:2px;margin-bottom:8px;">No Vehicles Available</h3>
            <p>Our fleet is being updated. Please check back soon or contact us directly.</p>
            <br>
            <a href="contact.php" class="btn btn-primary">Contact Us</a>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">CAN'T FIND YOUR <span class="text-red">DREAM CAR?</span></h2>
        <p class="cta-sub">We source any vehicle on request. Talk to our specialists.</p>
        <div class="cta-buttons">
            <a href="tel:0322323232" class="btn btn-primary"><i class="fas fa-phone"></i> Call Us Now</a>
            <a href="contact.php" class="btn btn-outline"><i class="fas fa-envelope"></i> Send Enquiry</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
