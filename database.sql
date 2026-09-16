-- LandBuy Database Schema
CREATE DATABASE IF NOT EXISTS landbuy_db;
USE landbuy_db;

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('buyer','seller','admin') DEFAULT 'buyer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Lands Table
CREATE TABLE lands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    seller_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    location VARCHAR(200) NOT NULL,
    district VARCHAR(100) NOT NULL,
    land_type ENUM('Residential','Commercial','Agricultural','Industrial') NOT NULL,
    land_size DECIMAL(10,2) NOT NULL,
    price DECIMAL(15,2) NOT NULL,
    road_access VARCHAR(100),
    description TEXT,
    status ENUM('Pending','Approved','Rejected','Sold') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Land Images Table
CREATE TABLE land_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    land_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE
);

-- Inquiries Table
CREATE TABLE inquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    land_id INT NOT NULL,
    buyer_id INT NOT NULL,
    seller_id INT NOT NULL,
    message TEXT NOT NULL,
    status ENUM('Pending','Replied','Closed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Favorites Table
CREATE TABLE favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    land_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (land_id) REFERENCES lands(id) ON DELETE CASCADE,
    UNIQUE KEY unique_fav (user_id, land_id)
);

-- Insert default admin
INSERT INTO users (full_name, email, phone, password, role) VALUES
('Admin User', 'admin@landbuy.lk', '0771234567', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Sample sellers
INSERT INTO users (full_name, email, phone, password, role) VALUES
('Kumar Perera', 'kumar@example.com', '0712345678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller'),
('Silva Fernando', 'silva@example.com', '0723456789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller'),
('Perera Bandara', 'perera@example.com', '0734567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'seller');

-- Sample lands (password for all: "password")
INSERT INTO lands (seller_id, title, location, district, land_type, land_size, price, road_access, description, status) VALUES
(2, 'Land in Jaffna', 'Chunnakam', 'Jaffna', 'Residential', 20, 4500000, '20 Feet Road', 'This is a prime residential land located in Chunnakam area. Good peaceful environment with all facilities.', 'Approved'),
(3, 'Land in Kandy', 'Peradeniya', 'Kandy', 'Residential', 30, 6000000, '15 Feet Road', 'Beautiful land in Peradeniya with mountain views.', 'Approved'),
(4, 'Land in Galle', 'Weligama', 'Galle', 'Commercial', 15, 3750000, '25 Feet Road', 'Commercial land near Weligama beach area.', 'Approved'),
(2, 'Land in Matara', 'Matara Town', 'Matara', 'Residential', 18, 4200000, '20 Feet Road', 'Well-located residential plot in Matara town.', 'Approved'),
(3, 'Land in Anuradhapura', 'Nuwaragampalatha', 'Anuradhapura', 'Agricultural', 25, 3800000, '12 Feet Road', 'Agricultural land with water source nearby.', 'Approved');
