<div align="center">

<h1>Car Hub</h1>
<h3>Luxury Car Rental & Showroom Platform</h3>
<p>Peshawar, Pakistan</p>

<br/>

[![Live Demo](https://img.shields.io/badge/LIVE%20DEMO-Visit%20Website-c0392b?style=for-the-badge&logo=vercel&logoColor=white)](https://arsalan-khan-dev.github.io/car-hub)
[![GitHub](https://img.shields.io/badge/SOURCE-GitHub%20Repo-161b22?style=for-the-badge&logo=github&logoColor=white)](https://github.com/arsalan-khan-dev/car-hub)
[![License](https://img.shields.io/badge/LICENSE-MIT-c0392b?style=for-the-badge)](./LICENSE)

<br/>

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![Font Awesome](https://img.shields.io/badge/Font%20Awesome-528DD7?style=flat-square&logo=fontawesome&logoColor=white)
![Google Fonts](https://img.shields.io/badge/Google%20Fonts-4285F4?style=flat-square&logo=google&logoColor=white)
![Responsive](https://img.shields.io/badge/Fully%20Responsive-Yes-c0392b?style=flat-square)
![No Framework](https://img.shields.io/badge/Framework-Zero%20Dependencies-111111?style=flat-square)

<br/>

> A full-stack luxury car rental and showroom platform — PHP backend, MySQL database, Vanilla JavaScript frontend.
> Dynamic fleet management, admin dashboard, booking system. No frameworks. No shortcuts.

</div>

<br/>

---

## Table of Contents

- [Overview](#overview)
- [Live Preview](#live-preview)
- [Features](#features)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Pages Breakdown](#pages-breakdown)
- [Admin Panel](#admin-panel)
- [Tech Stack](#tech-stack)
- [JavaScript Modules](#javascript-modules)
- [CSS Architecture](#css-architecture)
- [Getting Started](#getting-started)
- [Deployment](#deployment)
- [Default Credentials](#default-credentials)
- [Author](#author)

---

## Overview

**Car Hub** is a production-grade luxury automotive platform built for a car rental and showroom business based in Peshawar, Pakistan. It delivers a complete public-facing website alongside a fully functional admin panel — powered by PHP and MySQL with zero framework dependencies.

Customers can browse a live fleet pulled directly from the database, filter by category, submit rental bookings, and send enquiries through a contact form. The admin panel gives full control over car listings, bookings, and customer messages via a secure, session-authenticated interface.

The design is bold and dark — built around high-performance automotive branding. Display typography uses **Bebas Neue**, body copy uses **Outfit**, and the palette centers on red, black, and white.

---

## Live Preview

| Platform | Link |
| --- | --- |
| GitHub Pages | [arsalan-khan-dev.github.io/car-hub](https://arsalan-khan-dev.github.io/car-hub) |
| Repository | [github.com/arsalan-khan-dev/car-hub](https://github.com/arsalan-khan-dev/car-hub) |

---

## Features

**Dynamic Fleet from MySQL**
All cars on the public fleet page are fetched live from the `cars` table. The home page shows the 4 most recently added available vehicles. The fleet page lists all active cars ordered by brand, with client-side JS filtering by category (`rental`, `showroom`, `both`).

**Online Booking System**
Customers submit rental requests from the contact page. Each booking is stored in the `bookings` table with name, email, phone, selected car, booking date, return date, and a `pending / confirmed / cancelled` status managed from the admin panel.

**Contact Form with Unread Tracking**
Contact submissions write to the `contacts` table with an `is_read` flag. The admin dashboard displays the live unread count and highlights new messages so no enquiry is ever missed.

**Secure Admin Panel**
Protected by PHP session authentication. Every admin route calls `requireAdminLogin()`, which redirects unauthenticated visitors to the login page. Passwords are stored as bcrypt hashes via `password_hash()`.

**Admin Dashboard with Live Stats**
The dashboard queries live counts of total cars, bookings, messages, and unread messages, plus summary tables showing the 5 most recent bookings and contacts.

**Full Car CRUD**
Admin can add, edit, and delete car listings. Each listing carries name, brand, price per day (PKR), description, category, availability toggle, and an uploaded image. Images are stored in `uploads/` with timestamp-prefixed filenames.

**Scroll Reveal Animations**
Elements with the `.reveal` class are observed by `IntersectionObserver`. On viewport entry they animate with a fade-up transition. Delay classes (`delay-1` through `delay-4`) produce staggered entrance sequences.

**Animated Counters**
Hero stats — 50+ Cars, 500+ Clients, 5 Years Experience — count up from zero using `requestAnimationFrame` with a cubic ease-out curve, triggered once on viewport entry.

**Image Gallery with Lightbox**
The gallery page renders car images in a responsive grid. Clicking any image opens a full-screen lightbox with previous/next navigation and full keyboard support.

**Skeleton Loading**
Car card images show an animated shimmer placeholder while loading. The skeleton is cleared on both `load` and `error` events so the UI never stalls.

**Responsive Navigation**
Fixed top navbar with hamburger menu on mobile. Gains a solid dark background after 60px of scroll. All anchor links use smooth scroll with dynamic navbar-height offset.

---

## Project Structure

```
car-hub/
│
├── index.php                  # Entry point — redirects to home.php
├── home.php                   # Hero, 4 featured cars from DB, Why Choose Us, CTA
├── cars.php                   # Full fleet from DB with JS category filter
├── services.php               # Luxury Rental, Wedding, Corporate, Showroom cards
├── gallery.php                # Responsive image grid with lightbox
├── about.php                  # Brand story, team, values
├── contact.php                # Booking form + enquiry form (both write to MySQL)
├── header.php                 # Shared navigation included in all pages
├── footer.php                 # Shared footer included in all pages
├── hashgen.php                # Utility: generates bcrypt hash for admin password setup
│
├── config.php                 # DB connection, site constants, helper functions
├── database.sql               # Full schema + sample data (6 cars, 1 admin)
│
├── style.css                  # All styles — public site + admin panel (2,224 lines)
├── script.js                  # All frontend JavaScript — 8 modules (330 lines)
│
├── admin/
│   ├── login.php              # Login form with session creation
│   ├── logout.php             # Session destroy and redirect
│   ├── dashboard.php          # Live stats, recent bookings, recent messages
│   ├── manage_cars.php        # Full car list with edit and delete actions
│   ├── add_car.php            # Add car: name, brand, price, description, image upload
│   ├── edit_car.php           # Edit existing car, option to replace image
│   ├── delete_car.php         # Deletes DB record and removes image from uploads/
│   ├── bookings.php           # All bookings with status management
│   ├── messages.php           # All contact submissions with read/unread state
│   └── includes/
│       └── sidebar.php        # Admin sidebar shared across all admin pages
│
└── uploads/                   # Car images uploaded via admin panel
    └── car_[timestamp]_[id].jpg
```

---

## Database Schema

Four tables power the entire platform:

```sql
cars
  id, car_name, brand, price (DECIMAL — PKR per day),
  description, image, category ENUM('rental','showroom','both'),
  is_available, created_at

bookings
  id, name, email, phone, car_id (FK → cars.id ON DELETE SET NULL),
  booking_date, return_date,
  status ENUM('pending','confirmed','cancelled'), created_at

contacts
  id, name, email, phone, message, is_read, created_at

admin
  id, username, password (bcrypt), created_at
```

`bookings.car_id` references `cars.id` with `ON DELETE SET NULL` — deleting a car preserves its historical booking records.

Import the full schema and sample data in one command:

```bash
mysql -u root -p < database.sql
```

This creates the `carhub` database, all four tables, the default admin account, and six sample luxury car listings (Ferrari 488, Lamborghini Huracan, Mercedes S-Class, BMW 7 Series, Audi RS7, Rolls-Royce Ghost).

---

## Pages Breakdown

| Page | File | Description |
| --- | --- | --- |
| Home | `home.php` | Hero with animated counters, 4 featured cars from DB, Why Choose Us grid, CTA strip |
| Fleet | `cars.php` | All available cars from DB, JS-powered filter by rental / showroom / both |
| Services | `services.php` | Luxury Rental, Wedding Car, Corporate, Showroom service cards with features list |
| Gallery | `gallery.php` | Responsive grid with full-screen lightbox and keyboard navigation |
| About | `about.php` | Brand story, team profiles, core values |
| Contact | `contact.php` | Rental booking form + general enquiry form, both persist to MySQL |

---

## Admin Panel

All routes under `/admin/` require an active session. Any unauthenticated request is immediately redirected to `admin/login.php` via `requireAdminLogin()`.

| Page | File | Function |
| --- | --- | --- |
| Dashboard | `dashboard.php` | Live stats (cars, bookings, messages, unread), 5 recent bookings, 5 recent contacts |
| Manage Fleet | `manage_cars.php` | Full car list with edit and delete per row |
| Add Car | `add_car.php` | Form with image upload, writes to `cars` table |
| Edit Car | `edit_car.php` | Pre-filled edit form, optional image replacement |
| Delete Car | `delete_car.php` | Removes DB record and deletes image file from `uploads/` |
| Bookings | `bookings.php` | All bookings — update status: pending / confirmed / cancelled |
| Messages | `messages.php` | All contact submissions — marks as read on open |
| Logout | `logout.php` | Destroys session, redirects to login |

---

## Tech Stack

| Layer | Technology | Purpose |
| --- | --- | --- |
| Backend | PHP 8+ | Server-side rendering, form handling, session authentication |
| Database | MySQL / MariaDB | Persistent storage — cars, bookings, contacts, admin |
| Frontend | HTML5 | Semantic page structure, ARIA accessibility attributes |
| Styling | CSS3 | Custom properties, Grid, Flexbox, keyframe animations |
| Behaviour | Vanilla JavaScript ES6+ | All interactivity, zero library dependencies |
| Icons | Font Awesome 6.5 | UI icons loaded via CDN |
| Typography | Google Fonts | Bebas Neue (display headings) + Outfit (body text) |
| File Storage | Local `uploads/` | PHP `move_uploaded_file()` with timestamp-prefixed names |

---

## JavaScript Modules

`script.js` is organized into 8 self-contained modules inside a single scope:

```
Module 1 — Scroll Reveal       IntersectionObserver fade-up on .reveal elements
Module 2 — Smooth Scroll       Anchor click handler with dynamic navbar offset
Module 3 — Gallery Lightbox    openLightbox / closeLightbox / prevImage / nextImage
Module 4 — Counter Animation   requestAnimationFrame cubic ease-out on data-target
Module 5 — Navbar Scroll       Adds .scrolled background class after 60px
Module 6 — Mobile Menu         Hamburger open/close with body scroll lock
Module 7 — Fleet Filter        Client-side filter by category (all / rental / showroom)
Module 8 — Skeleton Loading    Removes shimmer on image load or error event
```

---

## CSS Architecture

`style.css` (2,224 lines) is built on CSS Custom Properties as a single source of truth for color, spacing, and typography:

```css
:root {
  --red:        #c0392b;   /* Primary brand — performance red   */
  --red-dark:   #96281b;   /* Hover and active states           */
  --black:      #0a0a0a;   /* Page background                   */
  --dark:       #111111;   /* Card and section surfaces         */
  --dark-2:     #1a1a1a;   /* Elevated card surface             */
  --white:      #ffffff;   /* Primary text                      */
  --white-dim:  #cccccc;   /* Secondary and muted text          */
  --gold:       #f0c040;   /* Premium badge accent              */
  --border:     #2a2a2a;   /* Subtle dividers and outlines      */
}
```

The stylesheet is divided into clearly labelled sections: Reset, Custom Properties, Typography, Navbar, Hero, Cards, Fleet, Services, Gallery, Admin Panel, and Responsive Breakpoints.

---

## Getting Started

**Requirements:** PHP 8+, MySQL 5.7+ or MariaDB 10+, Apache or Nginx. XAMPP, WAMP, or Laragon recommended for local development.

```bash
# 1. Clone the repository
git clone https://github.com/arsalan-khan-dev/car-hub.git

# 2. Move into your web server root
# Windows:  copy to C:\xampp\htdocs\car-hub
# macOS:    copy to /Applications/XAMPP/xamppfiles/htdocs/car-hub

# 3. Import the database
mysql -u root -p < car-hub/database.sql

# 4. Configure credentials
# Open car-hub/config.php and update:
#   DB_USER, DB_PASS, DB_NAME, SITE_URL

# 5. Open in browser
# Public site:  http://localhost/car-hub/home.php
# Admin panel:  http://localhost/car-hub/admin/login.php
```

---

## Deployment

**Shared Hosting via cPanel**

```
1. Upload all project files to public_html/car-hub/ via File Manager or FTP
2. Create a new MySQL database in cPanel > MySQL Databases
3. Import database.sql via phpMyAdmin
4. Update config.php — set DB_USER, DB_PASS, DB_NAME, and SITE_URL to your live domain
```

**VPS / Cloud Server**

```bash
git clone https://github.com/arsalan-khan-dev/car-hub.git /var/www/html/car-hub
mysql -u root -p carhub < /var/www/html/car-hub/database.sql
# Point Apache or Nginx virtual host to /var/www/html/car-hub
```

**Push to GitHub**

```bash
echo "# car-hub" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/arsalan-khan-dev/car-hub.git
git push -u origin main
```

---

## Default Credentials

| Role | Username | Password |
| --- | --- | --- |
| Admin | `admin` | `admin123` |

The default bcrypt hash in `database.sql` maps to `admin123`. To set a new password, open `hashgen.php` in the browser after setup, generate a fresh hash, and update the `admin` table via phpMyAdmin or the MySQL CLI.

> Change the default credentials immediately after first login on any live environment.

---

<div align="center">

**Arsalan Khan**

[![GitHub](https://img.shields.io/badge/GitHub-arsalan--khan--dev-161b22?style=for-the-badge&logo=github&logoColor=white)](https://github.com/arsalan-khan-dev)

<br/>

*Built with precision. Engineered without shortcuts.*

---

<sub>© 2025 Car Hub · Peshawar, Pakistan · Built by Arsalan Khan</sub>

</div>
