CREATE DATABASE medease_db;

-- users table
CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 email VARCHAR(100),
 password VARCHAR(100),
 role VARCHAR(20)
);

-- medicines table
CREATE TABLE medicines (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100),
 price INT,
 stock INT
);

-- cart table
CREATE TABLE cart (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 medicine_id INT,
 quantity INT
);

-- orders table
CREATE TABLE orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT,
 total INT,
 address VARCHAR(255),
 order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- order_items table
CREATE TABLE order_items (
 id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT,
 medicine_id INT,
 quantity INT
);