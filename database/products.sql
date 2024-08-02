CREATE TABLE Products (
    product_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    picture VARCHAR(255) NOT NULL, 
    price DECIMAL(10, 2) NOT NULL,
    quantity INT(10) NOT NULL);