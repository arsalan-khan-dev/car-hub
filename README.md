<div align="center">

<br/>

```
 ██████╗ █████╗ ██████╗     ██╗  ██╗██╗   ██╗██████╗ 
██╔════╝██╔══██╗██╔══██╗    ██║  ██║██║   ██║██╔══██╗
██║     ███████║██████╔╝    ███████║██║   ██║██████╔╝
██║     ██╔══██║██╔══██╗    ██╔══██║██║   ██║██╔══██╗
╚██████╗██║  ██║██║  ██║    ██║  ██║╚██████╔╝██████╔╝
 ╚═════╝╚═╝  ╚═╝╚═╝  ╚═╝    ╚═╝  ╚═╝ ╚═════╝ ╚═════╝ 
          L U X U R Y   A U T O M O T I V E   P L A T F O R M
```

<br/>

[![Live Demo](https://img.shields.io/badge/LIVE%20DEMO-View%20Website-0d1117?style=for-the-badge&logo=vercel&logoColor=white&labelColor=c0392b)](https://arsalan-khan-dev.github.io/car-hub)
[![GitHub Repo](https://img.shields.io/badge/GitHub-car--hub-0d1117?style=for-the-badge&logo=github&logoColor=white&labelColor=161b22)](https://github.com/arsalan-khan-dev/car-hub)
[![License](https://img.shields.io/badge/LICENSE-MIT-0d1117?style=for-the-badge&logoColor=white&labelColor=c0392b)](./LICENSE)

<br/>

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![Font Awesome](https://img.shields.io/badge/Font%20Awesome-528DD7?style=flat-square&logo=fontawesome&logoColor=white)
![Google Fonts](https://img.shields.io/badge/Google%20Fonts-4285F4?style=flat-square&logo=google&logoColor=white)
![Responsive](https://img.shields.io/badge/Responsive-100%25-c0392b?style=flat-square)

<br/>

> **A full-stack luxury car rental and showroom platform built with PHP, MySQL, and Vanilla JavaScript.**  
> Dynamic fleet management, admin dashboard, booking system — zero frameworks.

<br/>

---

</div>

<br/>

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

<br/>

---

## Overview

**Car Hub** is a production-grade luxury automotive platform built for a car rental and showroom business based in **Peshawar, Pakistan**. It provides a complete public-facing website alongside a fully functional **admin panel** — all powered by **PHP and MySQL** with no framework dependencies.

The platform enables customers to browse a live fleet sourced from a database, filter by category, submit rental bookings, and send enquiries via a contact form. The admin panel provides full control over car listings, bookings, and customer messages through a secure, session-authenticated interface.

The design language is bold and dark — inspired by high-performance automotive branding. Typography uses **Bebas Neue** for display and **Outfit** for body text, paired with a red, black, and white palette.

<br/>

---

## Live Preview

<div align="center">

| Platform | Link |
|---|---|
| GitHub Pages | [arsalan-khan-dev.github.io/car-hub](https://arsalan-khan-dev.github.io/car-hub) |
| Repository | [github.com/arsalan-khan-dev/car-hub](https://github.com/arsalan-khan-dev/car-hub) |

</div>

<br/>

---

## Features

<br/>

**Dynamic Fleet from MySQL**  
All cars on the public fleet page are fetched live from the `cars` table. The home page displays the 4 most recently added available vehicles. The fleet page lists all active cars ordered by brand. Filtering between `rental`, `showroom`, and `both` categories is handled client-side in JavaScript.

**Online Booking System**  
Customers can submit rental booking requests from the contact page. Bookings are stored in the `bookings` table with name, email, phone, selected car, booking date, return date, and a `pending` / `confirmed` / `cancelled` status managed by the admin.

**Contact Form with Unread Tracking**  
The contact page sends messages to the `contacts` table. Each message carries an `is_read` flag. The admin dashboard shows unread message count and highlights new messages, ensuring no enquiry is missed.

**Secure Admin Panel**  
Protected by PHP session authentication (`$_SESSION['admin_id']`). Every admin route calls `requireAdminLogin()` which redirects unauthenticated users to the login page. Passwords are stored as bcrypt hashes using `password_hash()`.

**Admin Dashboard with Live Stats**  
The dashboard queries live counts of total cars, total bookings, total messages, and unread messages. It also displays the 5 most recent bookings and 5 most recent contact submissions in summary tables.

**Full Car CRUD**  
Admin can add new cars with name, brand, price per day (PKR), description, category, availability toggle, and image upload. Existing listings can be edited or deleted. Uploaded images are stored in the `uploads/` directory with timestamp-prefixed filenames.

**Scroll Reveal Animations**  
Elements tagged `.reveal` are observed by `IntersectionObserver`. On viewport entry, they animate with a fade-up transition. Delay classes (`delay-1` through `delay-4`) create staggered entrance sequences.

**Animated Counters**  
Hero section stats (50+ cars, 500+ clients, 5 years experience) count up from zero using `requestAnimationFrame` with an ease-out curve triggered by `IntersectionObserver`.

**Image Gallery with Lightbox**  
The gallery page displays car images in a responsive grid. Clicking any image opens a full-screen lightbox with previous/next navigation and keyboard support.

**Skeleton Loading**  
Car card images show a shimmer placeholder while loading. The skeleton class is removed on both `load` and `error` events so the UI never hangs.

**Responsive Navigation**  
Fixed top navbar with hamburger menu on mobile. Gains a solid dark background on scroll. All anchor links use smooth scroll with navbar height offset.

<br/>

---

## Project Structure

```
car-hub/
│
├── index.php                  # Entry point — redirects to home.php
├── home.php                   # Home page: Hero, Featured Cars, Why Choose Us, CTA
├── cars.php                   # Fleet page: all cars from DB with JS filter
├── services.php               # Services: Rental, Wedding, Corporate, Showroom
├── gallery.php                # Image gallery with lightbox
├── about.php                  # About page: story, team, values
├── contact.php                # Contact form + booking form (writes to DB)
├── header.php                 # Shared navigation header (included in all pages)
├── footer.php                 # Shared footer (included in all pages)
├── hashgen.php                # Utility: bcrypt hash generator for admin password setup
│
├── config.php                 # Database connection, site constants, helper functions
├── database.sql               # Full database schema + sample data
│
├── style.css                  # All styles — public + admin (2,224 lines)
├── script.js                  # All frontend JS — 8 modules (330 lines)
│
├── admin/
│   ├── login.php              # Admin login form with session creation
│   ├── logout.php             # Session destroy and redirect
│   ├── dashboard.php          # Overview: stats, recent bookings, recent messages
│   ├── manage_cars.php        # List all cars with edit/delete actions
│   ├── add_car.php            # Add new car listing with image upload
│   ├── edit_car.php           # Edit existing car listing
│   ├── delete_car.php         # Delete car and remove uploaded image
│   ├── bookings.php           # View and manage all rental bookings
│   ├── messages.php           # View and manage all contact submissions
│   └── includes/
│       └── sidebar.php        # Admin sidebar navigation (shared across admin pages)
│
└── uploads/                   # Car images uploaded via admin panel
    ├── car_*.jpg
    └── car_*.jfif
```

<br/>

---

## Database Schema

Four tables power the entire platform:

```sql
cars        — id, car_name, brand, price (PKR/day), description,
              image, category (rental|showroom|both), is_available, created_at

bookings    — id, name, email, phone, car_id (FK → cars),
              booking_date, return_date, status (pending|confirmed|cancelled), created_at

contacts    — id, name, email, phone, message, is_read, created_at

admin       — id, username, password (bcrypt), created_at
```

**Relationships:** `bookings.car_id` references `cars.id` with `ON DELETE SET NULL` — so deleting a car from the fleet does not destroy historical booking records.

To set up the database:

```bash
mysql -u root -p < database.sql
```

This creates the `carhub` database, all four tables, the default admin user, and six sample luxury car listings.

<br/>

---

## Pages Breakdown

| Page | File | Description |
|---|---|---|
| Home | `home.php` | Hero with counters, 4 featured cars from DB, Why Choose Us, CTA strip |
| Fleet | `cars.php` | All available cars from DB, JS-powered category filter |
| Services | `services.php` | Luxury Rental, Wedding, Corporate, Showroom service cards |
| Gallery | `gallery.php` | Responsive mosaic grid with full-screen lightbox |
| About | `about.php` | Brand story, team section, values |
| Contact | `contact.php` | Rental booking form + general enquiry form, both write to MySQL |

<br/>

---

## Admin Panel

All admin routes live under `/admin/` and require an active session. Accessing any admin page without logging in triggers an immediate redirect to `admin/login.php`.

| Admin Page | File | Function |
|---|---|---|
| Dashboard | `dashboard.php` | Live counts, recent bookings table, recent messages table |
| Manage Fleet | `manage_cars.php` | Paginated car list with inline edit and delete |
| Add Car | `add_car.php` | Form: name, brand, price, description, category, image upload |
| Edit Car | `edit_car.php` | Pre-filled edit form, option to replace uploaded image |
| Delete Car | `delete_car.php` | Deletes DB record and removes image file from `uploads/` |
| Bookings | `bookings.php` | All bookings with status management (pending / confirmed / cancelled) |
| Messages | `messages.php` | All contact submissions, marks messages as read |
| Logout | `logout.php` | Destroys session and redirects to login |

<br/>

---

## Tech Stack

| Layer | Technology | Purpose |
|---|---|---|
| Backend | PHP 8+ | Server-side rendering, form handling, session auth |
| Database | MySQL / MariaDB | Persistent storage for cars, bookings, contacts, admin |
| Frontend | HTML5 | Semantic page structure, ARIA accessibility |
| Styling | CSS3 | Custom properties, Grid, Flexbox, keyframe animations |
| Behaviour | Vanilla JavaScript (ES6+) | All interactivity, zero library dependencies |
| Icons | Font Awesome 6.5 | UI icons via CDN |
| Typography | Google Fonts | Bebas Neue (display) + Outfit (body) |
| Images | Local uploads | PHP `move_uploaded_file()` with timestamp naming |

<br/>

---

## JavaScript Modules

`script.js` is organized into 8 clearly defined modules:

```
Module 1 — Scroll Reveal         IntersectionObserver fade-up on .reveal elements
Module 2 — Smooth Scroll         Anchor click handler with navbar offset
Module 3 — Gallery Lightbox      openLightbox / closeLightbox / prevImage / nextImage
Module 4 — Counter Animation     requestAnimationFrame ease-out counter on data-target
Module 5 — Navbar Scroll State   Adds .scrolled class after 60px for background change
Module 6 — Mobile Menu           Hamburger open/close with body scroll lock
Module 7 — Fleet Filter          Client-side category filter (all / rental / showroom)
Module 8 — Skeleton Loading      Removes shimmer class on image load or error
```

<br/>

---

## CSS Architecture

`style.css` (2,224 lines) uses CSS Custom Properties for a single source of truth:

```css
:root {
  --red:        #c0392b;   /* Primary brand — performance red  */
  --red-dark:   #96281b;   /* Hover / active states            */
  --black:      #0a0a0a;   /* Primary background               */
  --dark:       #111111;   /* Card and section backgrounds     */
  --dark-2:     #1a1a1a;   /* Elevated surface                 */
  --white:      #ffffff;   /* Primary text                     */
  --white-dim:  #cccccc;   /* Secondary text                   */
  --gold:       #f0c040;   /* Accent — premium badges          */
  --border:     #2a2a2a;   /* Subtle borders                   */
}
```

The file is structured in clear sections: Reset, Variables, Typography, Navbar, Hero, Cards, Fleet, Services, Gallery, Admin Panel, Responsive Breakpoints.

<br/>

---

## Getting Started

**Requirements:** PHP 8+, MySQL 5.7+ or MariaDB, Apache or Nginx (XAMPP / WAMP / Laragon recommended for local development)

```bash
# 1. Clone the repository
git clone https://github.com/arsalan-khan-dev/car-hub.git

# 2. Move to your web server's root directory
cp -r car-hub /Applications/XAMPP/xamppfiles/htdocs/
# or on Windows: C:\xampp\htdocs\

# 3. Import the database
mysql -u root -p < car-hub/database.sql

# 4. Configure database credentials
nano car-hub/config.php
# Update DB_USER, DB_PASS, and SITE_URL

# 5. Open in browser
# http://localhost/car-hub/home.php
# http://localhost/car-hub/admin/login.php
```

<br/>

---

## Deployment

**Shared Hosting (cPanel)**

```
1. Upload all files to public_html/car-hub/ via File Manager or FTP
2. Create a MySQL database in cPanel > MySQL Databases
3. Import database.sql via phpMyAdmin
4. Update config.php with live DB credentials and SITE_URL
```

**VPS / Cloud Server**

```bash
git clone https://github.com/arsalan-khan-dev/car-hub.git /var/www/html/car-hub
mysql -u root -p carhub < /var/www/html/car-hub/database.sql
# Configure Apache/Nginx virtual host to point to project root
```

**GitHub Setup**

```bash
echo "# car-hub" >> README.md
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/arsalan-khan-dev/car-hub.git
git push -u origin main
```

<br/>

---

## Default Credentials

| Role | Username | Password |
|---|---|---|
| Admin | `admin` | `admin123` |

The default password hash in `database.sql` corresponds to `admin123`. To generate a new bcrypt hash, open `hashgen.php` in the browser after setup, enter your desired password, and update the `admin` table with the result.

> Change the default credentials immediately after first login.

<br/>

---

## Author

<div align="center">

<br/>

**Arsalan Khan**

[![GitHub](https://img.shields.io/badge/GitHub-arsalan--khan--dev-161b22?style=for-the-badge&logo=github&logoColor=white)](https://github.com/arsalan-khan-dev)

<br/>

*Built with precision. Engineered without shortcuts.*

<br/>

---

<sub>© 2025 Car Hub · Peshawar, Pakistan · Built by Arsalan Khan</sub>

</div>#   c a r - h u b  
 