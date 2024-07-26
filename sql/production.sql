CREATE TABLE Production (
    production_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    production_date DATETIME NOT NULL,
    quantity INT(10) NOT NULL,
    status VARCHAR(50) NOT NULL);
