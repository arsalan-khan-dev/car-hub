<?php
/**
 * Car Hub - Footer Include
 * Contains: Business info, links, social media, copyright
 * Included on all pages via PHP include
 */

// Re-use BASE_URL if already set (from header.php), or recalculate
if (!isset($BASE_URL)) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host     = $_SERVER['HTTP_HOST'];
    $root_dir = dirname(__FILE__);
    $doc_root = rtrim(realpath($_SERVER['DOCUMENT_ROOT']), DIRECTORY_SEPARATOR);
    $rel_path = str_replace($doc_root, '', realpath($root_dir));
    $rel_path = str_replace(DIRECTORY_SEPARATOR, '/', $rel_path);
    $BASE_URL = rtrim($protocol . '://' . $host . $rel_path, '/');
}
?>

    </main>
    <!-- End of page content -->

    <!-- ============================================
         FOOTER
    ============================================ -->
    <footer class="site-footer">

        <!-- Footer Top Grid -->
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">

                    <!-- Brand Column -->
                    <div class="footer-col footer-brand">
                        <a href="<?php echo $BASE_URL; ?>/home.php" class="footer-logo">
                            <span class="logo-icon"><i class="fas fa-car"></i></span>
                            <div class="logo-text">
                                <span class="logo-main">CAR HUB</span>
                                <span class="logo-sub">Luxury & Performance</span>
                            </div>
                        </a>
                        <p class="footer-desc">Peshawar's premier luxury car rental and showroom experience. We bring the world's finest automobiles to your doorstep.</p>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-link" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo $BASE_URL; ?>/home.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/cars.php"><i class="fas fa-chevron-right"></i> Our Fleet</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/gallery.php"><i class="fas fa-chevron-right"></i> Gallery</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                        </ul>
                    </div>

                    <!-- Services -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Our Services</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Luxury Car Rental</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Wedding Car Rental</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Corporate Rental</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Car Showroom Sales</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> VIP Transportation</a></li>
                            <li><a href="<?php echo $BASE_URL; ?>/services.php"><i class="fas fa-chevron-right"></i> Airport Transfers</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="footer-col">
                        <h4 class="footer-heading">Contact Us</h4>
                        <ul class="footer-contact">
                            <li><i class="fas fa-map-marker-alt"></i><span>University Road, Peshawar, KPK, Pakistan</span></li>
                            <li><i class="fas fa-phone"></i><a href="tel:0322323232">0322 323232</a></li>
                            <li><i class="fas fa-envelope"></i><a href="mailto:info@carhub.pk">info@carhub.pk</a></li>
                            <li><i class="fas fa-clock"></i><span>Mon–Sat: 9:00 AM – 9:00 PM</span></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Bottom Bar -->
        <div class="footer-bottom">
            <div class="container footer-bottom-inner">
                <p>&copy; <?php echo date('Y'); ?> <strong>Car Hub</strong>. All Rights Reserved. Designed with <i class="fas fa-heart" style="color:#ff0000;"></i> in Peshawar</p>
                <p class="footer-credits">
                    <a href="#">Privacy Policy</a> &nbsp;|&nbsp; <a href="#">Terms of Service</a>
                </p>
            </div>
        </div>

    </footer>

    <!-- Main JavaScript: absolute URL — works from any subfolder -->
    <script src="<?php echo $BASE_URL; ?>/script.js"></script>

</body>
</html>
