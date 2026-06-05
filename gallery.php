<?php
/**
 * Car Hub - Gallery Page
 * Shows car images with lightbox popup
 */
require_once 'config.php';

// Fetch cars that have images for the gallery
$gallery_query = "SELECT * FROM cars WHERE image IS NOT NULL AND image != '' AND is_available = 1 ORDER BY brand ASC";
$gallery_result = $conn->query($gallery_query);
$gallery_cars = $gallery_result ? $gallery_result->fetch_all(MYSQLI_ASSOC) : [];

// Static gallery images (showcase - in production these would come from a gallery table)
$gallery_images = [
    ['src' => 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?w=800&q=80', 'title' => 'Ferrari 488'],
    ['src' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80', 'title' => 'Lamborghini Huracán'],
    ['src' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?w=800&q=80', 'title' => 'Luxury Sports Car'],
    ['src' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&q=80', 'title' => 'Premium Sedan'],
    ['src' => 'https://images.unsplash.com/photo-1471444928139-48c5bf5173f8?w=800&q=80', 'title' => 'Executive Fleet'],
    ['src' => 'https://images.unsplash.com/photo-1556189250-72ba954cfc2b?w=800&q=80', 'title' => 'Showroom'],
    ['src' => 'https://images.unsplash.com/photo-1620891549027-942fdc95d3f5?w=800&q=80', 'title' => 'Night Drive'],
    ['src' => 'https://images.unsplash.com/photo-1605559424843-9073c6e5d2c0?w=800&q=80', 'title' => 'Car Hub Collection'],
    ['src' => 'https://images.unsplash.com/photo-1568605117036-5fe5e7bab0b7?w=800&q=80', 'title' => 'BMW Series'],
];
?>
<?php include 'header.php'; ?>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1 class="page-hero-title">OUR <span>GALLERY</span></h1>
            <div class="breadcrumb">
                <a href="home.php">Home</a>
                <i class="fas fa-chevron-right"></i>
                <span>Gallery</span>
            </div>
        </div>
    </div>
</div>

<!-- ============================================
     GALLERY SECTION
============================================ -->
<section class="gallery-section">
    <div class="container">

        <div class="section-header centered reveal">
            <span class="section-label"><i class="fas fa-images"></i> Visual Stories</span>
            <h2 class="section-title">THE <span>COLLECTION</span></h2>
            <div class="divider-line"></div>
            <p class="section-desc">
                A visual celebration of automotive excellence. Every image tells a story of power, elegance, and extraordinary craftsmanship.
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid reveal">
            <?php foreach ($gallery_images as $index => $img) : ?>
            <div class="gallery-item <?php echo ($index === 0 || $index === 5) ? 'large' : ''; ?>">
                <a href="<?php echo htmlspecialchars($img['src']); ?>" class="gallery-link">
                    <img src="<?php echo htmlspecialchars($img['src']); ?>" 
                         alt="<?php echo htmlspecialchars($img['title']); ?>"
                         loading="lazy">
                    <div class="gallery-overlay">
                        <i class="fas fa-search-plus"></i>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

            <!-- Uploaded car images from database -->
            <?php foreach ($gallery_cars as $car) : ?>
                <?php if (file_exists('uploads/' . $car['image'])) : ?>
                <div class="gallery-item">
                    <a href="uploads/<?php echo htmlspecialchars($car['image']); ?>" class="gallery-link">
                        <img src="uploads/<?php echo htmlspecialchars($car['image']); ?>" 
                             alt="<?php echo htmlspecialchars($car['car_name']); ?>"
                             loading="lazy">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ============================================
     LIGHTBOX (single accessible instance below)
============================================ -->

<!-- Lightbox (accessibility attributes) -->
<div class="lightbox" id="lightbox" role="dialog" aria-label="Image viewer" aria-hidden="true" tabindex="-1">
    <button class="lightbox-close" id="lightboxClose" aria-label="Close">
        <i class="fas fa-times"></i>
    </button>
    <button class="lightbox-nav lightbox-prev" id="lightboxPrev" aria-label="Previous">
        <i class="fas fa-chevron-left"></i>
    </button>
    <img src="" alt="Gallery Image" class="lightbox-img" id="lightboxImg">
    <button class="lightbox-nav lightbox-next" id="lightboxNext" aria-label="Next">
        <i class="fas fa-chevron-right"></i>
    </button>
</div>
<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2 class="cta-title">SEE THEM <span class="text-red">IN PERSON</span></h2>
        <p class="cta-sub">Visit our showroom in Peshawar for an experience like no other.</p>
        <div class="cta-buttons">
            <a href="contact.php" class="btn btn-primary"><i class="fas fa-map-marker-alt"></i> Visit Showroom</a>
            <a href="cars.php" class="btn btn-outline"><i class="fas fa-car"></i> Browse Fleet</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
