<?php
/**
 * Car Hub - Services Page
 * Luxury rental, wedding, corporate, showroom services
 */
require_once 'config.php';
?>
<?php include 'header.php'; ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">OUR <span>SERVICES</span></h1>
            <div class="breadcrumb">
                <a href="home.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>Services</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     SERVICES SECTION
============================================ -->
<section class="services-section">
    <div class="container">

        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-concierge-bell"></i> What We Offer</span>
            <h2 class="section-title">WORLD-CLASS <span>SERVICES</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                From daily rentals to bespoke corporate packages, we offer a complete suite of luxury automotive services tailored to your every need.
            </p>
        </div>

        <div class="services-grid">

            <!-- Luxury Car Rental -->
            <div class="service-card reveal delay-1">
                <i class="fas fa-car service-icon"></i>
                <h3 class="service-title">LUXURY CAR RENTAL</h3>
                <p class="service-desc">
                    Experience the thrill of driving Peshawar's most exclusive cars. From Ferraris to Rolls-Royces, our rental fleet delivers unparalleled performance and prestige.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Flexible daily, weekly & monthly packages</li>
                    <li><i class="fas fa-check"></i> Fully insured vehicles</li>
                    <li><i class="fas fa-check"></i> City-wide delivery & pickup</li>
                    <li><i class="fas fa-check"></i> 24/7 roadside assistance</li>
                    <li><i class="fas fa-check"></i> GPS navigation included</li>
                </ul>
                <br>
                <a href="contact.php" class="btn btn-primary btn-sm">Book a Rental</a>
            </div>

            <!-- Wedding Car Rental -->
            <div class="service-card reveal delay-2">
                <i class="fas fa-ring service-icon"></i>
                <h3 class="service-title">WEDDING CAR RENTAL</h3>
                <p class="service-desc">
                    Make your special day unforgettable. Our wedding fleet features the most elegant and stunning luxury vehicles, perfectly groomed for your ceremony.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Rolls-Royce & Bentley specialties</li>
                    <li><i class="fas fa-check"></i> Professional uniformed chauffeurs</li>
                    <li><i class="fas fa-check"></i> Floral decoration options</li>
                    <li><i class="fas fa-check"></i> Multi-vehicle wedding packages</li>
                    <li><i class="fas fa-check"></i> Full-day & multi-day packages</li>
                </ul>
                <br>
                <a href="contact.php" class="btn btn-primary btn-sm">Plan Your Wedding</a>
            </div>

            <!-- Corporate Rental -->
            <div class="service-card reveal delay-3">
                <i class="fas fa-briefcase service-icon"></i>
                <h3 class="service-title">CORPORATE RENTAL</h3>
                <p class="service-desc">
                    Elevate your business image with our executive fleet. Impress clients, reward employees, and transport VIPs in the ultimate comfort and style.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Dedicated corporate account management</li>
                    <li><i class="fas fa-check"></i> Monthly billing & invoicing</li>
                    <li><i class="fas fa-check"></i> Executive chauffeur service</li>
                    <li><i class="fas fa-check"></i> Airport transfer specialists</li>
                    <li><i class="fas fa-check"></i> Priority booking & 24/7 support</li>
                </ul>
                <br>
                <a href="contact.php" class="btn btn-primary btn-sm">Corporate Enquiry</a>
            </div>

            <!-- Car Showroom Sales -->
            <div class="service-card reveal delay-4">
                <i class="fas fa-store service-icon"></i>
                <h3 class="service-title">SHOWROOM SALES</h3>
                <p class="service-desc">
                    Ready to own your dream car? Our showroom features a curated selection of pre-owned and new luxury vehicles, all certified and guaranteed.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Certified pre-owned luxury vehicles</li>
                    <li><i class="fas fa-check"></i> Full vehicle history reports</li>
                    <li><i class="fas fa-check"></i> Financing assistance available</li>
                    <li><i class="fas fa-check"></i> Trade-in evaluations</li>
                    <li><i class="fas fa-check"></i> Post-sale support & warranty</li>
                </ul>
                <br>
                <a href="cars.php" class="btn btn-primary btn-sm">Browse Showroom</a>
            </div>

            <!-- VIP Transportation -->
            <div class="service-card reveal delay-1">
                <i class="fas fa-crown service-icon"></i>
                <h3 class="service-title">VIP TRANSPORTATION</h3>
                <p class="service-desc">
                    For dignitaries, celebrities, and high-profile executives. Our VIP service delivers the highest standard of privacy, security, and luxury travel.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Armored vehicle options</li>
                    <li><i class="fas fa-check"></i> Vetted & trained chauffeurs</li>
                    <li><i class="fas fa-check"></i> Strict privacy protocols</li>
                    <li><i class="fas fa-check"></i> Convoy coordination</li>
                    <li><i class="fas fa-check"></i> Hotel & venue coordination</li>
                </ul>
                <br>
                <a href="contact.php" class="btn btn-primary btn-sm">VIP Enquiry</a>
            </div>

            <!-- Airport Transfers -->
            <div class="service-card reveal delay-2">
                <i class="fas fa-plane-arrival service-icon"></i>
                <h3 class="service-title">AIRPORT TRANSFERS</h3>
                <p class="service-desc">
                    Arrive and depart in style. Our airport transfer service ensures you travel to and from Peshawar's Bacha Khan International Airport in absolute comfort.
                </p>
                <ul class="service-features">
                    <li><i class="fas fa-check"></i> Flight tracking & meet & greet</li>
                    <li><i class="fas fa-check"></i> Punctual & reliable service</li>
                    <li><i class="fas fa-check"></i> All hours, 365 days</li>
                    <li><i class="fas fa-check"></i> Luggage assistance</li>
                    <li><i class="fas fa-check"></i> Fixed pricing, no surge</li>
                </ul>
                <br>
                <a href="contact.php" class="btn btn-primary btn-sm">Book Transfer</a>
            </div>

        </div>
    </div>
