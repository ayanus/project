CREATE TABLE Materials (
    material_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    material_name VARCHAR(255) NOT NULL,
    quantity INT(10) NOT NULL, 
    material_type INT(10) NOT NULL);