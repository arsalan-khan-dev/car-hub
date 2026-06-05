-- ============================================
-- Car Hub - Luxury Car Rental & Showroom
-- Database: carhub
-- Location: Peshawar, Pakistan
-- ============================================

CREATE DATABASE IF NOT EXISTS carhub CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE carhub;

-- ============================================
-- Table: cars
-- Stores all car listings
-- ============================================
CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    car_name VARCHAR(150) NOT NULL,
    brand VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL COMMENT 'Price per day in PKR',
    description TEXT,
    image VARCHAR(255),
    category ENUM('rental','showroom','both') DEFAULT 'both',
    is_available TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Table: bookings
-- Stores car rental bookings
-- ============================================
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    car_id INT,
    booking_date DATE NOT NULL,
    return_date DATE,
    status ENUM('pending','confirmed','cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Table: contacts
-- Stores contact form submissions
-- ============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- Table: admin
-- Admin login credentials
-- ============================================
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL COMMENT 'Hashed password',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- ============================================
-- Sample Data: Admin User
-- ============================================
INSERT INTO admin (username, password) VALUES
('admin', '$2y$10$5c05UVjNdAbbykzjLoRx2.y0W06nZPkWw8fGKz8T9cbCAv0Ctd4Li');

-- ============================================
-- Sample Data: Cars
-- ============================================
INSERT INTO cars (car_name, brand, price, description, image, category) VALUES
('Ferrari 488 GTB', 'Ferrari', 85000, 'Experience the pinnacle of Italian engineering. The Ferrari 488 GTB delivers breathtaking performance with its twin-turbocharged V8 engine producing 661 hp. A true masterpiece of automotive excellence.', 'ferrari488.jpg', 'both'),
('Lamborghini Huracán', 'Lamborghini', 95000, 'The Lamborghini Huracán EVO is a naturally-aspirated V10 supercar that redefines the driving experience. With 610 hp and all-wheel drive, this machine commands respect on every road.', 'huracan.jpg', 'both'),
('Mercedes-Benz S-Class', 'Mercedes', 35000, 'The epitome of luxury and sophistication. The Mercedes S-Class offers an unparalleled blend of comfort, technology, and performance. Perfect for corporate events and VIP transportation.', 'sclass.jpg', 'rental'),
('BMW 7 Series', 'BMW', 30000, 'The BMW 7 Series represents the ultimate expression of luxury. With cutting-edge technology and a commanding presence, this executive sedan sets the benchmark in its class.', 'bmw7.jpg', 'rental'),
('Audi RS7', 'Audi', 45000, 'The Audi RS7 Sportback combines stunning design with exhilarating performance. Its 4.0L twin-turbo V8 produces 591 hp, making every journey an unforgettable experience.', 'audirs7.jpg', 'both'),
('Rolls-Royce Ghost', 'Rolls-Royce', 150000, 'The Rolls-Royce Ghost is the ultimate expression of automotive luxury. Handcrafted perfection with a whisper-quiet interior and a presence that commands admiration wherever it travels.', 'ghost.jpg', 'showroom');