</section>

<!-- Process Section -->
<section style="background: var(--black-deep); padding: 100px 0;">
    <div class="container">
        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-list-ol"></i> How It Works</span>
            <h2 class="section-title">THREE SIMPLE <span>STEPS</span></h2>
            <div class="divider-line"></div>
        </div>

        <div class="features-grid" style="grid-template-columns: repeat(3, 1fr);">
            <div class="feature-card reveal delay-1" style="text-align:center;">
                <div class="feature-icon" style="background:var(--red); color:var(--white); font-size:1.4rem; font-family:var(--font-display);">01</div>
                <h3 class="feature-title">CHOOSE YOUR CAR</h3>
                <p class="feature-desc">Browse our fleet and select the vehicle that matches your desire and occasion.</p>
            </div>
            <div class="feature-card reveal delay-2" style="text-align:center;">
                <div class="feature-icon" style="background:var(--red); color:var(--white); font-size:1.4rem; font-family:var(--font-display);">02</div>
                <h3 class="feature-title">BOOK & CONFIRM</h3>
                <p class="feature-desc">Fill out our booking form or call us directly. We confirm within 30 minutes.</p>
            </div>
            <div class="feature-card reveal delay-3" style="text-align:center;">
                <div class="feature-icon" style="background:var(--red); color:var(--white); font-size:1.4rem; font-family:var(--font-display);">03</div>
                <h3 class="feature-title">DRIVE & ENJOY</h3>
                <p class="feature-desc">Your car is delivered to you. Keys in hand, extraordinary experience ahead.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">READY TO GET <span class="text-red">STARTED?</span></h2>
        <p class="cta-sub">Our team is standing by to help you find the perfect automotive experience.</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary"><i class="fas fa-envelope"></i> Contact Us</a>
            <a href="tel:0322323232" class="btn btn-outline"><i class="fas fa-phone"></i> 0322 323232</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
