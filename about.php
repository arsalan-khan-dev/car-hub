<?php
/**
 * Car Hub - About Page
 * Features: Company story, mission, stats, team values
 */
require_once 'config.php';
?>
<?php include 'header.php'; ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">ABOUT <span>US</span></h1>
            <div class="breadcrumb">
                <a href="home.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>About</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     ABOUT SECTION
============================================ -->
<section class="about-section">
    <div class="container">
        <div class="about-grid">

            <!-- Left: Image -->
            <div class="about-image-wrap reveal-left">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80" alt="Car Hub Showroom">
                <div class="about-image-badge">
                    <span class="num">5+</span>
                    <span class="label">Years of Excellence</span>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="about-content reveal-right">
                <span class="section-label"><i class="fas fa-info-circle"></i> Our Story</span>
                <h2 class="section-title">PESHAWAR'S FINEST <span>AUTOMOTIVE</span> EXPERIENCE</h2>
                <div class="divider-line"></div>

                <p class="section-desc">
                    Car Hub was founded with a singular vision: to bring the world's most extraordinary automobiles to the heart of Peshawar. What began as a passion for precision engineering has evolved into KPK's premier luxury automotive destination.
                </p>
                <br>
                <p class="section-desc">
                    From the raw power of a Ferrari to the silent elegance of a Rolls-Royce, we curate only the finest machines. Our showroom and rental fleet represent the pinnacle of automotive achievement — and we make them accessible to those who appreciate true excellence.
                </p>

                <ul class="about-list" style="margin-top: 28px;">
                    <li><i class="fas fa-check-circle"></i> Pakistan's most diverse luxury car fleet in KPK</li>
                    <li><i class="fas fa-check-circle"></i> Certified and professionally maintained vehicles</li>
                    <li><i class="fas fa-check-circle"></i> White-glove concierge service from booking to return</li>
                    <li><i class="fas fa-check-circle"></i> Transparent pricing with no hidden fees</li>
                    <li><i class="fas fa-check-circle"></i> Flexible rental packages — daily, weekly, monthly</li>
                    <li><i class="fas fa-check-circle"></i> Corporate & wedding specialty packages available</li>
                </ul>

                <div style="display:flex;gap:16px;margin-top:32px;flex-wrap:wrap;">
                    <a href="cars.php" class="btn btn-primary">
                        <i class="fas fa-car"></i> Our Fleet
                    </a>
                    <a href="contact.php" class="btn btn-outline">
                        <i class="fas fa-phone"></i> Contact Us
                    </a>
                </div>
            </div>

        </div>

        <!-- Stats Row -->
        <div class="stats-row reveal" style="margin-top:80px;">
            <div class="stat-block">
                <span class="num" data-target="50" data-suffix="+">50+</span>
                <div class="label">Luxury Vehicles</div>
            </div>
            <div class="stat-block">
                <span class="num" data-target="500" data-suffix="+">500+</span>
                <div class="label">Happy Clients</div>
            </div>
            <div class="stat-block">
                <span class="num" data-target="5" data-suffix=" Yrs">5 Yrs</span>
                <div class="label">In Business</div>
            </div>
            <div class="stat-block">
                <span class="num" data-target="24" data-suffix="/7">24/7</span>
                <div class="label">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     MISSION & VALUES
============================================ -->
<section style="background: var(--black-deep); padding: 100px 0;">
    <div class="container">
        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-bullseye"></i> Our Mission</span>
            <h2 class="section-title">DRIVEN BY <span>PASSION</span></h2>
            <div class="divider-line"></div>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal delay-1">
                <div class="feature-icon"><i class="fas fa-eye"></i></div>
                <h3 class="feature-title">OUR VISION</h3>
                <p class="feature-desc">
                    To be Pakistan's most trusted luxury automotive brand — setting the benchmark for excellence, innovation, and client satisfaction in the automotive experience.
                </p>
            </div>
            <div class="feature-card reveal delay-2">
                <div class="feature-icon"><i class="fas fa-heart"></i></div>
                <h3 class="feature-title">OUR PASSION</h3>
                <p class="feature-desc">
                    We are petrolheads at heart. Every car in our fleet is chosen because we would drive it ourselves. That passion for automobiles permeates everything we do.
                </p>
            </div>
            <div class="feature-card reveal delay-3">
                <div class="feature-icon"><i class="fas fa-handshake"></i></div>
                <h3 class="feature-title">OUR PROMISE</h3>
                <p class="feature-desc">
                    We promise honesty, reliability, and a service standard that rivals the world's finest hotels. Your experience with Car Hub will be extraordinary — guaranteed.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">MEET US IN <span class="text-red">PESHAWAR</span></h2>
        <p class="cta-sub">University Road, Peshawar — Pakistan's Automotive Jewel</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i> Get Directions</a>
            <a href="tel:0322323232" class="btn btn-outline"><i class="fas fa-phone"></i> 0322 323232</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
