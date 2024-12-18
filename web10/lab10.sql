
CREATE DATABASE IF NOT EXISTS garden_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE garden_db;


CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    avatar VARCHAR(255) DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DELETE FROM users WHERE username IN ('admin', 'user1');


INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$UJz3cGtqD4F9EQ0q7tQYZeeBLnLuLdExRnQjG1V1A2vTcN2av4HOe', 'admin'), 
('user1', '$2y$10$RBRUqC/Du7Q1LRfZRkG2KOBEwLR6BL9CBNZ65eDdbBb.vhJpAo7G2', 'user'); 
