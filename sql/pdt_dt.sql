CREATE TABLE ProductionDetail (
    production_dt_id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    production_id INT(10) UNSIGNED NOT NULL,
    product_id INT(10) UNSIGNED NOT NULL,
    quantity INT(10) NOT NULL,
    FOREIGN KEY (production_id) REFERENCES Production(production_id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES Products(product_id) ON DELETE CASCADE);
