/**
 * Car Hub - Main JavaScript
 * Features: Mobile menu, scroll animations, gallery lightbox, smooth scroll
 */

'use strict';

// ============================================
// MOBILE MENU TOGGLE
// ============================================
const hamburger = document.getElementById('hamburger');
const navMenu = document.getElementById('navMenu');

if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('open');
        const open = navMenu.classList.contains('open');
        document.body.style.overflow = open ? 'hidden' : '';
        // Accessibility attributes
        hamburger.setAttribute('aria-expanded', open ? 'true' : 'false');
        navMenu.setAttribute('aria-hidden', open ? 'false' : 'true');
        // Move focus into menu when opened
        if (open) {
            const firstLink = navMenu.querySelector('.nav-link, .nav-btn');
            if (firstLink) firstLink.focus();
        }
    });

    // Close menu when a nav link is clicked
    navMenu.querySelectorAll('.nav-link, .nav-btn').forEach(link => {
        link.addEventListener('click', () => {
            hamburger.classList.remove('active');
            navMenu.classList.remove('open');
            document.body.style.overflow = '';
        });
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('open');
            document.body.style.overflow = '';
            hamburger.setAttribute('aria-expanded', 'false');
            navMenu.setAttribute('aria-hidden', 'true');
        }
    });
}

// ============================================
// STICKY HEADER ON SCROLL
// ============================================
const siteHeader = document.getElementById('siteHeader');

window.addEventListener('scroll', () => {
    if (siteHeader) {
        if (window.scrollY > 60) {
            siteHeader.classList.add('scrolled');
        } else {
            siteHeader.classList.remove('scrolled');
        }
    }
});

// ============================================
// SCROLL REVEAL ANIMATIONS
// Using IntersectionObserver for performance
// ============================================
const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('revealed');
            revealObserver.unobserve(entry.target); // Animate only once
        }
    });
}, {
    threshold: 0.12,
    rootMargin: '0px 0px -40px 0px'
});

// Observe all elements with reveal classes
document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
    revealObserver.observe(el);
});

// ============================================
// SMOOTH SCROLLING FOR ANCHOR LINKS
// ============================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// ============================================
// GALLERY LIGHTBOX
// ============================================
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');
const lightboxClose = document.getElementById('lightboxClose');
const lightboxPrev = document.getElementById('lightboxPrev');
const lightboxNext = document.getElementById('lightboxNext');

let galleryImages = [];
let currentImageIndex = 0;

if (lightbox) {
    // Collect all gallery images
    const galleryLinks = document.querySelectorAll('.gallery-link');
    galleryLinks.forEach((link, index) => {
        galleryImages.push(link.getAttribute('href'));
        
        link.addEventListener('click', (e) => {
            e.preventDefault();
            currentImageIndex = index;
            openLightbox(galleryImages[currentImageIndex]);
        });
    });

    // Open lightbox
    function openLightbox(src) {
        lightboxImg.src = src;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
        // accessibility
        lightbox.setAttribute('aria-hidden', 'false');
        lightbox.focus();
    }

    // Close lightbox
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
        lightbox.setAttribute('aria-hidden', 'true');
        setTimeout(() => { lightboxImg.src = ''; }, 400);
    }

    // Navigate prev
    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        lightboxImg.style.opacity = '0';
        setTimeout(() => {
            lightboxImg.src = galleryImages[currentImageIndex];
            lightboxImg.style.opacity = '1';
        }, 200);
    }

    // Navigate next
    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        lightboxImg.style.opacity = '0';
        setTimeout(() => {
            lightboxImg.src = galleryImages[currentImageIndex];
            lightboxImg.style.opacity = '1';
        }, 200);
    }

    lightboxImg.style.transition = 'opacity 0.2s ease';

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev) lightboxPrev.addEventListener('click', prevImage);
    if (lightboxNext) lightboxNext.addEventListener('click', nextImage);

    // Close on background click
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') prevImage();
        if (e.key === 'ArrowRight') nextImage();
    });
}

// ============================================
// CAR FILTER BUTTONS (Cars Page)
// ============================================
const filterBtns = document.querySelectorAll('.filter-btn');
const carCards = document.querySelectorAll('.car-card[data-category]');

filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        
        const filter = btn.dataset.filter;
        
        carCards.forEach(card => {
            if (filter === 'all') {
                card.style.display = '';
                setTimeout(() => { card.style.opacity = '1'; card.style.transform = ''; }, 10);
            } else {
                const cat = card.dataset.category;
                if (cat === filter || cat === 'both') {
                    card.style.display = '';
                    setTimeout(() => { card.style.opacity = '1'; }, 10);
                } else {
                    card.style.opacity = '0';
                    setTimeout(() => { card.style.display = 'none'; }, 300);
                }
            }
        });
    });
});

// ============================================
// BUTTON RIPPLE EFFECT
// ============================================
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        const rect = this.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        
        const ripple = document.createElement('span');
        ripple.style.cssText = `
            position:absolute; border-radius:50%; background:rgba(255,255,255,0.25);
            width:1px; height:1px; transform:translate(-50%,-50%) scale(0);
            top:${y}px; left:${x}px; animation:ripple 0.6s ease-out;
        `;
        
        if (!document.getElementById('rippleStyle')) {
            const style = document.createElement('style');
            style.id = 'rippleStyle';
            style.textContent = '@keyframes ripple{to{transform:translate(-50%,-50%) scale(300);opacity:0}}';
            document.head.appendChild(style);
        }
        
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        setTimeout(() => ripple.remove(), 700);
    });
});

// ============================================
// ANIMATED COUNTER (for stats)
// ============================================
function animateCounter(el) {
    const target = parseInt(el.dataset.target || el.innerText.replace(/\D/g, ''));
    const suffix = el.dataset.suffix || (el.innerText.match(/[^0-9]/) ? el.innerText.replace(/[0-9]/g, '') : '+');
    const duration = 1800;
    const step = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        el.innerText = Math.floor(current) + suffix;
    }, 16);
}

// Trigger counters when visible
const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(entry.target);
            counterObserver.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

document.querySelectorAll('.stat-num, .hero-stat-num, .admin-stat-num').forEach(el => {
    counterObserver.observe(el);
});

// ============================================
// CONTACT FORM: Show success alert
// ============================================
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    // PHP handles submission, JS just handles UX
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('sent') === '1') {
        const successEl = document.getElementById('formSuccess');
        if (successEl) {
            successEl.style.display = 'flex';
            successEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// ============================================
// ADMIN: Confirm delete
// ============================================
document.querySelectorAll('.confirm-delete').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (!confirm('Are you sure you want to delete this item? This action cannot be undone.')) {
            e.preventDefault();
        }
    });
});

// ============================================
// ADMIN: Sidebar toggle for mobile
// ============================================
const adminSidebar = document.querySelector('.admin-sidebar');
const adminMenuToggle = document.getElementById('adminMenuToggle');

if (adminMenuToggle && adminSidebar) {
    adminMenuToggle.addEventListener('click', () => {
        const isOpen = adminSidebar.classList.toggle('open');
        adminMenuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
}

// ============================================
// PARALLAX EFFECT (subtle, performance-safe)
// ============================================
const heroBg = document.querySelector('.hero-bg');
if (heroBg && window.innerWidth > 768) {
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        heroBg.style.transform = `translateY(${scrolled * 0.3}px)`;
    }, { passive: true });
}

console.log('%cCar Hub - Luxury Experience', 'color:#cc0000;font-size:18px;font-weight:bold;');
console.log('%cPeshawar\'s Premier Automotive Destination', 'color:#888;font-size:12px;');
