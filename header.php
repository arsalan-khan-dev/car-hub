<?php
/**
 * Car Hub - Header Include
 * Contains: Logo, Navigation, Meta tags
 * Included on all pages via PHP include
 */

// Determine current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF']);

// ============================================
// BULLETPROOF BASE URL DETECTION
// Works regardless of folder name or server config
// ============================================
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host     = $_SERVER['HTTP_HOST'];
// __FILE__ is always the absolute path to header.php
// DOCUMENT_ROOT is the web root
// So base_path = the URL folder where header.php (= project root) lives
$root_dir  = dirname(__FILE__);                         // e.g. /var/www/html/carhubv2
$doc_root  = rtrim(realpath($_SERVER['DOCUMENT_ROOT']), DIRECTORY_SEPARATOR);
$rel_path  = str_replace($doc_root, '', realpath($root_dir));
$rel_path  = str_replace(DIRECTORY_SEPARATOR, '/', $rel_path);
$BASE_URL  = $protocol . '://' . $host . $rel_path;    // e.g. http://localhost/carhubv2
$BASE_URL  = rtrim($BASE_URL, '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Car Hub - Luxury Car Rental & Premium Car Showroom in Peshawar, Pakistan. Drive your dream car today.">
    <meta name="keywords" content="luxury car rental Peshawar, Ferrari rental Pakistan, Lamborghini, BMW, Mercedes, Car Hub">
    <title>Car Hub - Luxury Car Rental & Showroom | Peshawar</title>

    <!-- Google Fonts: Luxury Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Bebas+Neue&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Main Stylesheet: absolute URL — works from root AND from admin/ subdirectory -->
    <link rel="stylesheet" href="<?php echo $BASE_URL; ?>/style.css">
</head>
<body>

    <!-- ============================================
         HEADER / NAVIGATION
    ============================================ -->
    <header class="site-header" id="siteHeader">

        <!-- Top Bar -->
        <div class="header-topbar">
            <div class="container">
                <span><i class="fas fa-map-marker-alt"></i> University Road, Peshawar, Pakistan</span>
                <span><i class="fas fa-phone"></i> <a href="tel:0322323232">0322 323232</a></span>
            </div>
        </div>

        <!-- Main Navigation -->
        <nav class="navbar">
            <div class="container nav-container">

                <!-- Logo -->
                <a href="<?php echo $BASE_URL; ?>/home.php" class="logo">
                    <span class="logo-icon"><i class="fas fa-car"></i></span>
                    <div class="logo-text">
                        <span class="logo-main">CAR HUB</span>
                        <span class="logo-sub">Luxury & Performance</span>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <ul class="nav-menu" id="navMenu">
                    <li><a href="<?php echo $BASE_URL; ?>/home.php"     class="nav-link <?php echo ($current_page == 'home.php')     ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/about.php"    class="nav-link <?php echo ($current_page == 'about.php')    ? 'active' : ''; ?>">About</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/cars.php"     class="nav-link <?php echo ($current_page == 'cars.php')     ? 'active' : ''; ?>">Cars</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/services.php" class="nav-link <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>">Services</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/gallery.php"  class="nav-link <?php echo ($current_page == 'gallery.php')  ? 'active' : ''; ?>">Gallery</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/contact.php"  class="nav-link <?php echo ($current_page == 'contact.php')  ? 'active' : ''; ?>">Contact</a></li>
                    <li><a href="<?php echo $BASE_URL; ?>/cars.php" class="nav-btn">Book Now</a></li>
                </ul>

                <!-- Mobile Hamburger Button -->
                <button class="hamburger" id="hamburger" aria-label="Toggle Menu" aria-controls="navMenu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

            </div>
        </nav>
    </header>

    <!-- Page content starts here -->
    <main>
