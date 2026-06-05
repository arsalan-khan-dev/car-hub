<?php
/**
 * Car Hub - Home Page
 * Features: Hero, Featured Cars, Why Choose Us, CTA
 */
require_once 'config.php';

// Fetch featured cars from database (latest 4)
$featured_query = "SELECT * FROM cars WHERE is_available = 1 ORDER BY created_at DESC LIMIT 4";
$featured_result = $conn->query($featured_query);
$featured_cars = $featured_result ? $featured_result->fetch_all(MYSQLI_ASSOC) : [];
?>
<?php include 'header.php'; ?>

<!-- ============================================
     HERO SECTION
============================================ -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div class="hero-grid"></div>

    <div class="container">
        <div class="hero-content">

            <div class="hero-badge">
                <i class="fas fa-star"></i>
                Peshawar's Premier Luxury Experience
            </div>

            <h1 class="hero-title">
                DRIVE THE
                <span>EXTRAORDINARY</span>
            </h1>

            <p class="hero-subtitle">
                Ferrari. Lamborghini. Rolls-Royce. Mercedes. Experience the world's most coveted automobiles in Peshawar.
            </p>

            <div class="hero-stats">
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-target="50" data-suffix="+">50+</div>
                    <div class="hero-stat-label">Luxury Cars</div>
                </div>
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-target="500" data-suffix="+">500+</div>
                    <div class="hero-stat-label">Happy Clients</div>
                </div>
                <div class="hero-stat-item">
                    <div class="hero-stat-num" data-target="5" data-suffix=" Yrs">5 Yrs</div>
                    <div class="hero-stat-label">Experience</div>
                </div>
            </div>

            <div class="hero-buttons">
                <a href="cars.php" class="btn btn-primary">
                    <i class="fas fa-car"></i> View Our Fleet
                </a>
                <a href="contact.php" class="btn btn-outline">
                    <i class="fas fa-calendar"></i> Book Now
                </a>
            </div>

        </div>
    </div>

    <div class="hero-scroll">
        <span>Scroll</span>
        <i class="fas fa-chevron-down"></i>
    </div>
</section>

<!-- ============================================
     FEATURED CARS SECTION
============================================ -->
<section class="featured-cars">
    <div class="container">
        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-diamond"></i> Our Fleet</span>
            <h2 class="section-title">FEATURED <span>VEHICLES</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                Hand-selected machines of extraordinary pedigree. Each vehicle in our collection represents the pinnacle of automotive engineering and luxury.
            </p>
        </div>

        <?php if (!empty($featured_cars)) : ?>
        <div class="cars-grid">
            <?php foreach ($featured_cars as $index => $car) : ?>
            <div class="car-card reveal delay-<?php echo ($index % 4) + 1; ?>">
                <div class="car-image-wrap">
                    <?php if (!empty($car['image']) && file_exists('uploads/' . $car['image'])) : ?>
                        <img src="uploads/<?php echo htmlspecialchars($car['image']); ?>" alt="<?php echo htmlspecialchars($car['car_name']); ?>">
                    <?php else : ?>
                        <div class="car-img-placeholder">
                            <i class="fas fa-car"></i>
                            <span><?php echo htmlspecialchars($car['brand']); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="car-badge"><?php echo ucfirst($car['category']); ?></div>
                </div>
                <div class="car-card-body">
                    <div class="car-brand"><?php echo htmlspecialchars($car['brand']); ?></div>
                    <h3 class="car-name"><?php echo htmlspecialchars($car['car_name']); ?></h3>
                    <p class="car-desc"><?php echo htmlspecialchars($car['description']); ?></p>
                    <div class="car-footer">
                        <div class="car-price">
                            <?php echo formatPrice($car['price']); ?>
                            <span>per day</span>
                        </div>
                        <a href="contact.php?car=<?php echo $car['id']; ?>" class="btn btn-primary btn-sm">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="no-cars">
            <i class="fas fa-car"></i>
            <p>No cars available at the moment. Please check back soon.</p>
        </div>
        <?php endif; ?>

        <div class="text-center mt-40" style="margin-top:48px; text-align:center;">
            <a href="cars.php" class="btn btn-outline">
                View Full Collection <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- ============================================
     WHY CHOOSE US SECTION
============================================ -->
<section class="why-choose">
    <div class="container">
        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-shield-alt"></i> Why Choose Us</span>
            <h2 class="section-title">THE CAR HUB <span>DIFFERENCE</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                We don't just rent cars — we curate extraordinary experiences. Every touchpoint is designed to exceed expectations.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal delay-1">
                <div class="feature-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h3 class="feature-title">LUXURY CARS</h3>
                <p class="feature-desc">
                    Access the world's finest automobiles — Ferrari, Lamborghini, Rolls-Royce, and more. Every car is meticulously maintained to showroom condition.
                </p>
            </div>

            <div class="feature-card reveal delay-2">
                <div class="feature-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="feature-title">BEST PRICING</h3>
                <p class="feature-desc">
                    Transparent, competitive rates with no hidden charges. Luxury doesn't have to mean unreasonable. We offer the best value in Peshawar.
                </p>
            </div>

            <div class="feature-card reveal delay-3">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">24/7 SUPPORT</h3>
                <p class="feature-desc">
                    Our dedicated concierge team is available around the clock. Whether it's a last-minute booking or roadside assistance, we're always here.
                </p>
            </div>

            <div class="feature-card reveal delay-4">
                <div class="feature-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="feature-title">VIP EXPERIENCE</h3>
                <p class="feature-desc">
                    From personalized delivery to bespoke itineraries, every client receives five-star treatment. This is automotive luxury redefined.
                </p>
            </div>

            <div class="feature-card reveal delay-1">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">FULLY INSURED</h3>
                <p class="feature-desc">
                    Drive with complete peace of mind. All our vehicles come with comprehensive insurance coverage for your protection.
                </p>
            </div>

            <div class="feature-card reveal delay-2">
                <div class="feature-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="feature-title">CITY DELIVERY</h3>
                <p class="feature-desc">
                    We deliver your chosen car directly to your location in Peshawar. Step outside and find your dream car waiting for you.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CTA SECTION
============================================ -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title reveal">READY TO <span class="text-red">EXPERIENCE</span> LUXURY?</h2>
        <p class="cta-sub reveal">Book your dream car today. Peshawar's finest fleet awaits.</p>
        <div class="cta-buttons reveal">
            <a href="cars.php" class="btn btn-primary">
                <i class="fas fa-car"></i> Browse Fleet
            </a>
            <a href="tel:0322323232" class="btn btn-outline">
                <i class="fas fa-phone"></i> Call 0322 323232
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
