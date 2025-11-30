CREATE DATABASE crud_app;
USE crud_app;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  image_path VARCHAR(255),
  status ENUM('active','inactive') DEFAULT 'active'
);
